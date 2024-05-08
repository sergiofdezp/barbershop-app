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
        $orders_index = Permission::create(['name' => 'orders.index', 'description' => 'Ver todas las reservas.']);
        $orders_create = Permission::create(['name' => 'orders.create', 'description' => 'Crear una nueva reserva desde el admin.']);
        $orders_edit = Permission::create(['name' => 'orders.edit', 'description'=> 'Editar una reserva.']);

        $services_index = Permission::create(['name' => 'services.index', 'description'=> 'Ver todos los servicios.']);
        $services_create = Permission::create(['name' => 'services.create', 'description'=> 'Crear un nuevo servicio.']);
        $services_edit = Permission::create(['name' => 'services.edit', 'description'=> 'Editar un servicio.']);

        $coupons_index = Permission::create(['name' => 'coupons.index', 'description'=> 'Ver todos los cupones.']);
        $coupons_create = Permission::create(['name' => 'coupons.create', 'description'=> 'Crear un nuevo cupón.']);
        $coupons_edit = Permission::create(['name' => 'coupons.edit', 'description'=> 'Editar un cupón.']);

        $users_index = Permission::create(['name' => 'users.index', 'description'=> 'Ver todos los usuarios del sistema.']);
        $users_edit = Permission::create(['name' => 'users.edit', 'description'=> 'Editar un usuario.']);
        $users_destroy = Permission::create(['name' => 'users.destroy', 'description'=> 'Eliminar un usuario.']);

        $roles_index = Permission::create(['name' => 'roles.index', 'description'=> 'Ver todos los roles.']);
        $roles_create = Permission::create(['name' => 'roles.create', 'description'=> 'Crear un nuevo rol.']);
        $roles_edit = Permission::create(['name' => 'roles.edit', 'description'=> 'Editar un rol.']);
        $roles_destroy = Permission::create(['name' => 'roles.destroy', 'description'=> 'Eliminar roles.']);

        $dashboard = Permission::create(['name' => 'dashboard.index', 'description'=> 'Ver el dashboard administrativo.']);

        // Permisos del rol 'admin'.
        $admin->givePermissionTo($orders_index);
        $admin->givePermissionTo($orders_create);
        $admin->givePermissionTo($orders_edit);

        $admin->givePermissionTo($services_index);
        $admin->givePermissionTo($services_create);
        $admin->givePermissionTo($services_edit);

        $admin->givePermissionTo($coupons_index);
        $admin->givePermissionTo($coupons_create);
        $admin->givePermissionTo($coupons_edit);

        $admin->givePermissionTo($users_index);
        $admin->givePermissionTo($users_edit);
        $admin->givePermissionTo($users_destroy);

        $admin->givePermissionTo($roles_index);
        $admin->givePermissionTo($roles_create);
        $admin->givePermissionTo($roles_edit);
        $admin->givePermissionTo($roles_destroy);

        $admin->givePermissionTo($dashboard);

        // Permisos del rol 'peluquero'.
        $peluquero->givePermissionTo($orders_index);
        $peluquero->givePermissionTo($orders_edit);

        $peluquero->givePermissionTo($services_index);
        $peluquero->givePermissionTo($services_edit);

        $peluquero->givePermissionTo($coupons_index);
        $peluquero->givePermissionTo($coupons_edit);

        $peluquero->givePermissionTo($users_index);
        $peluquero->givePermissionTo($users_edit);

        $peluquero->givePermissionTo($dashboard);
    }
}
