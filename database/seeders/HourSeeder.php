<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hours')->insert([
            'order_hour' => "08:00",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "08:30",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "09:00",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "09:30",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "10:00",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "10:30",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "11:00",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "11:30",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "12:00",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "12:30",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "13:00",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "13:30",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "14:00",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "15:00",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "15:30",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "16:00",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "16:30",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "17:00",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "17:30",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "18:00",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "18:30",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "19:00",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "19:30",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "20:00",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "20:30",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "21:00",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "21:30",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('hours')->insert([
            'order_hour' => "22:00",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
