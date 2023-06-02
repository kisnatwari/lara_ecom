<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        // Clear existing records from the table
        //DB::table('categories')->truncate();
        

        // Create category records
        $faker = Faker::create();
        $categories = [];

        $sellerIds = DB::table('sellers')->pluck('id')->toArray();

        for ($i = 1; $i <= 10000; $i++) {
            $categories[] = [
                'seller_id' => $faker->randomElement($sellerIds),
                'name' => $faker->word,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('categories')->insert($categories);
    }
}
