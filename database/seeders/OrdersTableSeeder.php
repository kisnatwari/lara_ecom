<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $orders = [];

        $orderItems = [];

        $products = Product::pluck('id')->toArray();
        $pymt_options = array("khalti", "cod");
        $currentTimestamp = now()->timestamp;
        $status = [1, 2, 3, 3, 3, 3, 3, 3, 3, 3];

        for ($i = 0; $i < 9000; $i++) {
            $product_id = $products[array_rand($products)];
            // Check if the user already has the product in the order
            $user_id = rand(14001, 15000);
            if (isset($orderItems[$user_id]) && in_array($product_id, $orderItems[$user_id])) {
                continue; // Skip this iteration if the user already has the product in the order
            }

            $orderItems[$user_id][] = $product_id;

            $randomTimestamp = $currentTimestamp - rand(1, 1000) * 24 * 60 * 60; // 1 day = 24 * 60 * 60 seconds

            $orders[] = [
                'user_id' => $user_id,
                'product_id' => $product_id,
                'quantity' => rand(1, 5),
                'status_id' => $status[array_rand($status)],
                'payment_mode' => $pymt_options[array_rand($pymt_options)],
                'created_at' => date('Y-m-d H:i:s', $randomTimestamp),
                'updated_at' => date('Y-m-d H:i:s', $randomTimestamp),
            ];
        }

        DB::table('orders')->insert($orders);
    }
}
