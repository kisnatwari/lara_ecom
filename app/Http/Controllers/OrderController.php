<?php

namespace App\Http\Controllers;

use App\Mail\orderSuccessMail;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

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
        $request->validate([
            'shop_id' => 'required|numeric',
            'total_amount' => 'required|numeric',
            '_token' => 'required|string',
            'payment_mode' => 'required|string',
        ]);
        $userId = auth()->user()->id;
        $shopId = $request->shop_id;
        $payment_mode = $request->payment_mode;

        if ($shopId) {
            $cartItems = Cart::where('user_id', $userId)
                ->whereHas('product', function ($query) use ($shopId) {
                    $query->where('seller_id', $shopId);
                })->get();

            // Loop through the cart items and create an order for each item
            foreach ($cartItems as $cartItem) {

                $order = new Order();
                $order->user_id = $userId;
                $order->product_id = $cartItem->product_id;
                $order->quantity = $cartItem->quantity;
                $order->status_id = 1;
                $order->payment_mode = $payment_mode;
                $order->save();

                // Remove the ordered item from the cart
                $cartItem->delete();
            }

            Mail::to(auth()->user()->email)->send(new orderSuccessMail(null));

            return redirect('/order-success');
        }

        return response(["error" => "invalid seller data"], 400);
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
