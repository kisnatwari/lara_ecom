<?php

namespace App\View\Components;

use App\Models\Seller;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class PieChart extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $orders_label;
    public $orders_count;
    public function __construct()
    {
        $this->title = "Krishna";

        $seller_id = Seller::where('user_id', auth()->user()->id)->first()->id;

        $orders_grouped_payment = DB::table('orders')
            ->select(DB::raw('count(orders.id) as order_count, payment_mode'))
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('status_id', '=', '3')
            ->where('products.seller_id', '=', $seller_id)
            ->groupBy('payment_mode')
            ->get();
        $this->orders_count = $orders_grouped_payment->pluck('order_count')->toArray();
        $this->orders_label = $orders_grouped_payment->pluck('payment_mode')->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.seller.pie-chart');
    }
}
