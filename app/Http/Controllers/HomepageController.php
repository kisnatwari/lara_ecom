<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Seller;
use App\Models\ShopCategory;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    //
    public function homepage(){
        $shopcategories = ShopCategory::all();
        $products = Product::all();
        $vendors = Seller::all();
        return view('welcome', compact('shopcategories', 'products', 'vendors'));
    }
}
