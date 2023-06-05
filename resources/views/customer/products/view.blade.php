@extends('customer.index')

@section('children')
    <div class="h-full p-3 overflow-auto">
        @php
            $images = json_decode($product->images, true);
            $mainImage = $images[0];
            if (strpos($mainImage, 'https://') !== 0 && strpos($mainImage, 'http://') !== 0) {
                $mainImageUrl = Storage::url($mainImage);
            } else {
                $mainImageUrl = $mainImage;
            }
        @endphp
        <div class="h-full dark:bg-gray-800 bg-white overflow-auto">
            <div class="lg:h-full grid grid-flow-row lg:grid-cols-2">
                <div class="p-2 max-h-max lg:max-h-full overflow-auto flex flex-col justify-center items-start">
                    <div class="flex-grow mx-auto">
                        <img src="{{ $mainImageUrl }}" alt="" class="w-full mx-auto h-full object-contain"
                            id="main-image">
                    </div>
                    <div class="grid grid-flow-col gap-4 p-4">
                        @php $c = 0; @endphp
                        @foreach ($images as $image)
                            @php
                                if (strpos($image, 'https://') !== 0 && strpos($image, 'http://') !== 0) {
                                    $imageUrl = Storage::url($image);
                                } else {
                                    $imageUrl = $image;
                                }
                            @endphp
                            <div class="cursor-pointer max-h-16"
                                onclick="document.getElementById('main-image').src='{{ $imageUrl }}'">
                                <img src="{{ $imageUrl }}" alt=""
                                    class="w-full h-full max-h-16 max-w-16 object-contain {{$c++ == 0 ? 'border-2 border-purple-500':''}}">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="p-3 h-full overflow-auto">
                    <div class="h-full dark:bg-gray-800 dark:text-gray-300 text-gray-700 rounded-lg p-4 overflow-auto">
                        <h1 class="text-4xl mb-3 font-bold dark:text-gray-300 text-gray-700">{{ $product->product_name }}
                        </h1>
                        <p class="text-lg mb-2">Brand: {{ $product->brand->brand_name }}</p>
                        <p class="text-lg mb-2">{{ $product->category->name }}</p>
                        <p class="text-lg mb-2">Rs {{ $product->price }}</p>
                        <p class="text-lg mb-2">Available Quantity: {{ $product->quantity }} units</p>
                        <div class="flex gap-1 text-lg">
                            @for ($i = 0; $i < 5; $i++)
                                <i class="fa fa-star text-yellow-500"></i>
                            @endfor
                        </div>
                        <div class="p-2 my-3 dark:bg-gray-800 rounded-md dark:text-gray-300 text-gray-900">
                            <pre class="whitespace-pre-wrap text-justify">{{ $product->description }}</pre>
                        </div>
                        <div class="flex items-center justify-end mt-4 gap-3">
                            <div class="flex items-center">
                                <span class="mr-3">Quantity:</span>
                                <input type="number"
                                    class="w-16 px-3 py-2 border rounded-md bg-transparent dark:text-gray-50 text-gray-700 focus:outline-none focus:border-purple-500"
                                    value="1" min="1" max={{ $product->quantity }}>
                            </div>
                            <button
                                class="bg-gradient-to-tr from-indigo-500 via-indigo-600 to-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fa fa-shopping-cart"></i> Add to cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const mainImage = document.getElementById('main-image');
        const gridImages = document.querySelectorAll('.grid img');
        gridImages.forEach(image => {
            image.addEventListener('click', () => {
                mainImage.src = image.src;
                gridImages.forEach(img => img.classList.remove('border-2', 'border-purple-600'));
                image.classList.add('border-2', 'border-purple-600');
            });
        });
    </script>
@endsection
