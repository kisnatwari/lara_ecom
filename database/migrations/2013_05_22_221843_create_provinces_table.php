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
    public function up(): void
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('province_name');
            $table->timestamps();
        });
        DB::unprepared("INSERT INTO `provinces` (`id`, `province_name`, `created_at`, `updated_at`) VALUES
        (1, 'Koshi Pradesh (Province No. 1)', '2023-05-17 00:03:40', '2023-05-17 00:03:40'),
        (2, 'Madhesh Pradesh (Province No. 2)', '2023-05-17 00:03:40', '2023-05-17 00:03:40'),
        (3, 'Bagmati Pradesh (Province No. 3)', '2023-05-17 00:03:40', '2023-05-17 00:03:40'),
        (4, 'Gandaki Pradesh (Province No. 4)', '2023-05-17 00:03:40', '2023-05-17 00:03:40'),
        (5, 'Lumbini Pradesh (Province No. 5)', '2023-05-17 00:03:40', '2023-05-17 00:03:40'),
        (6, 'Karnali Pradesh (Province No. 6)', '2023-05-17 00:03:41', '2023-05-17 00:03:41'),
        (7, 'Sudurpashchim Pradesh (Province No. 7)', '2023-05-17 00:03:41', '2023-05-17 00:03:41');
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinces');
    }
};
