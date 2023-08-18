<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = FakerFactory::create();
        // Insert sample ratings into the ratings table
        $productIds = Product::pluck('id')->toArray();
        $ratings = [];
        for ($i = 0; $i < 6700; $i++) {
            $ratings[] = [
                'user_id' => rand(1, 14000),
                'product_id' => $productIds[array_rand($productIds)],
                'rating' => rand(1, 5),
                'comment' => $faker->realText(rand(100, 150))
            ];
        }
        DB::table("ratings")->insert($ratings);
    }
}