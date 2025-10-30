<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    public function run()
    {
        $clientes = [
            [
                'ruc' => '12345678901',
                'nombre' => 'Empresa ABC S.A.',
                'telefono' => '987654321',
                'correo' => 'contacto@empresaabc.com',
                'credito' => 5000.00,
                'direccion' => 'Av. Principal 123, Lima'
            ],
            [
                'ruc' => '98765432109',
                'nombre' => 'Comercial XYZ S.R.L.',
                'telefono' => '912345678',
                'correo' => 'ventas@comercialxyz.com',
                'credito' => 3000.00,
                'direccion' => 'Calle Secundaria 456, Arequipa'
            ],
            [
                'ruc' => '56789012345',
                'nombre' => 'Servicios Rápidos E.I.R.L.',
                'telefono' => '956789012',
                'correo' => 'info@serviciosrapidos.com',
                'credito' => 7000.00,
                'direccion' => 'Jr. Industrial 789, Cusco'
            ]
        ];

        foreach ($clientes as $cliente) {
            Cliente::create($cliente);
        }
    }
}