@isset($productsFromMunicipality)

    <div class="w-full bg-slate-50 dark:bg-slate-800 text-slate800 dark:text-slate-200 py-2">
        <div class="container mx-auto">
            <h1 class="text-center text-lg flex justify-between items-end">
                <span>Products in your area ({{ auth()->user()->municipality->municipality_name }})</span>
                <a href="#" class="text-sm dark:text-indigo-300 text-indigo-700">See All</a>
            </h1>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-8 gap-2">
                @foreach ($productsFromMunicipality as $product)
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
                            <p data-href="{{ route('shop', $product->seller->id) }}"
                                class="dynamic-link text-sm dark:text-slate-400 text-slate-700 line-clamp-1"
                                title="{{ $product->seller->shop_name }}">
                                {{ $product->seller->shop_name }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endisset

@isset($productsFromDistrict)
    <div class="w-full bg-slate-50 dark:bg-slate-800 text-slate800 dark:text-slate-200 py-2">
        <div class="container mx-auto">
            <h1 class="text-center text-lg flex justify-between items-end">
                <span>Products in your District ({{ auth()->user()->municipality->district->district_name }})</span>
                <a href="#" class="text-sm dark:text-indigo-300 text-indigo-700">See All</a>
            </h1>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-8 gap-2">
                @foreach ($productsFromDistrict as $product)
                    <a href="/products/{{ $product->id }}"
                        class="mx-auto my-2 shadow w-44 sm:w-52 md:w-[185px] lg:w-[200px] xl:w-52 2xl:w-[185px] dark:bg-slate-900/60 dark:text-slate-200 text-slate-700 overflow-hidden rounded-md bg-white">

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
                            <h5 class="text-md line-clamp-1" title="{{ $product->product_name }}">
                                {{ $product->product_name }}</h5>
                            <p class="text-sm font-bold"><small class="text-muted" title="{{ $product->price }}">Rs
                                    {{ $product->price }}</small></p>
                            <p data-href="{{ route('shop', $product->seller->id) }}"
                                class="dynamic-link text-sm dark:text-slate-400 text-slate-700 line-clamp-1"
                                title="{{ $product->seller->shop_name }}">
                                {{ $product->seller->shop_name }}
                            </p>
                            <p class="text-sm dark:text-slate-400 text-slate-700"
                                title="{{ $product->seller->user->municipality->municipality_name }} ">
                                {{ $product->seller->user->municipality->municipality_name }} </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endisset

@if (isset($randomProducts) && count($randomProducts) > 0)
    <div class="w-full bg-slate-50 dark:bg-slate-800 text-slate800 dark:text-slate-200 py-2">
        <div class="container mx-auto">
            <h1 class="text-center text-lg flex justify-between items-end">
                <span>Some Random Products</span>
                <a href="#" class="text-sm dark:text-indigo-300 text-indigo-700">See All</a>
            </h1>
            <div
                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-8 gap-2">
                @foreach ($randomProducts as $product)
                    <a href="/products/{{ $product->id }}"
                        class="mx-auto my-2 shadow w-44 sm:w-52 md:w-[185px] lg:w-[200px] xl:w-52 2xl:w-[185px] dark:bg-slate-900/60 dark:text-slate-200 text-slate-700 overflow-hidden rounded-md bg-white">

                        @php
                            $image = json_decode($product->images, true)[0];
                            if (strpos($image, 'https://') !== 0 && strpos($image, 'http://') !== 0) {
                                $imageUrl = Storage::url($image);
                            } else {
                                $imageUrl = $image;
                            }
                            
                            $addressGroup = $product->seller->user->municipality->district->district_name . ' (' . $product->seller->user->municipality->municipality_name . ')';
                            
                        @endphp
                        <img src="{{ $imageUrl }}" alt=""
                            class="h-44 sm:h-52 md:h-[185px] lg:h-[200px] xl:h-52 2xl:h-[185px] w-full object-cover rounded-b">
                        <div class="px-2 py-1">
                            <h5 class="text-md line-clamp-1" title="{{ $product->product_name }}">
                                {{ $product->product_name }}</h5>
                            <p class="text-sm font-bold">
                                <small class="text-muted" title="{{ $product->price }}">Rs
                                    {{ $product->price }}</small>
                            </p>
                            <p data-href="{{ route('shop', $product->seller->id) }}"
                                class="dynamic-link text-sm dark:text-slate-400 text-slate-700 line-clamp-1"
                                title="{{ $product->seller->shop_name }}">
                                {{ $product->seller->shop_name }}
                            </p>
                            <p class="text-xs line-clamp-1" title="{{ $addressGroup }}">
                                <span class="font-bold dark:text-slate-300 text-slate-700">{{ $addressGroup }}</span>
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif
