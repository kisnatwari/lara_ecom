<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TrendingProductsChart extends Component
{
    public $trendingProducts;

    public function __construct()
    {
        $this->trendingProducts = $this->getChartData();
    }

    public function render(): View|Closure|string
    {
        return view('components.seller.trending-products-chart');
    }

    private function getChartData()
    {
        $startDate = Carbon::now()->subDays(365);
        $endDate = Carbon::now();

        $sellerId = Seller::where('user_id', auth()->user()->id)->first()->id;

        $startDate = Carbon::now()->subMonth(12);

        // $data = $startDate = Carbon::parse('2023-07-19 05:13:19');

        $trendingProducts = Product::select('products.id', 'products.product_name', DB::raw('SUM(orders.quantity) AS total_quantity'))
            ->join('orders', 'products.id', '=', 'orders.product_id')
            ->where('orders.created_at', '>=', $startDate)
            ->where('orders.status_id', 3)
            ->where('products.seller_id', $sellerId)
            ->orderBy('total_quantity', 'desc')
            ->groupBy('products.id', 'products.product_name')
            ->limit(5)
            ->get();

        //dd($trendingProducts);


        $trendingProducts = [
            'labels' => $trendingProducts->pluck('product_name')->toArray(),
            'data' => $trendingProducts->pluck('total_quantity')->toArray(),
        ];

        return $trendingProducts;
    }
}
