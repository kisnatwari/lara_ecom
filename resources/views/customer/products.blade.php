<div class="w-full bg-slate-800 py-2">
    <div class="container mx-auto">
        <h1 class="text-center text-lg">Products For You</h1>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-7 xl:grid-cols-9 2xl:grid-cols-10 gap-2">
            @foreach ($products as $product)
                <a href="/seller/products/{{ $product->id }}"
                    class="mx-auto my-2 shadow-2xl bg-slate-900/60 text-gray-200 overflow-hidden rounded-md">
                    <img src="{{ Storage::url(json_decode($product->images, true)[1]) }}" alt=""
                        class="h-32 lg:36 w-full object-contain rounded-b-xl">
                    <div class="px-2 py-1">
                        <h5 class="text-md line-clamp-1">{{ $product->product_name }}</h5>
                        <p class="text-sm font-bold"><small class="text-muted">Rs {{ $product->price }}</small></p>
                        <p class="text-xs text-slate-400 line-clamp-1">{{$product -> seller->shop_name}}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
