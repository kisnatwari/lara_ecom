@extends('seller.layouts')

@section('content')
    <div class='p-2 h-full overflow-hidden'>
        <div class='bg-slate-900/80 h-full overflow-auto flex-grow flex flex-col gap-5 p-4'>
            <div class='flex justify-between'>
                <h1 class='text-xl font-bold'>All Products</h1>
                <a href="/seller/products/create"
                    class='bg-gradient-to-tr from-indigo-800 to-purple-800 hover:brightness-90 active:brightness-95 duration-300 px-4 py-2 rounded-md flex items-center gap-2'>
                    <span>Add Products</span>
                </a>
            </div>
            <div class='flex-grow'>
                <!-- Content for No products found -->
                @if (count($products) == 0)
                    <div class=" flex h-full justify-center items-center">
                        <div class='text-center'>
                            <i class="fa fa-close text-5xl"></i>
                            <h1 class='text-3xl font-bold dark:text-slate-200'>No products found</h1>
                            <p class='text-slate-300 dark:text-slate-400'>
                                You haven't added any products yet.
                            </p>
                            <p class='text-slate-300 dark:text-slate-400'>
                                You can add products by clicking the button above.
                            </p>
                        </div>
                    </div>
                @else
                    <div
                        class="grid container grid-cols-1 gap-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-7 2xl:grid-cols-8">
                        {{-- Display Products --}}
                        @foreach ($products as $product)
                            <a href="/seller/products/{{ $product->id }}"
                                class="w-32 lg:36 mx-auto my-2 shadow-2xl bg-slate-800 text-gray-200 overflow-hidden rounded-md">
                                <img src="{{ Storage::url(json_decode($product->images, true)[1]) }}" alt="" class="h-32 lg:36 w-full object-contain rounded-b-xl">
                                <div class="px-2 py-1">
                                    <h5 class="text-md truncate">{{ $product->product_name }}</h5>
                                    <p class="text-end"></p>
                                    <p class="text-xs font-bold gap-1 flex flex-wrap justify-between text-slate-300">
                                        <span>{{ $product->brand->brand_name }}</span>
                                        <span>{{ $product->category->name }}</span>
                                    </p>
                                    <p class="text-sm font-bold"><small class="text-muted">Rs
                                            {{ $product->price }}</small>
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>


@endsection
