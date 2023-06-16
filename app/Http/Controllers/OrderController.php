<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
/*     public function index()
    {
        $seller = auth() -> user()->seller;
        $orders = $seller -> orders;
        return view('seller.orders.index', compact('orders'));
    } */

    public function index()
    {
        $sellerId = auth()->user()->seller->id;
        $orders = Order::whereHas('product.seller', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })
            ->with(['product', 'user.municipality.district'])
            ->orderBy('created_at', 'desc')
            ->get();

        $groupedOrders = $orders->groupBy('user_id');

        //return response($groupedOrders);

        return view('seller.orders.index', compact('groupedOrders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
