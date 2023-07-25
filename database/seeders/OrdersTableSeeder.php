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
        $user_id = rand(14001, 14010);
        $products = Product::where('seller_id', 2192)->pluck('id')->toArray();

        for ($i = 0; $i < 100; $i++) {
            $product_id = $products[array_rand($products)];
            // Check if the user already has the product in the order
            if (isset($orderItems[$user_id]) && in_array($product_id, $orderItems[$user_id])) {
                continue; // Skip this iteration if the user already has the product in the order
            }

            $orderItems[$user_id][] = $product_id;

            $orders[] = [
                'user_id' => $user_id,
                'product_id' => $product_id,
                'quantity' => rand(1, 5),
                'status_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('orders')->insert($orders);
    }
}
