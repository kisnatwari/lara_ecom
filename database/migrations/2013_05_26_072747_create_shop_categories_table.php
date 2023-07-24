<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('shop_categories', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->timestamps();
        });
        DB::unprepared(
            "INSERT INTO `shop_categories` (`name`) VALUES
            ('Grocery Shop'),
            ('Clothing Store'),
            ('Electronic Store'),
            ('Book Store'),
            ('Computer and IT Store'),
            ('Mobile Store'),
            ('Furniture Store'),
            ('Jewelry Store'),
            ('Bakery'),
            ('Beauty and Personal Care'),
            ('Pet Products Store'),
            ('Home Appliances'),
            ('Hardware Store'),
            ('Sporting Goods Store'),
            ('Home Decor'),
            ('Others');"
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('shop_categories');
    }
};