@extends('customer.index')

@section('children')
    <div class="flex flex-col gap-1 mt-1">
        <div class="w-full bg-slate-50 dark:bg-slate-800">
            <div class="container mx-auto flex p-2 justify-between items-center">
                <div class="flex gap-3">
                    <img src="{{ Storage::url('/categories/' . $shopcategory->name . '.jpg') }}" alt=""
                        class="w-10 h-10 object-cover rounded-full">
                    <h1 class="text-3xl text-slate-700 dark:text-slate-200">{{ $shopcategory->name }}</h1>
                </div>
                <p>{{ $products->count() }} sellers found in your area.</p>
            </div>
            <div class="container">
                <h1>Related shops found in your municipality</h1>
                <p>Total number of fetched sellers: {{ $products->count() }}</p>
                @foreach ($products as $seller_id => $seller_products)
                    <h2>Seller: {{ $seller_products->first()->seller->shop_name }} & {{$seller_id}}</h2>
                @endforeach
            </div>
            <div class="container">
                <h1>Related Products found in your municipality</h1>
                {{-- Show the Product cards --}}
            </div>
        </div>
    </div>
@endsection
