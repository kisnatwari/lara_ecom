<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
        $userId = auth()->user()->id;
        $shopId = $request->shop_id;
        $payment_mode = $request -> payment_mode;
  
        if ($shopId) {
            $cartItems = Cart::where('user_id', $userId)
                ->whereHas('product', function ($query) use ($shopId) {
                    $query->where('seller_id', $shopId);
                })->get();
  
            // Loop through the cart items and create an order for each item
            foreach ($cartItems as $cartItem) {
                Order::create([
                    'user_id' => $userId,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'status_id' => '1',
                    'payment_mode' => $payment_mode
                ]);
  
                // Remove the ordered item from the cart
                $cartItem->delete();
            }
  
            //return redirect()->back()->with('success', 'Products ordered successfully.');
            return response(["success" => "Products ordered successfully"], 200);
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
