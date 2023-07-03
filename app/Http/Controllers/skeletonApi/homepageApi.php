<?php

namespace App\Http\Controllers\skeletonApi;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Seller;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class homepageApi extends Controller
{
    public function vendors(){
        $user = Auth::user();
        $municipalityId = auth() -> user() && auth()->user()->municipality_id;
        if (!$municipalityId) {
            return response(["message" => "Authentication failed"]);
        }
        $vendors = Seller::whereHas('user', function ($query) use ($municipalityId) {
            $query->where('municipality_id', $municipalityId);
        })->get();
        return response($vendors, 200);
    }
}
