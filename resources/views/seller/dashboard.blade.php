@extends('seller.layouts')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Seller Dashboard</h1>
        <div class="grid grid-cols-2 gap-4">
            <div class="dark:bg-gray-700 border-l-8 border-indigo-700 rounded-lg shadow-lg p-4">
                <h2 class="text-xl font-bold mb-2">Total Products</h2>
                <p class="text-2xl">{{ $totalProducts }}</p>
            </div>
            <div class="dark:bg-gray-700 border-l-8 border-indigo-700 rounded-lg shadow-lg p-4">
                <h2 class="text-xl font-bold mb-2">Total Categories</h2>
                <p class="text-2xl">{{ $totalCategories }}</p>
            </div>
            <div class="dark:bg-gray-700 border-l-8 border-indigo-700 rounded-lg shadow-lg p-4">
                <h2 class="text-xl font-bold mb-2">Total Orders</h2>
                <p class="text-2xl">{{ $totalOrders }}</p>
            </div>
            
        </div>
    </div>
@endsection