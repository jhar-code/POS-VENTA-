<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usar firstOrCreate para evitar duplicados
        $user = User::firstOrCreate(
            ['email' => 'administrador@gmail.com'], // Buscar por email
            [
                'name' => 'SISTEMAS FREE',
                'password' => bcrypt('admin123'),
                'email_verified_at' => now() // Agregar verificación
            ]
        );

        // Asignar rol si no lo tiene
        if (!$user->hasRole('Admin')) {
            $user->assignRole('Admin');
        }

        echo "Usuario configurado: " . $user->email . "\n";
    }
}
