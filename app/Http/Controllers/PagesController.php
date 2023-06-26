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

        $vendors = Seller::whereHas('user', function ($query) use ($municipalityId) {
            $query->where('municipality_id', $municipalityId);
        })->get();

        $productsFromMunicipality = Product::whereIn('seller_id', $vendors->pluck('id')->toArray())
            ->orderBy('seller_id', 'asc')
            ->limit(30)
            ->get();

        $otherVendors = Seller::whereHas('user', function ($query) use ($municipalityId) {
            $query->where('municipality_id', '!=', $municipalityId);
        })->get();

        $productsFromOtherMunicipalities = Product::whereIn('seller_id', $otherVendors->pluck('id')->toArray())
            ->inRandomOrder()
            ->limit(30)
            ->get();

        $userDistrictId = auth()->user()->municipality->district_id;

        $productsFromDistrict = Product::whereHas('seller.user.municipality', function ($query) use ($userDistrictId) {
            $query->where('district_id', $userDistrictId);
        })->inRandomOrder()->limit(30)->get();

        $excludedProductIds = $productsFromMunicipality->pluck('id')->concat($productsFromDistrict->pluck('id'));

        $randomProducts = Product::whereNotIn('id', $excludedProductIds)
            ->inRandomOrder()
            ->limit(30)
            ->get();

        return view('welcome', compact('shopcategories', 'vendors', 'productsFromMunicipality', 'productsFromOtherMunicipalities', 'randomProducts', 'productsFromDistrict'));
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
        $products = $shop->products()->where('category_id', $category -> id)->paginate(15);
        return view('customer.shops.index', compact('shop', 'products'));
    }

}
