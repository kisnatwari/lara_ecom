<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Municipality;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/seller', 'seller.layouts')->name('seller-layouts');
    Route::view('/seller/dashboard', 'seller.dashboard')->name('seller-dashboard');
    Route::view('/seller/products', 'seller.products.index')->name('seller-products');
    Route::view('/seller/products/create', 'seller.products.create')->name('seller-products');
    Route::resource('/products', ProductController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/category/search/{query}', [CategoryController::class, 'searchCategory']);
Route::get('/get-municipalities/{district_id}', function (int $district_id) {
    $munitipalities = Municipality::where('district_id', $district_id)->select(['id', 'municipality_name'])->get();
    return response()->json($munitipalities);
});

//Route::view('/seller', 'seller.layouts');

require __DIR__ . '/auth.php';
