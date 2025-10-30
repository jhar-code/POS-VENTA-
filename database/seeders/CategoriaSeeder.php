<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            ['nombre' => 'Electrónica'],
            ['nombre' => 'Ropa'],
            ['nombre' => 'Hogar'],
            ['nombre' => 'Alimentos'],
            ['nombre' => 'Salud y Belleza']
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}