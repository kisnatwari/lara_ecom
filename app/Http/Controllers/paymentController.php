<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class paymentController extends Controller
{

  public function getCartAmount($sellerId)
  {
    $userId = auth()->user()->id;
    $cartItems = Cart::where('carts.user_id', $userId)
      ->join('products', 'carts.product_id', '=', 'products.id')
      ->join('sellers', 'products.seller_id', '=', 'sellers.id')
      ->select(
        'sellers.id as seller_id',
        'carts.quantity as units',
        'products.price as unit_price',
        DB::raw('carts.quantity * products.price as total_price'),
      )
      ->where('sellers.id', $sellerId)
      ->get()
      ->toArray();

    $total_price = 0;
    if (count($cartItems))
      foreach ($cartItems as $cartItem)
        $total_price += $cartItem['total_price'];
        
    return $total_price * 100;
  }

  public function verify(Request $request)
  {  // payload
    $price = $this->getCartAmount($request->seller);
    $price = ($price >= 20000) ? 19999 : $price;
    $args = http_build_query(array(
      'token' => $request->token,
      'amount'  => $price
    ));

    $url = "https://khalti.com/api/v2/payment/verify/";

    # Make the call using API.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $headers = ['Authorization: Key test_secret_key_02a9e293c3c24b788ff0a9a9f8364bd4'];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Response
    $response = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status_code == 200) {
      return response()->json([
        'success' => 1,
        'successResponse' => json_decode($response)
      ]);
    } else {
      return response([
        "error" => 1,
        'redirecto' => route('shop', 2),
        'errorResponse' => $response
      ]);
    }
  }


  public function order(Request $request)
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
                  'status_id' => '1'
              ]);

              // Remove the ordered item from the cart
              $cartItem->delete();
          }

          return redirect()->back()->with('success', 'Products ordered successfully.');
      }

      return response(["error" => "invalid seller data"], 400);
  }

}
