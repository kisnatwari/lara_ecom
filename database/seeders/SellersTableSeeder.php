<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SellersTableSeeder extends Seeder
{
    public function run()
    {
        // Clear existing records from the table
        //DB::table('sellers')->truncate();

        // Create seller records
        $faker = Faker::create();
        $sellers = [];

        for ($i = 1; $i <= 4900; $i++) {
            $shopName = $faker->company;
            $sellers[] = [
                'user_id' => $i, // Assuming the user records have sequential IDs from 1 to 100
                'shop_category_id' => rand(1, 22), // Replace with the desired range of shop_category IDs
                'shop_name' => $shopName,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('sellers')->insert($sellers);
    }
}
