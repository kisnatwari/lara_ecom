<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BrandsTableSeeder extends Seeder
{
    public function run()
    {
        // Clear existing records from the table
        //DB::table('brands')->truncate();

        // Create brand records
        $faker = Faker::create();
        $brands = [];

        for ($i = 1; $i <= 1200; $i++) {
            $brands[] = [
                'brand_name' => $faker->unique()->company,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('brands')->insert($brands);
    }
}
