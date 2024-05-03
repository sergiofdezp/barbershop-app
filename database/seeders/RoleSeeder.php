<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Todos los roles.
        $admin = Role::create(['name' => 'Admin']);
        $peluquero = Role::create(['name' => 'Peluquero']);

        // Todos los permisos.
        $orders_index = Permission::create(['name' => 'orders.index']);
        $orders_edit = Permission::create(['name' => 'orders.edit']);

        $services_index = Permission::create(['name' => 'services.index']);
        $services_edit = Permission::create(['name' => 'services.edit']);

        $coupons_index = Permission::create(['name' => 'coupons.index']);
        $coupons_edit = Permission::create(['name' => 'coupons.edit']);

        $users_index = Permission::create(['name' => 'users.index']);
        $users_edit = Permission::create(['name' => 'users.edit']);
        $users_destroy = Permission::create(['name' => 'users.destroy']);

        // Permisos del rol admin.
        $admin->givePermissionTo($orders_index);
        $admin->givePermissionTo($orders_edit);

        $admin->givePermissionTo($services_index);
        $admin->givePermissionTo($services_edit);

        $admin->givePermissionTo($coupons_index);
        $admin->givePermissionTo($coupons_edit);
        
        $admin->givePermissionTo($users_index);
        $admin->givePermissionTo($users_edit);
        $admin->givePermissionTo($users_destroy);
    }
}
