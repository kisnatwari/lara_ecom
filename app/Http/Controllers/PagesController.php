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


        $orders_grouped_payment = DB::table('orders')
            ->select(DB::raw('count(id) as order_count, payment_mode'))
            ->where('status_id', '=', '3')
            ->groupBy('payment_mode')
            ->get();
        $orders_count = $orders_grouped_payment->pluck('order_count')->toArray();
        $orders_label = $orders_grouped_payment->pluck('payment_mode')->toArray();


        // Get the current month and year
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Create an array of all months in the current year
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[date('F', mktime(0, 0, 0, $i, 1))] = 0;
        }

        // Retrieve the data and group by month
        $data = Order::selectRaw('MONTH(orders.created_at) as month, SUM(products.price * orders.quantity) as total')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->whereYear('orders.created_at', $currentYear)
            ->groupBy('month')
            ->get();

        // Format the data for the bar graph
        $graphData = [];
        foreach ($data as $item) {
            $month = date('F', mktime(0, 0, 0, $item->month, 1));
            $graphData[$month] = $item->total;
        }

        // Add future months with 0 amount to the graph data
        for ($i = $currentMonth + 1; $i <= 12; $i++) {
            $month = date('F', mktime(0, 0, 0, $i, 1));
            $graphData[$month] = 0;
        }

        // Merge the graph data with the months array
        $graphData = array_merge($months, $graphData);

        // Format the data for the bar graph
        $monthNames = [];
        $orderAmounts = [];
        foreach ($graphData as $month => $amount) {
            $monthNames[] = $month;
            $orderAmounts[] = $amount;
        }

        $graphData = [
            $monthNames,
            $orderAmounts,
        ];

        //return response($graphData, 200);

        return view('seller.dashboard', compact('totalProducts', 'totalCategories', 'totalOrders', 'orders_count', 'orders_label', 'graphData'));
    }
}
