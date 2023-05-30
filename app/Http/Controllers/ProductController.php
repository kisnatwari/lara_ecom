<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $seller = Seller::where(['user_id' => auth()->id()])->first();
        $product = Product::find(1);
        return view('seller.products.index', ['products' => Product::where(['seller_id' => $seller->id])->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where(['seller_id' => auth()->user()->seller->id])->get();
        return view('seller.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required|numeric',
            'brand' => 'required',
            'quantity' => 'required|integer',
            'description' => 'required',
            'images' => 'nullable|array',
            'category_id' => 'exists:categories,id',
        ]);

        $brandName = $request->input('brand');
        $brand = Brand::firstOrCreate(['brand_name' => $brandName]);

        $images = [];
        for ($i = 0; $i < count($request->files->get('images')); $i++) {
            $file = $request->file('images')[$i];
            $path = $file->store('/public/uploads');
            $images[count($images) + 1] = $path;
        }

        $seller = Seller::where(['user_id' => auth()->id()])->first();

        $product = new Product([
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
            'brand_id' => $brand->id,
            'quantity' => $request->input('quantity'),
            'description' => $request->input('description'),
            'images' => json_encode($images),
            'category_id' => $request->input('category_id'),
            'seller_id' => $seller->id,
        ]);

        $product->save();

        return redirect()->back()->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        if (auth()->user()->seller->id !== $product->seller_id) {
            return response(["message" => "You are not authorized to perform this action"], 403);
        }
        return view("seller.products.product", compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = auth()->user()->seller->categories;
        return view("seller.products.edit", compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required|numeric',
            'brand' => 'required',
            'quantity' => 'required|integer',
            'description' => 'required',
            'images' => 'nullable|array',
            'category_id' => 'exists:categories,id',
        ]);

        $brandName = $request->input('brand');
        $brand = Brand::firstOrCreate(['brand_name' => $brandName]);

        $images = [];
        for ($i = 0; $i < count($request->files->get('images')); $i++) {
            $file = $request->file('images')[$i];
            $path = $file->store('/public/uploads');
            $images[count($images) + 1] = $path;
        }

        $product->update([
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
            'brand_id' => $brand->id,
            'quantity' => $request->input('quantity'),
            'description' => $request->input('description'),
            'images' => json_encode($images),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->back()->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
}
