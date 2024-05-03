<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // usuario administrador
        DB::table('users')->insert([
            'name' => "Admin",
            'email' => "admin@admin.com",
            'password' => Hash::make('admin')
        ]);
        DB::table('model_has_roles')->insert([
            'role_id' => "1",
            'model_type' => "App\Models\User",
            'model_id' => "1"
        ]);

        // usuario para peluquero
        DB::table('users')->insert([
            'name' => "Peluquero",
            'email' => "peluquero@peluquero.com",
            'password' => Hash::make('peluquero')
        ]);
    }
}
