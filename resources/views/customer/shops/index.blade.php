@extends('customer.index')

@section('children')
    <div class="flex flex-col gap-1 mt-1">
        <div class="w-full bg-slate-50 dark:bg-slate-800">
            <div class="container mx-auto flex gap-3">
                <div>
                    <img src="https://cdn1.iconfinder.com/data/icons/people-avatar-color-outline/64/11-boy-128.png"
                        alt="{{ $shop->shop_name }}" class="w-36 h-36 object-contain">
                </div>
                <div class="self-end my-2 flex flex-col gap-1 text-slate-700 dark:text-slate-300">
                    <h1 class="text-xl font-bold text-slate-800 dark:text-slate-200">
                        <i class="fa fa-shop mr-1"></i> {{ $shop->shop_name }}
                    </h1>
                    <p>
                        <i class="fa fa-map-marker-alt mr-1"></i>
                        {{ $shop->user->municipality->district->district_name }},
                        {{ $shop->user->municipality->municipality_name }},
                        <small>({{ $shop->user->ward }})</small>
                    </p>
                    <p>
                        <i class="fa fa-phone mr-1"></i>
                        {{ $shop->user->phone }}
                    </p>

                    <span class="text-yellow-500">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="w-full bg-slate-50 dark:bg-slate-800">
            <div class="container mx-auto py-3">
                <div class="w-full flex gap-1 justify-center flex-wrap" style="white-space: nowrap;">
                    @php
                        $categories = $shop->categories;
                        $currentCategoryId = request()->route('category') ? request()->route('category')->id : null;
                    @endphp
                    @isset($currentCategoryId)
                        <a href="{{ route('shop', ['shop' => $shop->id]) }}"
                            class="dark:bg-slate-300 dark:text-slate-800 bg-slate-700 text-slate-50  px-2 py-1 rounded-lg">
                            All Products
                        </a>
                    @endisset
                    @foreach ($categories as $category)
                        <a href="{{ route('shop.category', ['shop' => $shop->id, 'category' => $category->id]) }}"
                            class="dark:bg-slate-300 dark:text-slate-800 bg-slate-700 text-slate-50 px-2 py-1 rounded-lg
                             {{ $currentCategoryId == $category->id ? 'border-2 border-indigo-500 dark:bg-indigo-200 bg-indigo-800 text-white' : '' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="w-full bg-slate-50 dark:bg-slate-800">
            <div class="container mx-auto">
                <h1 class="text-lg font-bold">Available Products</h1>
                <div
                    class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-8 gap-2">
                    @foreach ($products as $product)
                        <a href="/products/{{ $product->id }}"
                            class="mx-auto my-2 shadow w-44 sm:w-52 md:w-[185px] lg:w-[200px] xl:w-52 2xl:w-[185px] bg-white dark:bg-slate-900/60 dark:text-slate-200 text-slate-700 overflow-hidden rounded-md">
                            @php
                                $image = json_decode($product->images, true)[0];
                                if (strpos($image, 'https://') !== 0 && strpos($image, 'http://') !== 0) {
                                    $imageUrl = Storage::url($image);
                                } else {
                                    $imageUrl = $image;
                                }
                            @endphp
                            <img src="{{ $imageUrl }}" alt=""
                                class="w-full h-44 sm:h-52 md:h-[185px] lg:h-[200px] xl:h-52 2xl:h-[185px] object-cover rounded-b">
                            <div class="px-2 py-1">
                                <h5 class="text-md line-clamp-1">{{ $product->product_name }}</h5>
                                <p class="text-sm font-bold"><small class="text-muted">Rs {{ $product->price }}</small></p>
                                <span class="text-yellow-500">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
                {{ $products->links() }}
            </div>
        </div>

    </div>
@endsection
