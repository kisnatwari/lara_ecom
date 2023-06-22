<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Clear existing records from the table
         //DB::table('users')->truncate();

        // Create user records
        $users = [];
        $faker = Faker::create();
        $password =Hash::make('password');

        for ($i = 1; $i <= 5000; $i++) {
            $users[] = [
                'name' => $faker->name,
                'email' => 'user'.$i.'@example.com',
                'password' => $password,
                'phone' => ($i - 1) % 758 + 1,
                'municipality_id' => rand(1, 753), // Replace with the desired range of municipality IDs
                'ward' => $faker->word(). " ward",
            ];
        }

        DB::table('users')->insert($users);
    }
}
