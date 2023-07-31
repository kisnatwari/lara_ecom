<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;

class CustomerProductsController extends Controller
{
    public function searchProducts(Request $request)
    {
        // Get the search query from the request
        $searchQuery = $request->input('query');

        if (!empty($request->input('municipality'))) 
            $municipalityId = $request->input('municipality');
        else
            $municipalityId = auth()->user()->municipality_id;


        // Perform the search using the search query and municipality ID
        $products = Product::join('sellers', 'products.seller_id', '=', 'sellers.id')
            ->join('users', 'sellers.user_id', '=', 'users.id')
            ->where('users.municipality_id', $municipalityId)
            ->where(function ($query) use ($searchQuery) {
                $query->where('products.product_name', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('products.description', 'LIKE', '%' . $searchQuery . '%');
            })
            ->select('products.*')
            ->get();

        // Return the search results
        return view('customer.search', ['products' => $products]);
    }
}
