<div class="w-full bg-slate-800 py-2">
    <div class="container mx-auto">
        <h1 class="text-center text-lg flex justify-between items-end">
            <span>Products in your area</span>
            <a href="#" class="text-sm text-indigo-300">See All</a>
        </h1>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-7 xl:grid-cols-9 2xl:grid-cols-10 gap-2">
            @foreach ($productsFromMunicipality as $product)
                <a href="/products/{{ $product->id }}"
                    class="mx-auto my-2 shadow-2xl bg-slate-900/60 text-gray-200 overflow-hidden rounded-md">

                    @php
                        $image = json_decode($product->images, true)[1];
                        if (strpos($image, 'https://') !== 0 && strpos($image, 'http://') !== 0) {
                            $imageUrl = Storage::url($image);
                        } else {
                            $imageUrl = $image;
                        }
                        
                    @endphp
                    <img src="{{ $imageUrl }}" alt="" class="h-32 lg:36 w-full object-contain rounded-b-xl">
                    <div class="px-2 py-1">
                        <h5 class="text-md line-clamp-1">{{ $product->product_name }}</h5>
                        <p class="text-sm font-bold"><small class="text-muted">Rs {{ $product->price }}</small></p>
                        <p class="text-xs text-slate-400 line-clamp-1">{{ $product->seller->shop_name }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

<div class="w-full bg-slate-800 py-2">
    <div class="container mx-auto">
        <h1 class="text-center text-lg flex justify-between items-end">
            <span>Products in your District</span>
            <a href="#" class="text-sm text-indigo-300">See All</a>
        </h1>
        <div
            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-7 xl:grid-cols-9 2xl:grid-cols-10 gap-2">
            @foreach ($productsFromDistrict as $product)
                <a href="/products/{{ $product->id }}"
                    class="mx-auto my-2 shadow-2xl bg-slate-900/60 text-gray-200 overflow-hidden rounded-md">

                    @php
                        $image = json_decode($product->images, true)[1];
                        if (strpos($image, 'https://') !== 0 && strpos($image, 'http://') !== 0) {
                            $imageUrl = Storage::url($image);
                        } else {
                            $imageUrl = $image;
                        }
                        
                    @endphp
                    <img src="{{ $imageUrl }}" alt="" class="h-32 lg:36 w-full object-contain rounded-b-xl">
                    <div class="px-2 py-1">
                        <h5 class="text-md line-clamp-1" title="{{ $product->product_name }}">
                            {{ $product->product_name }}</h5>
                        <p class="text-sm font-bold"><small class="text-muted" title="{{ $product->price }}">Rs
                                {{ $product->price }}</small></p>
                        <p class="text-sm text-slate-400 line-clamp-1" title="{{ $product->seller->shop_name }}">
                            {{ $product->seller->shop_name }}</p>
                        <p class="text-sm text-slate-400"
                            title="{{ $product->seller->user->municipality->municipality_name }} ">
                            {{ $product->seller->user->municipality->municipality_name }} </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>


<div class="w-full bg-slate-800 py-2">
    <div class="container mx-auto">
        <h1 class="text-center text-lg flex justify-between items-end">
            <span>Some Other Random Products</span>
            <a href="#" class="text-sm text-indigo-300">See All</a>
        </h1>
        <div
            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-7 xl:grid-cols-9 2xl:grid-cols-10 gap-2">
            @foreach ($randomProducts as $product)
                <a href="/products/{{ $product->id }}"
                    class="mx-auto my-2 shadow-2xl bg-slate-900/60 text-gray-200 overflow-hidden rounded-md">

                    @php
                        $image = json_decode($product->images, true)[1];
                        if (strpos($image, 'https://') !== 0 && strpos($image, 'http://') !== 0) {
                            $imageUrl = Storage::url($image);
                        } else {
                            $imageUrl = $image;
                        }
                        
                    @endphp
                    <img src="{{ $imageUrl }}" alt=""
                        class="h-32 lg:36 w-full object-contain rounded-b-xl">
                    <div class="px-2 py-1">
                        <h5 class="text-md line-clamp-1" title="{{ $product->product_name }}">
                            {{ $product->product_name }}</h5>
                        <p class="text-sm font-bold">
                            <small class="text-muted" title="{{ $product->price }}">Rs {{ $product->price }}</small>
                        </p>
                        <p class="text-sm text-slate-400 line-clamp-1" title="{{ $product->seller->shop_name }}">
                            {{ $product->seller->shop_name }}
                        </p>
                        <p class="text-sm text-slate-400 line-clamp-1"
                            title="{{ $product->seller->user->municipality->municipality_name }} ">
                            <span class="font-bold text-slate-300">
                                {{ $product->seller->user->municipality->district->district_name }}
                            </span>
                            <span class="text-xs font-bold text-slate-300">
                                ({{ $product->seller->user->municipality->municipality_name }})
                            </span>
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
