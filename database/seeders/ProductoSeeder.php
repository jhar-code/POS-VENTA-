<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        $productos = [
            [
                'codigo' => 'PROD001',
                'producto' => 'Laptop HP 15"',
                'precio_compra' => 2000.00,
                'precio_venta' => 2500.00,
                'stock' => 10,
                'id_categoria' => 1 // Asegúrate de que esta categoría exista
            ],
            [
                'codigo' => 'PROD002',
                'producto' => 'Camiseta Nike',
                'precio_compra' => 50.00,
                'precio_venta' => 80.00,
                'stock' => 50,
                'id_categoria' => 2
            ],
            [
                'codigo' => 'PROD003',
                'producto' => 'Sofá 3 plazas',
                'precio_compra' => 1500.00,
                'precio_venta' => 2000.00,
                'stock' => 5,
                'id_categoria' => 3
            ],
            [
                'codigo' => 'PROD004',
                'producto' => 'Arroz 5kg',
                'precio_compra' => 10.00,
                'precio_venta' => 15.00,
                'stock' => 100,
                'id_categoria' => 4
            ],
            [
                'codigo' => 'PROD005',
                'producto' => 'Shampoo Pantene 500ml',
                'precio_compra' => 20.00,
                'precio_venta' => 30.00,
                'stock' => 30,
                'id_categoria' => 5
            ]
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}