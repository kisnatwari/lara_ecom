<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Insert rows for order statuses
        DB::table('statuses')->insert([
            ['name' => 'Order Placed'],
            ['name' => 'Order Confirmed'],
            ['name' => 'Order Shipped'],
            ['name' => 'Out for Delivery'],
            ['name' => 'Delivered'],
            /* ['name' => 'Order Cancelled'],
            ['name' => 'Payment Pending'],
            ['name' => 'Payment Received'],
            ['name' => 'Refund Requested'],
            ['name' => 'Refunded'],
            ['name' => 'Order Returned'],
            ['name' => 'Order Completed'], */
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
