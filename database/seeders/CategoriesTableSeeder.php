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

        $categoryNames = ['Electronics', 'Clothing', 'Home & Kitchen', 'Beauty & Personal Care', 'Health & Fitness', 'Toys & Games', 'Books & Media', 'Sports & Outdoors', 'Automotive', 'Jewelry & Watches', 'Baby & Kids', 'Pet Supplies', 'Office Supplies', 'Grocery & Gourmet', 'Home Improvement', 'Furniture', 'Appliances', 'Tools & Equipment', 'Movies & TV Shows', 'Music', 'Video Games', 'Crafts & Hobbies', 'Outdoor Recreation', 'Luggage & Travel', 'Party Supplies', 'Musical Instruments', 'Collectibles', 'Industrial & Scientific', 'Software', 'Digital Cameras', 'Cell Phones', 'Tablets', 'Headphones', 'Wearable Tech', 'Printers & Scanners', 'Smart Home', 'Kitchen & Dining', 'Bedding', 'Bath', 'Fragrances', 'Makeup', 'Haircare', 'Skincare', 'Personal Care Appliances', 'Vitamins & Supplements', 'Fitness Equipment', 'Sports Nutrition', 'Cycling', 'Camping & Hiking', 'Yoga & Pilates', 'Men\'s Clothing', 'Women\'s Clothing', 'Kids\' Clothing', 'Shoes', 'Accessories', 'Watches', 'Fine Jewelry', 'Fashion Jewelry', 'Sunglasses', 'Handbags', 'Backpacks', 'Wallets', 'Baby Gear', 'Diapering', 'Baby Clothing', 'Baby Toys', 'Baby Safety', 'Dog Supplies', 'Cat Supplies', 'Bird Supplies', 'Fish & Aquatic Pets', 'Small Animal Supplies', 'Office Electronics', 'Printers', 'Scanners', 'Projectors', 'Office Furniture', 'Paper', 'Writing Supplies', 'Desk Accessories', 'Snacks', 'Beverages', 'Canned Goods & Soups', 'Cereal & Breakfast Foods', 'Pantry Staples', 'Baking Supplies', 'Home Improvement', 'Power Tools', 'Hand Tools', 'Lighting & Ceiling Fans', 'Painting Supplies', 'Plumbing', 'Building Materials', 'Furniture', 'Living Room Furniture', 'Bedroom Furniture', 'Dining Room Furniture', 'Kitchen & Dining Furniture', 'Mattresses', 'Appliances', 'Refrigerators', 'Washers & Dryers', 'Ranges & Ovens', 'Dishwashers', 'Tools & Equipment', 'Hand Tools', 'Power Tools', 'Tool Storage', 'Automotive Parts', 'Automotive Accessories', 'Car Electronics', 'Motorcycle Parts', 'Motorcycle Accessories', 'Tires & Wheels', 'Movies', 'TV Shows', 'Music', 'Books', 'Magazines', 'eBooks', 'Audiobooks', 'Video Games', 'Console Games', 'PC Games', 'Board Games', 'Card Games', 'Puzzles', 'Model Kits', 'Drawing & Painting Supplies', 'Sewing', 'Scrapbooking', 'Wood Crafts', 'Outdoor Recreation', 'Camping & Hiking', 'Fishing', 'Cycling', 'Water Sports', 'Winter Sports', 'Luggage Sets', 'Travel Accessories', 'Backpacks', 'Suitcases', 'Party Decorations', 'Party Supplies', 'Guitars', 'Keyboards', 'Drums & Percussion', 'Microphones', 'Brass Instruments', 'Action Figures', 'Building Sets', 'Dolls & Accessories', 'Puzzles', 'Stuffed Animals & Plush Toys', 'Remote Control Toys', 'Sports & Outdoor Play', 'Board Games', 'Card Games', 'Cookware', 'Bakeware', 'Small Appliances', 'Dining & Entertaining', 'Bedding Sets', 'Sheets & Pillowcases', 'Blankets & Throws', 'Bath Towels', 'Bathroom Accessories', 'Fragrances', 'Makeup', 'Haircare', 'Skincare', 'Personal Care Appliances', 'Vitamins & Supplements', 'Sports Nutrition', 'Exercise Accessories', 'Yoga & Pilates', 'Weight Loss', 'Men\'s Clothing', 'Women\'s Clothing', 'Kids\' Clothing', 'Shoes', 'Accessories', 'Watches', 'Fine Jewelry', 'Fashion Jewelry', 'Sunglasses', 'Handbags', 'Backpacks', 'Wallets'];

        for ($i = 1; $i <= 10000; $i++) {
            $categories[] = [
                'seller_id' => $faker->randomElement($sellerIds),
                'name' => $faker->randomElement($categoryNames),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('categories')->insert($categories);
    }
}
