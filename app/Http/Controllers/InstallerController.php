<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class InstallerController extends Controller
{
    public function welcome()
    {
        // Requisitos básicos
        $requirements = [
            'php_version' => phpversion(),
            'extensions' => [
                'openssl' => extension_loaded('openssl'),
                'pdo' => extension_loaded('pdo'),
                'mbstring' => extension_loaded('mbstring'),
                'tokenizer' => extension_loaded('tokenizer'),
                'xml' => extension_loaded('xml'),
                'ctype' => extension_loaded('ctype'),
            ],
            'writable' => [
                'storage' => is_writable(storage_path()),
                'bootstrap_cache' => is_writable(base_path('bootstrap/cache')),
            ],
        ];

        return view('installer.welcome', compact('requirements'));
    }

    public function saveDatabase(Request $request)
    {
        $request->validate([
            'db_host' => 'required|string',
            'db_port' => 'required|numeric',
            'db_database' => 'required|string',
            'db_username' => 'required|string',
            'db_password' => 'nullable|string',
            'admin_name' => 'required|string',
            'admin_email' => 'required|email',
            'admin_password' => 'required|min:6|confirmed',
        ]);

        // Probar conexión PDO rápida
        try {
            $dsn = "mysql:host={$request->db_host};port={$request->db_port};dbname={$request->db_database}";
            new \PDO($dsn, $request->db_username, $request->db_password);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['db' => 'No se pudo conectar a la BD: ' . $e->getMessage()]);
        }

        // Guardar datos temporales en sesión (para el siguiente paso)
        session([
            'installer.db' => $request->only('db_host', 'db_port', 'db_database', 'db_username', 'db_password'),
            'installer.admin' => $request->only('admin_name', 'admin_email', 'admin_password'),
        ]);

        // Escribir .env (safe writer)
        $this->setEnvironmentValue([
            'DB_CONNECTION' => 'mysql',
            'DB_HOST' => $request->db_host,
            'DB_PORT' => $request->db_port,
            'DB_DATABASE' => $request->db_database,
            'DB_USERNAME' => $request->db_username,
            'DB_PASSWORD' => $request->db_password,
            'APP_ENV' => 'production',
        ]);

        return redirect()->route('installer.run.page');
    }

    public function runPage()
    {
        // Mostrar vista con botón para iniciar instalación
        return view('installer.run');
    }

    public function runInstall(Request $request)
    {
        // Generar app key
        Artisan::call('key:generate', ['--force' => true]);

        // Verificar si ya existe la tabla users
        if (!Schema::hasTable('users')) {
            // BD vacía → migraciones desde cero + seeds
            Artisan::call('migrate:fresh', ['--seed' => true, '--force' => true]);
        } else {
            // BD ya con tablas → solo migraciones pendientes + seeders
            Artisan::call('migrate', ['--force' => true]);
            Artisan::call('db:seed', ['--force' => true]);
        }

        // Crear usuario admin (si se pasó por sesión)
        $admin = session('installer.admin', null);

        if ($admin) {
            // Evitar duplicados por email
            $existing = User::where('email', $admin['admin_email'])->first();

            if (! $existing) {
                $user = User::create([
                    'name'     => $admin['admin_name'],
                    'email'    => $admin['admin_email'],
                    'password' => Hash::make($admin['admin_password']),
                ]);

                // Asignar rol Admin (necesita que exista en permisos/roles seed)
                $user->assignRole('Admin');
            }
        }

        // Marcar como instalada
        Storage::put('installed', now()->toString());

        // Limpiar datos de sesión del instalador
        session()->forget('installer');

        // Redirigir a la vista final
        return redirect()->route('installer.finished');
    }

    public function finished()
    {
        return view('installer.finished');
    }

    /**
     * Helper para escribir variables en .env (preserva otras claves).
     * Recibe un array ['KEY' => 'value', ...]
     */
    protected function setEnvironmentValue(array $values)
    {
        $envPath = base_path('.env');

        if (! File::exists($envPath)) {
            // Crear desde .env.example si no existe
            if (File::exists(base_path('.env.example'))) {
                File::copy(base_path('.env.example'), $envPath);
            } else {
                File::put($envPath, '');
            }
        }

        $env = File::get($envPath);

        foreach ($values as $key => $value) {
            $escaped = str_contains($value, ' ') ? '"' . addslashes($value) . '"' : $value;

            if (preg_match("/^{$key}=.*$/m", $env)) {
                $env = preg_replace("/^{$key}=.*$/m", "{$key}={$escaped}", $env);
            } else {
                $env .= PHP_EOL . "{$key}={$escaped}";
            }
        }

        File::put($envPath, $env);
    }
}
