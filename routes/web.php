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
    Route::view('/seller', 'seller.layouts')->name('selsler-layouts');
    Route::view('/seller/dashboard', 'seller.dashboard')->name('seller-dashboard');
    Route::get('/seller/products', [ProductController::class, 'index'])->name('seller-products');
    Route::get('/seller/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get("/seller/products/{product}", [ProductController::class, 'show'])->name('products.view');
    Route::get("/seller/products/{product}/edit", [ProductController::class, 'edit'])->name('products.edit');
    Route::delete("/products/{product}", [ProductController::class, 'destroy'])->name('products.destroy');
    Route::resource('/products', ProductController::class);

    Route::get("/seller/categories", [CategoryController::class, 'index'])->name('categories.index');
    Route::post("/category", [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
    ->name('categories.destroy');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
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
