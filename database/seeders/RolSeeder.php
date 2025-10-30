<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::firstOrCreate(['name' => 'Admin']);
        $role2 = Role::firstOrCreate(['name' => 'Vendedor']);

        Permission::firstOrCreate(['name' => 'dashboard'])->assignRole($role1);

        Permission::firstOrCreate(['name' => 'productos.index'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'productos.firstOrCreate'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'productos.edit'])->assignRole($role1);
        Permission::firstOrCreate(['name' => 'productos.delete'])->assignRole($role1);
        Permission::firstOrCreate(['name' => 'productos.reportes'])->syncRoles([$role1, $role2]);

        Permission::firstOrCreate(['name' => 'categorias.index'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'categorias.edit'])->assignRole($role1);
        Permission::firstOrCreate(['name' => 'categorias.firstOrCreate'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'categorias.delete'])->assignRole($role1);

        Permission::firstOrCreate(['name' => 'formas-pago.index'])->assignRole($role1);
        Permission::firstOrCreate(['name' => 'formas-pago.firstOrCreate'])->assignRole($role1);
        Permission::firstOrCreate(['name' => 'formas-pago.edit'])->assignRole($role1);
        Permission::firstOrCreate(['name' => 'formas-pago.delete'])->assignRole($role1);

        Permission::firstOrCreate(['name' => 'proveedores.index'])->assignRole($role1);
        Permission::firstOrCreate(['name' => 'proveedores.firstOrCreate'])->assignRole($role1);
        Permission::firstOrCreate(['name' => 'proveedores.edit'])->assignRole($role1);
        Permission::firstOrCreate(['name' => 'proveedores.delete'])->assignRole($role1);
        Permission::firstOrCreate(['name' => 'proveedores.reportes'])->assignRole($role1);

        Permission::firstOrCreate(['name' => 'clientes.index'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'clientes.firstOrCreate'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'clientes.edit'])->assignRole($role1);
        Permission::firstOrCreate(['name' => 'clientes.delete'])->assignRole($role1);
        Permission::firstOrCreate(['name' => 'clientes.reportes'])->assignRole($role1);

        Permission::firstOrCreate(['name' => 'usuarios.index'])->assignRole($role1);
        Permission::firstOrCreate(['name' => 'usuarios.firstOrCreate'])->assignRole($role1);
        Permission::firstOrCreate(['name' => 'usuarios.edit'])->assignRole($role1);
        Permission::firstOrCreate(['name' => 'usuarios.delete'])->assignRole($role1);

        Permission::firstOrCreate(['name' => 'gastos.index'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'gastos.firstOrCreate'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'gastos.edit'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'gastos.delete'])->assignRole($role1);
        Permission::firstOrCreate(['name' => 'gastos.reportes'])->assignRole($role1);

        Permission::firstOrCreate(['name' => 'compania.update'])->assignRole($role1);

        Permission::firstOrCreate(['name' => 'venta.index'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'venta.show'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'venta.anular'])->assignRole($role1);
        Permission::firstOrCreate(['name' => 'venta.reportes'])->assignRole($role1);

        Permission::firstOrCreate(['name' => 'creditoventa.index'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'creditoventa.abonos'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'creditoventa.reportes'])->assignRole($role1);

        Permission::firstOrCreate(['name' => 'compra.index'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'compra.show'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'compra.anular'])->assignRole($role1);
        Permission::firstOrCreate(['name' => 'compra.reportes'])->assignRole($role1);

        Permission::firstOrCreate(['name' => 'cotizacion.index'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'cotizacion.show'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'cotizacion.eliminar'])->assignRole($role1);
        Permission::firstOrCreate(['name' => 'cotizacion.reportes'])->assignRole($role1);

        Permission::firstOrCreate(['name' => 'cajas.index'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'cajas.firstOrCreate'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'cajas.update'])->syncRoles([$role1, $role2]);
        Permission::firstOrCreate(['name' => 'cajas.reportes'])->assignRole($role1);

        Permission::firstOrCreate(['name' => 'roles.update'])->assignRole($role1);

        Permission::firstOrCreate(['name' => 'movimientos.index'])->syncRoles([$role1, $role2]);
    }
}
