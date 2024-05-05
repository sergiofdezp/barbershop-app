<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('orders')->insert([
        //     'order_ref' => "C4lcFKMToE",
        //     'order_date' => "2024-04-20",
        //     'order_hour' => "12:00",
        //     'user_id' => 1,
        //     'name' => "Admin",
        //     'phone' => "000111222",
        //     'service_id' => 1,
        //     'is_online' => 0,
        //     'order_status_id' => 0,
        //     'total_price' => 10,
        //     'pay_status' => "0",
        //     'coupon_id' => 1,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // DB::table('orders')->insert([
        //     'order_ref' => "yPf8p2jEAB",
        //     'order_date' => "2024-04-25",
        //     'order_hour' => "13:00",
        //     'user_id' => 1,
        //     'name' => "Admin",
        //     'phone' => "000111222",
        //     'service_id' => 2,
        //     'is_online' => 0,
        //     'order_status_id' => 0,
        //     'total_price' => 7,
        //     'pay_status' => "0",
        //     'coupon_id' => 1,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // DB::table('orders')->insert([
        //     'order_ref' => "quY7LzyyhA",
        //     'order_date' => "2024-04-30",
        //     'order_hour' => "18:00",
        //     'user_id' => 1,
        //     'name' => "Admin",
        //     'phone' => "000111222",
        //     'service_id' => 1,
        //     'is_online' => 0,
        //     'order_status_id' => 0,
        //     'total_price' => 10,
        //     'pay_status' => "0",
        //     'coupon_id' => 1,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}
