<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use App\Models\ShopCategory;

class PagesController extends Controller
{
    //
    public function homepage()
    {
        $shopcategories = ShopCategory::all();
        $municipalityId = auth()->user() && auth()->user()->municipality_id;

        if (!$municipalityId) {
            $randomProducts = Product::inRandomOrder()->limit(50)->get();
            return view('welcome', compact('shopcategories', 'randomProducts'));
        }
        return view('welcome', compact('shopcategories'));
    }


    public function productspage()
    {
        if (auth()->user()) {
        }
        return view('customer.products.index');
    }

    public function productview(Product $product)
    {
        return view('customer.products.view', compact('product'));
    }


    public function shop(Seller $shop)
    {
        $products = $shop->products()->paginate(20);
        return view('customer.shops.index', compact('shop', 'products'));
    }

    public function categoryByShop(Seller $shop, Category $category)
    {
        $products = $shop->products()->where('category_id', $category->id)->paginate(15);
        return view('customer.shops.index', compact('shop', 'products'));
    }

    public function shopCategory(ShopCategory $shopcategory)
    {
        if (!auth()->user()) {
            return redirect()->route('login');
        }
        $municipality_id = auth()->user()->municipality_id;
        $sellers = Seller::whereHas('user', function ($query) use ($municipality_id) {
            $query->where('municipality_id', $municipality_id);
        })
            ->where('shop_category_id', $shopcategory->id)
            ->with('user')
            ->with('shopcategory')
            ->get();
        return view('customer.shopcategories.index', compact('shopcategory', 'sellers'));
    }
}
