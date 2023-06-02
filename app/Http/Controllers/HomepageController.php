<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Seller;
use App\Models\ShopCategory;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    //
    public function homepage()
    {
        $shopcategories = ShopCategory::all();
        $municipalityId = auth()->user()->municipality_id;

        $vendors = Seller::whereHas('user', function ($query) use ($municipalityId) {
            $query->where('municipality_id', $municipalityId);
        })->get();

        $productsFromMunicipality = Product::whereIn('seller_id', $vendors->pluck('id')->toArray())
            ->orderBy('seller_id', 'asc')
            ->limit(50)
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
            ->limit(50)
            ->get();


        return view('welcome', compact('shopcategories', 'vendors', 'productsFromMunicipality', 'productsFromOtherMunicipalities', 'randomProducts', 'productsFromDistrict'));
    }
}
