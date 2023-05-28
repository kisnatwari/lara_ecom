@extends('seller.layouts')
@section('content')
    <div class="h-full p-3 overflow-auto">
        <div class="h-full bg-slate-800/80 overflow-auto">
            <div class="lg:h-full grid grid-flow-row lg:grid-cols-2">
                <div class="p-2 max-h-max lg:max-h-full overflow-auto flex justify-center items-center">
                    <img src="{{ Storage::url(json_decode($product->images, true)[1]) }}" alt=""
                        class="w-full h-full object-contain">
                </div>
                <div class="p-3 h-full overflow-auto">
                    <div class="h-full bg-slate-900/80 text-slate-400 rounded-lg p-4 overflow-auto">
                        <h1 class="text-4xl mb-3 font-bold text-slate-300">{{ $product->product_name }}</h1>
                        <p class="text-lg mb-2">Brand: {{ $product->brand->brand_name }}</p>
                        <p class="text-lg mb-2">{{ $product->category->name }}</p>
                        <p class="text-lg mb-2">Rs {{ $product->price }}</p>
                        <p class="text-lg mb-2">Available Quantity: {{ $product->quantity }} units</p>
                        <div class="flex gap-1 text-lg">
                            @for ($i = 0; $i < 5; $i++)
                                <i class="fa fa-star text-yellow-500"></i>
                            @endfor
                        </div>
                        <div class="p-2 my-3 bg-slate-800 rounded-md text-slate-300">
                            <pre class="whitespace-pre-wrap text-justify">{{ $product->description }}</pre>
                        </div>
                        <div class="flex justify-end">

                            <a href="{{route('products.edit', $product->id)}}"
                                class="bg-indigo-500 text-white h-fit px-4 py-2 rounded-md mr-2 hover:bg-indigo-600"> 
                                <i class="fa fa-edit"></i>&nbsp; Edit</a>
                            <form action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                                    <i class="fa fa-trash"></i>&nbsp; Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection