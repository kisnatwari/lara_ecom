<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('shop_categories', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->timestamps();
        });
        DB::unprepared("INSERT INTO `shop_categories` (`name`) VALUES
        ('Animals & Pet Supplies'),
        ('Apparel & Accessories'),
        ('Arts & Entertainment'),
        ('Baby & Toddler'),
        ('Business & Industrial'),
        ('Cameras & Optics'),
        ('Electronics'),
        ('Food, Beverages & Tobacco'),
        ('Furniture'),
        ('Hardware'),
        ('Health & Beauty'),
        ('Home & Garden'),
        ('Luggage & Bags'),
        ('Mature'),
        ('Media'),
        ('Office Supplies'),
        ('Religious & Ceremonial'),
        ('Software'),
        ('Sporting Goods'),
        ('Toys & Games'),
        ('Vehicles & Parts'),
        ('Others');");
    }
    
    public function down(): void
    {
        Schema::dropIfExists('shop_categories');
    }
};
