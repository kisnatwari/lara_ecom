<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $user = auth()->user();

        $countPurchases = Order::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->where('status_id', '3')
            ->count();

        if ($countPurchases == 0)
            return redirect('/');

        $userRating = Rating::where('user_id', $user->id)->where('product_id', $product->id)->first();
        $allRating = Rating::where('product_id', $product->id)->get();



        // Calculate the average rating
        $sumRating = 0;
        $numRating = $allRating->count();
        foreach ($allRating as $rating) {
            $sumRating += $rating->rating;
        }
        $averageRating = $numRating > 0 ? $sumRating / $numRating : 0;

        $totalRatings = $allRating->count();

        /* count no. of ratings for 1 to 5 stars in array format */
        $num_ratings = [];
        for ($i = 1; $i <= 5; $i++) {
            $num_ratings[$i] = $allRating->where('rating', $i)->count();
        }

        // Remove the user rating from allRating
        $allRating = $allRating->reject(function ($rating) use ($userRating) {
            return $rating->id === optional($userRating)->id;
        });

        return view('customer.rating', compact('product', 'userRating', 'allRating', 'averageRating', 'totalRatings', 'num_ratings'));
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
    public function store(Request $request, Product $product)
    {
        $user = auth()->user();

        $request->validate([
            'star-rating' => 'required|integer|between:1,5',
            'comment' => 'required|min:3',
        ]);

        // Check if the user has already rated this product
        $existingRating = Rating::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($existingRating) {
            // User has already rated, you can update their rating and comment here if needed
            // Redirect back with a message indicating they've already rated
            return redirect()->back()->with('message', 'You have already rated this product.');
        }

        // Create a new rating
        $rating = new Rating();
        $rating->user_id = $user->id;
        $rating->product_id = $product->id;
        $rating->rating = $request->input('star-rating');
        $rating->comment = $request->input('comment');
        $rating->save();

        // Redirect back with a success message
        return redirect()->back()->with('message', 'Rating and comment posted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        $user = auth()->user();

        // Check if the authenticated user owns the rating
        if ($rating->user_id !== $user->id) {
            // Redirect back with an error message indicating unauthorized access
            return redirect()->back()->with('error', 'You are not authorized to delete this rating.');
        }

        // Delete the rating
        $rating->delete();

        // Redirect back with a success message
        return redirect()->back()->with('message', 'Rating and comment deleted successfully.');
    }
}