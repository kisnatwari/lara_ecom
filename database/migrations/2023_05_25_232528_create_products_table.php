<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        self::down();
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->decimal('price', 8, 2);
            $table->foreignId('brand_id') -> constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->text('description');
            $table->json('images')->nullable();
            $table->foreignId('category_id') -> constrained()->onDelete('cascade');
            $table->foreignId('seller_id') -> constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
