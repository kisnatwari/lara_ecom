<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerProductsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\SellerProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\skeletonApi\homepageApi;
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

Route::get('/', [PagesController::class, 'homepage']);
Route::get('/products', [PagesController::class, 'productspage']);
Route::get('/products/{product}', [PagesController::class, 'productview'])->name('products.view');
Route::resource('cart', CartController::class);
Route::get("/myorders", [OrderController::class, 'myorders'])->name('orders.myorders');
Route::post('/cart/order', [OrderController::class, 'store'])->name('order.store');
Route::post('/update-customer-address', [ProfileController::class, 'updateAddress'])->name('cart.updateCustomerAddress');
Route::view('/order-success', 'customer.order-success');

Route::get('/shop/{shop}', [PagesController::class, 'shop'])->name('shop');
Route::get('/shop/{shop}/category/{category}', [PagesController::class, 'categoryByShop'])->name('shop.category');

Route::get("/shopcategory/{shopcategory}", [PagesController::class, 'shopcategory'])->name('shopcategory');

Route::get('/search', [CustomerProductsController::class, 'searchProducts'])->name('search');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/seller', 'seller.layouts')->name('seller-layouts');
    Route::get('/seller/dashboard', [PagesController::class, 'sellerDashboard'])->name('seller-dashboard');
    Route::get('/seller/products', [SellerProductController::class, 'index'])->name('seller-products');
    Route::get('/seller/products/create', [SellerProductController::class, 'create'])->name('products.create');
    Route::post('/seller/products', [SellerProductController::class, 'store'])->name('products.store');
    Route::get("/seller/products/{product}", [SellerProductController::class, 'show'])->name('products.view');
    Route::get("/seller/products/{product}/edit", [SellerProductController::class, 'edit'])->name('products.edit');
    Route::put("/seller/products/{product}", [SellerProductController::class, 'update'])->name('products.update');
    Route::delete("/seller/products/{product}", [SellerProductController::class, 'destroy'])->name('products.destroy');

    Route::get("/seller/categories", [CategoryController::class, 'index'])->name('categories.index');
    Route::post("/seller/category", [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/seller/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy');
    Route::put('/seller/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');


    Route::get("/seller/orders", [OrderController::class, 'index'])->name('orders.index');
    Route::get("/seller/orders/completed", [OrderController::class, 'completedOrders'])->name('orders.completed');
    Route::post("/seller/orders/cancel/{order}", [OrderController::class, 'order_cancel'])->name('orders.cancel');
    Route::post("/seller/orders/deliver/{order}", [OrderController::class, 'order_delivery'])->name('orders.deliver');
    Route::post("/seller/orders/delivered/{order}", [OrderController::class, 'order_delivered'])->name('orders.delivered');

    Route::get("/rating/{product}", [RatingController::class, 'index'])->name('rating.index');
    Route::post("/rating/{product}", [RatingController::class, 'store'])->name('rating.store');
    Route::delete("/rating/{rating}", [RatingController::class, 'destroy'])->name('rating.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/seller/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/category/search/{query}', [CategoryController::class, 'searchCategory']);

Route::get('/get-municipalities/{district_id}', function (int $district_id) {
    $munitipalities = Municipality::where('district_id', $district_id)->select(['id', 'municipality_name'])->get();
    return response()->json($munitipalities);
});


Route::get("/homepageApi/vendors", [homepageApi::class, 'vendors']);
Route::get("/homepageApi/productsFromMunicipality", [homepageApi::class, 'productsFromMunicipality']);
Route::get("/homepageApi/productsFromDistrict", [homepageApi::class, 'productsFromDistrict']);
Route::get("/homepageApi/randomProducts", [homepageApi::class, 'randomProducts']);

Route::post('khalti/verify', [paymentController::class, 'verify'])->name('ajax.khalti.verify_order');

require __DIR__ . '/auth.php';
