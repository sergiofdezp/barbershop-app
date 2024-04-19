<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coupons')->insert([
            'code' => "08:00",
            'discount' => 50,
            'start_date' => "2024-01-01",
            'end_date' => "2024-12-31",
            'service' => "0",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
