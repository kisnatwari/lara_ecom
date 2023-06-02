<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // Clear existing records from the table
        //DB::table('products')->truncate();

        // Create product records
        $faker = Faker::create();
        $products = [];

        $brandIds = DB::table('brands')->pluck('id')->toArray();
        $categories = DB::table('categories')->select('id', 'seller_id')->get();

        for ($i = 1; $i <= 5000; $i++) {
            $productName = $faker->sentence(3);
            $price = $faker->randomFloat(2, 10, 1000);
            $quantity = $faker->numberBetween(1, 100);
            $description = $faker->paragraph;
            $images = [$faker->imageUrl(), $faker->imageUrl()];

            $category = $categories->random();

            $products[] = [
                'product_name' => $productName,
                'price' => $price,
                'brand_id' => $faker->randomElement($brandIds),
                'quantity' => $quantity,
                'description' => $description,
                'images' => json_encode($images),
                'category_id' => $category->id,
                'seller_id' => $category->seller_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('products')->insert($products);
    }
}
