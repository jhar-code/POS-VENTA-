<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class ProveedorSeeder extends Seeder
{
    public function run()
    {
        $proveedores = [
            [
                'identidad' => '20123456789',
                'nombre' => 'Distribuidora Central S.A.',
                'telefono' => '987654321',
                'correo' => 'contacto@distribuidoracentral.com',
                'direccion' => 'Av. Comercial 456, Lima'
            ],
            [
                'identidad' => '20987654321',
                'nombre' => 'Importadora Global E.I.R.L.',
                'telefono' => '912345678',
                'correo' => 'ventas@importadoraglobal.com',
                'direccion' => 'Calle Comercio 789, Arequipa'
            ],
            [
                'identidad' => '20567890123',
                'nombre' => 'Suministros Industriales SAC',
                'telefono' => '956789012',
                'correo' => 'info@suministrosindustriales.com',
                'direccion' => 'Jr. Proveedores 321, Cusco'
            ]
        ];

        foreach ($proveedores as $proveedor) {
            Proveedor::create($proveedor);
        }
    }
}