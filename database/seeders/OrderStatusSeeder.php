<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_status')->insert([
            'name' => "En progreso",
        ]);

        DB::table('order_status')->insert([
            'name' => "Terminado",
        ]);

        DB::table('order_status')->insert([
            'name' => "Cancelado",
        ]);

        DB::table('order_status')->insert([
            'name' => "No asistido",
        ]);
    }
}
