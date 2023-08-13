@extends('seller.layouts')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="container mx-auto px-4 py-8 dark:bg-gray-900 text-slate-800 dark:text-slate-300/90">
        <h1 class="text-3xl font-bold mb-4">Seller Dashboard</h1>
        <div class="flex flex-row flex-wrap gap-4 justify-center">
            <div class="flex flex-col gap-4 flex-grow">
                <div class="dark:bg-gray-800 border-l-8 border-indigo-700 rounded-lg shadow-lg p-4">
                    <h2 class="text-xl font-bold mb-2">Total Products</h2>
                    <p class="text-2xl">{{ $totalProducts }}</p>
                </div>
                <div class="dark:bg-gray-800 border-l-8 border-indigo-700 rounded-lg shadow-lg p-4">
                    <h2 class="text-xl font-bold mb-2">Total Categories</h2>
                    <p class="text-2xl">{{ $totalCategories }}</p>
                </div>
                <div class="dark:bg-gray-800 border-l-8 border-indigo-700 rounded-lg shadow-lg p-4">
                    <h2 class="text-xl font-bold mb-2">Total Orders</h2>
                    <p class="text-2xl">{{ $totalOrders }}</p>
                </div>
            </div>
            <div class="flex-1">
                <div class="bg-slate-200/75  dark:bg-slate-800/50 flex-grow p-2 flex items-end ">
                    <div class="flex-1">
                        <x-trending-products-chart />
                    </div>
                </div>
            </div>
        </div>
        <div class="my-4 flex flex-row flex-wrap gap-2">
            <div class="bg-slate-200/75  dark:bg-slate-800/50 flex-grow p-2 flex items-end ">
                <div class="flex-1">
                    <x-yearly-sales-chart />
                </div>
            </div>
            <div class="bg-slate-200/75 dark:bg-slate-800/50 flex-grow p-2 flex items-end">
                <div class="flex-grow">
                    <x-pie-chart />
                </div>
            </div>
            <div class="bg-slate-200/75  dark:bg-slate-800/50 flex-grow p-2 flex items-end ">
                <div class="flex-grow">
                    <x-bar-graph />
                </div>
            </div>
        </div>
    </div>
@endsection
