<?php

namespace App\Http\Controllers;

use App\Mail\MyMailer;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    public function index()
    {
        $sellerId = auth()->user()->seller->id;

        // $orders = Order::whereHas('product.seller', function ($query) use ($sellerId) {
        //     $query->where('seller_id', $sellerId);
        // })
        //     ->with(['product', 'user.municipality.district'])
        //     ->orderBy('created_at', 'desc')
        //     ->where('status_id', '<', '3')
        //     ->paginate(20);

        $orders = Order::join('products', 'products.id', "=", "orders.product_id")
            ->join("users", "users.id", "=", "orders.user_id")
            ->with(["product", "user.municipality.district"])
            ->where("seller_id", "=", $sellerId)
            ->select("orders.*")
            ->orderBy("created_at", "desc")
            ->where('status_id', '<', '3')
            ->paginate(20);

        return view('seller.orders.index', compact('orders'));
    }

    public function completedOrders()
    {
        $sellerId = auth()->user()->seller->id;
        // $orders = Order::whereHas('product.seller', function ($query) use ($sellerId) {
        //     $query->where('seller_id', $sellerId);
        // })
        //     ->with(['product', 'user.municipality.district'])
        //     ->orderBy('created_at', 'desc')
        //     ->where('status_id', '=', '3')
        //     ->paginate(15);

        $orders = Order::join('products', 'products.id', "=", "orders.product_id")
            ->join("users", "users.id", "=", "orders.user_id")
            ->with(["product", "user.municipality.district"])
            ->where("seller_id", "=", $sellerId)
            ->select("orders.*")
            ->orderBy("created_at", "desc")
            ->where('status_id', '=', '3')
            ->paginate(20);

        $groupedOrders = $orders->groupBy('user_id');

        return view('seller.orders.completed', compact('groupedOrders'));
    }

    public function myOrders()
    {
        $userId = auth()->id();
        $orders = Order::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('customer.myorders', compact('orders'));
    }


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


            // Check the availability of each item in the cart
            foreach ($cartItems as $cartItem) {
                $product = $cartItem->product;
                $orderedQuantity = $cartItem->quantity;

                if ($product->quantity < $orderedQuantity) {
                    return response(["error" => "Ordered quantity is not available in stock"], 400);
                }
            }

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

            $mailData = [
                "subject" => "Product Ordered Successfully",
                "view" => "mail.order-success"
            ];

            Mail::to(auth()->user()->email)->send(new MyMailer($mailData));

            return redirect('/order-success');
        }

        return response(["error" => "invalid seller data"], 400);
    }

    public function order_cancel(Order $order)
    {
        // Check if the order exists
        if ($order) {
            // Send cancellation email to the customer
            $mailData = [
                "subject" => "Product Order Canceled",
                "view" => "mail.order-rejected",
                "with" => ["order" => $order]
            ];

            Mail::to(auth()->user()->email)->send(new MyMailer($mailData));

            // Delete the order from the database
            $order->delete();

            return redirect()->back();
        }

        return response(["error" => "Invalid order data"], 400);
    }

    public function order_delivery(Order $order)
    {
        // Check if the order exists
        if (!$order) {
            return response(["error" => "Invalid order data"], 400);
        }

        // Check if the order exists
        if (!$order) {
            return response(["error" => "Invalid order data"], 400);
        }

        $product = $order->product;
        $orderedQuantity = $order->quantity;

        if ($product->quantity < $orderedQuantity) {
            return response(["error" => "Ordered quantity is not available in stock"], 400);
        }

        // Update the order status to "delivered"
        $order->status_id = 2;
        $order->save();

        $product = $order->product;
        $product->quantity -= $order->quantity;
        $product->save();

        // Send delivery confirmation email to the customer
        $mailData = [
            "subject" => "Product Out for delivery",
            "view" => "mail.order-delivery",
            "with" => ["order" => $order]
        ];

        Mail::to(auth()->user()->email)->send(new MyMailer($mailData));

        return redirect()->back();
    }


    public function order_delivered(Order $order)
    {
        // Check if the order exists
        if (!$order) {
            return response(["error" => "Invalid order data"], 400);
        }

        // Update the order status to "delivered"
        $order->status_id = 3; // Assuming 3 represents "delivered" status
        $order->save();

        // Perform any additional actions related to the delivery process
        // For example, send a delivery confirmation email to the customer

        $mailData = [
            "subject" => "Product Order Delivered",
            "view" => "mail.order-delivered",
            "with" => ["order" => $order]
        ];

        Mail::to(auth()->user()->email)->send(new MyMailer($mailData));

        return redirect()->back();
    }
}