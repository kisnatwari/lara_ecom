<?php

namespace App\View\Components;

use App\Models\Order;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BarGraph extends Component
{
    /**
     * Create a new component instance.
     */
    public $graphData;
    public function __construct()
    {

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

        $this->graphData = [
            $monthNames,
            $orderAmounts,
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.seller.bar-graph');
    }
}
