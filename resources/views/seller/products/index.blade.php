@extends('seller.layouts')

@section('content')
    @php
        print_r(json_decode($products[0]->images, true)[1]);
    @endphp
    <div>
        <div class='p-2 h-full overflow-auto flex flex-col gap-2'>
            <div class='bg-white/5 flex-grow flex flex-col p-4'>
                <div class='flex justify-between'>
                    <h1 class='text-xl font-bold'>All Products</h1>
                    <a href="/seller/products/create"
                        class='bg-gradient-to-tr from-indigo-800 to-purple-800 hover:brightness-90 active:brightness-95 duration-300 px-4 py-2 rounded-md flex items-center gap-2'>
                        <span>Add Products</span>
                    </a>
                </div>
                <div class='flex-grow flex justify-center items-center'>
                    <!-- Content for No products found -->
                    @if (count($products) == 0)
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
                    @else
                        <div
                            class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6">
                            {{-- Display Products --}}
                            @foreach ($products as $product)
                                <div class="w-40 h-56 border border-rose-200 overflow-hidden">
                                    <img src="{{ Storage::url('public/uploads/L43ddF9aRX5ojdYMv66u4bd9Xxfk8aqwz9kmz0b1.jpg') }}"
                                        alt="" class="h-40 w-full object-cover">
                                    <div class="p-4">
                                        <h5 class="text-xl font-bold">{{ $product->product_name }}</h5>
                                        <p class="text-sm">{{ $product->category->category_name }}</p>
                                        <p class="text-sm"><small class="text-muted">Price: Rs {{ $product->price }}</small>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
@endsection
