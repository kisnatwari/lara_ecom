<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

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
        $password = Hash::make('password');
        $pictures = Storage::files('public/profile_pics');

        for ($i = 1; $i <= 5000; $i++) {
            $profile_photo = $pictures[array_rand($pictures)];
            $users[] = [
                'name' => $faker->name,
                'email' => 'user'.$i.'@example.com',
                'password' => $password,
                'phone' => ($i - 1) % 758 + 1,
                'municipality_id' => rand(1, 753), // Replace with the desired range of municipality IDs
                'ward' => $faker->word(). " ward",
                'profile_photo' => $profile_photo
            ];
        }

        DB::table('users')->insert($users);
    }
}