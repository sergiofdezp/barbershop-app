<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            'type' => "Pelo",
            'price' => "10",
            'image' => "pelo.png",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('services')->insert([
            'type' => "Barba",
            'price' => "7",
            'image' => "barba.png",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
