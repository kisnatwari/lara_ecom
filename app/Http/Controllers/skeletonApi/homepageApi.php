<?php

namespace App\Http\Controllers\skeletonApi;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Seller;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class homepageApi extends Controller
{
    public function vendors()
    {
        $municipalityId = auth()->user() && auth()->user()->municipality_id;
        if (!$municipalityId) {
            return response(["message" => "Authentication failed"]);
        }
        $vendors = Seller::whereHas('user', function ($query) use ($municipalityId) {
            $query->where('municipality_id', $municipalityId);
        })->get();
        return response($vendors, 200);
    }

    public function productsFromMunicipality()
    {
        $municipalityId = auth()->user() && auth()->user()->municipality_id;
        if (!$municipalityId) {
            return response(["message" => "Authentication failed"]);
        }
        $vendors = Seller::with('user')->whereHas('user', function ($query) use ($municipalityId) {
            $query->where('municipality_id', $municipalityId);
        })->get();

        $products = Product::with('seller.user')->whereIn('seller_id', $vendors->pluck('id')->toArray())
            ->inRandomOrder()
            ->limit(32)
            ->get();

        return response($products, 200);
    }

    public function productsFromDistrict()
    {
        if (!auth()->user()->municipality) {
            return response(["message" => "Authentication failed"]);
        }

        $userDistrictId = auth()->user()->municipality->district_id;

        $products = Product::with('seller.user.municipality')->whereHas('seller.user.municipality', function ($query) use ($userDistrictId) {
            $query->where('district_id', $userDistrictId);
        })->inRandomOrder()->limit(32)->get();

        return response($products, 200);
    }

    public function randomProducts()
    {
        $randomProducts = Product::with('seller.user.municipality.district')
            ->orderBy('id', 'desc')
            ->limit(32)
            ->get();

        return response($randomProducts, 200);
    }
}
