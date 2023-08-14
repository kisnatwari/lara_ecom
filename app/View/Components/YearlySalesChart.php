<?php

namespace App\View\Components;

use App\Models\Order;
use App\Models\Seller;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class YearlySalesChart extends Component
{
    /**
     * Create a new component instance.
     */
    public $chartData;
    public function __construct()
    {
        $this->chartData = $this->getChartData();
        //return dd($this->chartData);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.seller.yearly-sales-chart');
    }

    private function getChartData()
    {
        $startDate = Carbon::now()->subDays(365);
        $endDate = Carbon::now();

        $sellerID = Seller::where('user_id', auth()->user()->id)->first()->id;

        $data = Order::selectRaw('DATE(orders.created_at) as date, SUM(products.price * orders.quantity) as total')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where(['status_id' => 3, 'seller_id' => $sellerID])
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $chartData = [
            'labels' => $data->pluck('date')->toArray(),
            'data' => $data->pluck('total')->toArray(),
        ];

        return $chartData;
    }
}
