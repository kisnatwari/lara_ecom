<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Seller;
use App\Models\ShopCategory;
use Illuminate\Support\Facades\DB;

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
        $user = auth()->user();
        $allRating = Rating::where('product_id', $product->id)->get();

        // Calculate the average and total rating
        $sumRating = 0;
        $numRating = $allRating->count();
        foreach ($allRating as $rating) {
            $sumRating += $rating->rating;
        }
        $averageRating = $numRating > 0 ? $sumRating / $numRating : 0;
        $totalRatings = $allRating->count();

        /* count no. of ratings for 1 to 5 stars in array format */
        $num_ratings = [];
        for ($i = 1; $i <= 5; $i++) {
            $num_ratings[$i] = $allRating->where('rating', $i)->count();
        }
        return view('customer.products.view', compact('product', 'allRating', 'averageRating', 'totalRatings', 'num_ratings'));
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

    public function sellerDashboard()
    {
        $seller = Seller::where('user_id', auth()->id())->first();
        $totalProducts = $seller->products->count();
        $totalCategories = $seller->categories->count();
        $totalOrders = $seller->orders->count();



        //return response($graphData, 200);

        return view('seller.dashboard', compact('totalProducts', 'totalCategories', 'totalOrders'));
    }
}
