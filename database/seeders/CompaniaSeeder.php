<?php

namespace Database\Seeders;

use App\Models\Compania;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompaniaSeeder extends Seeder
{
    /**
     *ejecutar semilla de la base de datos.
     */
    public function run(): void
    {
        Compania::create([
            'nombre' => 'Mi Compañía',
            'correo' => 'info@gmail.com',
            'telefono' => '123456789',
            'direccion' => 'Panama',
        ]);
    }
}
