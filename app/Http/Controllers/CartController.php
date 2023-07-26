<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $cartItems = Cart::where('carts.user_id', $userId)
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->join('sellers', 'products.seller_id', '=', 'sellers.id')
            ->select(
                'sellers.shop_name',
                'sellers.id as seller_id',
                'products.product_name',
                'carts.quantity as units',
                'products.price as unit_price',
                DB::raw('carts.quantity * products.price as total_price'),
                'products.id as product_id',
                'products.images'
            )
            ->orderBy('sellers.shop_name')
            ->get()
            ->groupBy('shop_name')
            ->toArray();

        return view('customer.cart', compact('cartItems'));
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
        // Validate the request data
        $validatedData = $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        $user = auth()->user();

        // Check if the product already exists in the user's cart
        $existingCart = $user->carts()->where('product_id', $validatedData['product_id'])->first();

        if ($existingCart) {
            // Calculate the total quantity after incrementing
            $totalQuantity = $existingCart->quantity + $validatedData['quantity'];

            // Get the product associated with the existing cart item
            $product = $existingCart->product;

            // Check if the total quantity exceeds the available stock
            if ($totalQuantity > $product->quantity) {
                return redirect()->back()->with('error', 'The requested quantity exceeds the available stock.');
            }

            // Increment the quantity of the existing cart item
            $existingCart->increment('quantity', $validatedData['quantity']);
        } else {
            // Create a new cart item
            $cart = $user->carts()->create($validatedData);
        }

        // Redirect to the cart index or show page
        return redirect()->back();
    }



    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $productId)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'quantity' => 'required|integer',
        ]);

        // Get the user ID
        $userId = auth()->user()->id;

        // Update the cart item with the new quantity
        Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->update(['quantity' => $validatedData['quantity']]);

        return redirect()->back()->with('success', 'Cart item quantity updated.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($productId)
    {
        $userId = auth()->user()->id;

        Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->delete();

        return redirect()->back()->with('success', 'Item removed from cart.');
    }


    public function order(Request $request)
    {
        $userId = auth()->user()->id;
        $shopId = $request->shop_id;

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
                    'status_id' => '1'
                ]);

                // Remove the ordered item from the cart
                $cartItem->delete();
            }

            return redirect()->back()->with('success', 'Products ordered successfully.');
        }

        return response(["error" => "invalid seller data"], 400);
    }

    public function orderAll(Request $request)
    {
        $userId = auth()->user()->id;
        $cartItems = Cart::where('user_id', $userId)->get();

        // Loop through the cart items and create an order for each item
        foreach ($cartItems as $cartItem) {
            Order::create([
                'user_id' => $userId,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'status_id' => 1
            ]);

            // Remove the ordered item from the cart
            $cartItem->delete();
        }

        return redirect()->back()->with('success', 'All products ordered successfully.');
    }
}
