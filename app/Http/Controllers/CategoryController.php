<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Seller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view("seller.categories.index", compact('categories'));
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
            'name' => 'required|unique:categories|max:255',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->seller_id = auth()->user()->seller->id;
        $category->save();

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        if (auth()->user()->seller->id !== $category->seller_id) {
            return response(["message" => "You are not allowed to perform this action"], 403);
        }

        $category->name = $request->name;
        $category->save();

        return response()->json(['success' => true, 'name' => $category->name]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        if (auth()->user()->seller->id !== $category->seller_id)
            return response(["message" => "You are not allowed to perform this action"], 403);

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
