<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;

class CustomerProductsController extends Controller
{
    public function searchProducts(Request $request)
    {
        if (!auth()->user())
            return redirect('/login');
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


        // Get sellers from the searched products
        $productSellers = $products->pluck('seller');

        // Get sellers based on search query from the sellers table
        $sellers = Seller::join('users', 'sellers.user_id', '=', 'users.id')
            ->where('users.municipality_id', $municipalityId)
            ->where(function ($query) use ($searchQuery) {
                $query->where('sellers.shop_name', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('users.name', 'LIKE', '%' . $searchQuery . '%');
            })
            ->select('sellers.*')
            ->get();

        // Combine the sellers from products and sellers table, ensuring uniqueness
        $sellers = $sellers->union($productSellers)->unique();
        
        // Return the search results
        $municipality = Municipality::find($municipalityId);
        return view('customer.search', compact('products', 'sellers', 'searchQuery', 'municipality'));
    }
}
