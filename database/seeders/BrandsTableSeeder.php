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
        $brandNames =  array_unique(['Nike', 'Adidas', 'Puma', 'Reebok', 'Converse', 'Vans', 'New Balance', 'Under Armour', 'ASICS', 'Skechers', 'Fila', 'Timberland', 'Salomon', 'Lacoste', 'Merrell', 'Dr. Martens', 'Brooks', 'Hoka One One', 'Clarks', 'Birkenstock', 'Columbia', 'Saucony', 'Mizuno', 'Vibram', 'Ecco', 'Bata', 'Crocs', 'Gucci', 'Prada', 'Balenciaga', 'Louis Vuitton', 'Versace', 'Christian Louboutin', 'Jimmy Choo', 'Yeezy', 'Vans', 'Supreme', 'Off-White', 'Fendi', 'Givenchy', 'Valentino', 'Dior', 'Balmain', 'Alexander McQueen', 'Bottega Veneta', 'Stella McCartney', 'Ralph Lauren', 'Tommy Hilfiger', 'Calvin Klein', 'Michael Kors', 'Coach', 'Kate Spade', 'Guess', 'Diesel', 'Levis', 'Wrangler', 'Lee', 'Tom Ford', 'Zara', 'H&M', 'Forever 21', 'Uniqlo', 'Gap', 'American Eagle', 'Abercrombie & Fitch', 'Hollister', 'Urban Outfitters', 'Topshop', 'Zalando', 'Boohoo', 'PrettyLittleThing', 'Missguided', 'ASOS', 'Nike', 'Adidas', 'Puma', 'Reebok', 'Converse', 'Vans', 'New Balance', 'Under Armour', 'ASICS', 'Skechers', 'Fila', 'Timberland', 'Salomon', 'Lacoste', 'Merrell', 'Dr. Martens', 'Brooks', 'Hoka One One', 'Clarks', 'Birkenstock', 'Columbia', 'Saucony', 'Mizuno', 'Vibram', 'Ecco', 'Apple', 'Samsung', 'Sony', 'LG', 'Panasonic', 'Microsoft', 'Dell', 'HP', 'Lenovo', 'Acer', 'Asus', 'Toshiba', 'Sharp', 'Philips', 'Nikon', 'Canon', 'Fujifilm', 'GoPro', 'JBL', 'Bose', 'Harman Kardon', 'Beats', 'Sennheiser', 'Skullcandy', 'Sonos', 'Sony', 'Pioneer', 'Yamaha', 'Braun', 'Dyson', 'Breville', 'Fitbit', 'Garmin', 'Sony', 'Microsoft', 'Nintendo', 'PlayStation', 'Xbox', 'Logitech', 'Razer', 'Corsair', 'Intel', 'AMD', 'Nvidia', 'Huawei', 'Google', 'Amazon', 'Roku', 'Philips', 'Samsung', 'LG', 'Vizio', 'Sharp', 'Epson', 'Canon', 'Brother', 'Xerox', 'Ricoh', 'Casio', 'Seiko', 'Garmin', 'TomTom', 'Wacom', 'Adobe', 'Autodesk', 'Symantec', 'Kaspersky', 'Microsoft', 'Apple', 'Dell', 'Lenovo', 'Acer', 'Asus', 'HP', 'Toshiba', 'Western Digital', 'Seagate', 'SanDisk', 'Kingston', 'Lexar', 'Samsung', 'Intel', 'AMD', 'Nvidia', 'Corsair', 'Logitech', 'Belkin', 'Linksys', 'TP-Link', 'Netgear', 'D-Link', 'Ubiquiti', 'Apple', 'Samsung', 'Sony', 'LG', 'Microsoft', 'Nikon', 'Canon', 'GoPro', 'DJI', 'Zara', 'H&M', 'Forever 21', 'Uniqlo', 'GAP', 'American Eagle', 'Abercrombie & Fitch', 'Hollister', 'Urban Outfitters', 'Topshop', 'Zalando', 'Boohoo', 'PrettyLittleThing', 'Missguided', 'ASOS', 'Gucci', 'Prada', 'Balenciaga', 'Louis Vuitton', 'Versace', 'Christian Dior', 'Balmain', 'Alexander McQueen', 'Bottega Veneta', 'Stella McCartney', 'Ralph Lauren', 'Tommy Hilfiger', 'Calvin Klein', 'Michael Kors', 'Coach', 'Kate Spade', 'Guess', 'Diesel', 'Levi\'s', 'Wrangler', 'Lee', 'Tom Ford', 'Versus Versace', 'Moschino', 'Fendi', 'Givenchy', 'Valentino', 'Dolce & Gabbana', 'Armani', 'Hugo Boss', 'Burberry', 'Chanel', 'Kenzo', 'Yves Saint Laurent', 'Prabal Gurung', 'Marc Jacobs', 'Oscar de la Renta', 'Chloé', 'Celine', 'Victoria\'s Secret', 'Herve Leger', 'Balmain', 'A.P.C.', 'Rag & Bone', 'Theory', 'Reformation', 'Everlane', 'J.Crew', 'Banana Republic', 'Madewell', 'Free People', 'Anthropologie', 'Patagonia', 'The North Face', 'Columbia', 'Lululemon', 'Athleta', 'Outdoor Voices', 'Adidas', 'Nike', 'Puma', 'Under Armour', 'Reebok', 'Lacoste', 'Champion', 'Fila', 'New Balance', 'Superdry', 'Vans', 'Converse', 'Supreme', 'Off-White', 'Tommy Bahama', 'Nautica', 'Polo Ralph Lauren', 'Brooks Brothers', 'J.Crew', 'Bonobos', 'Club Monaco', 'Ted Baker', 'Paul Smith', 'Vince Camuto', 'John Varvatos', 'Theory', 'GANT', 'Hugo Boss', 'Diesel', 'AllSaints', 'Massimo Dutti']);

        for ($i = 0; $i < count($brandNames); $i++) {
            if(isset($brandNames[$i])){
                $brands[] = [
                    'brand_name' => $brandNames[$i],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('brands')->insert($brands);
    }
}
