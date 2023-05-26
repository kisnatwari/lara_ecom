<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            $faker = Faker::create();
            $images = [];
            for ($j = 0; $j < 3; $j++) {
                $path = $faker->imageUrl();
                $images[] = $path;
            }
            $product = new Product([
                'product_name' => $faker->word,
                'price' => $faker->randomFloat(2, 10, 100),
                'brand_id' => Brand::firstOrCreate(['brand_name' => 'Brand Name'])->id,
                'quantity' => $faker->numberBetween(1, 100),
                'description' => $faker->paragraph,
                'images' => json_encode($images),
                'category_id' => 1,
                'seller_id' => Seller::where(['user_id' => 1])->first()->id,
            ]);
            $product->save();
        }
    }
}
