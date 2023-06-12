<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $carts = [];

        $cartItems = [];

        for ($i = 0; $i < 10000; $i++) {
            $user_id = rand(5501, 10000);
            $product_id = rand(1, 200000);

            // Check if the user already has the product in the cart
            if (isset($cartItems[$user_id]) && in_array($product_id, $cartItems[$user_id])) {
                continue; // Skip this iteration if the user already has the product in the cart
            }

            $cartItems[$user_id][] = $product_id;

            $carts[] = [
                'user_id' => $user_id,
                'product_id' => $product_id,
                'quantity' => rand(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('carts')->insert($carts);
    }
}
