@extends('customer.index')

@section('children')
    <div class="pt-2">
        <div class="bg-white/100 dark:bg-slate-800/75 py-5 mb-2">
            <div class="container mx-auto">
                @php
                    $districts = App\Models\District::all()->sortBy('district_name');
                @endphp
                <div class="bg-slate-200 dark:bg-slate-800 border-2 border-dashed border-slate-700 py-4 mx-2 mb-4 rounded-lg"
                    id="address-form-ui">
                    <div class="container mx-auto">
                        <h1 class="text-center text-lg">Searched products on other different cities</h1>
                        <form action="{{ route('search') }}" method="GET">
                            <div class="text-center">
                                <input
                                    class="rounded-md bg-white w-full max-w-xl py-3 px-4 mr-2 text-gray-700 leading-tight focus:outline-none focus:ring-0 border-0"
                                    id="search" type="text" placeholder="Search Products as per your choice......."
                                    name="query" value="{{ $searchQuery }}" />
                            </div>
                            <div class="flex gap-2 my-2 flex-wrap justify-center">
                                <select id="district"
                                    class="appearance-none block px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm  focus:ring-indigo-500 dark:bg-slate-700 dark:bg-opacity-50 dark:text-slate-200">
                                    <option value="">Choose a district</option>
                                    @foreach ($districts as $district)
                                        <option class="dark:bg-slate-950/75" value="{{ $district->id }}">
                                            {{ $district->district_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="municipality" id="municipality"
                                    class="appearance-none block px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm  focus:ring-indigo-500 dark:bg-slate-700 dark:bg-opacity-50 dark:text-slate-200">
                                    <option value="">Choose a municipality</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <x-primary-button> <i class="fa fa-search mr-2"></i> Search</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    $('#district').change(function() {
                        const selectedDistrict = $(this).val();
                        const url = '/get-municipalities/' + selectedDistrict;
                        $.ajax({
                            url: url,
                            method: 'GET',
                            success: function(response) {
                                const municipalities = response;
                                const $municipalitySelect = $('#municipality');
                                $municipalitySelect.empty();

                                municipalities.forEach(function(municipality) {
                                    $municipalitySelect.append(
                                        $('<option>', {
                                            class: "dark:bg-slate-950/75",
                                            value: municipality.id,
                                            text: municipality.municipality_name
                                        })
                                    );
                                });
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    });
                </script>
                @if ($sellers->count() > 0)
                    <h2 class="text-2xl font-bold mb-3">
                        Found Shops
                        <sup class="text-sm">({{ $municipality->municipality_name }})</sup>
                    </h2>
                    <div
                        class="grid grid-cols-2 max-[400]:grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-7 gap-2 mb-5">
                        @foreach ($sellers as $seller)
                            <a href="/shop/{{ $seller->id }}" class="block relative">
                                <div
                                    class="w-48 max-[1024px]:w-44 min-[1367px]:w-52 h-40 relative rounded-lg overflow-hidden">
                                    <img src="{{ Storage::url($seller->user->profile_photo) }}" alt=""
                                        class="w-full h-full object-cover">
                                    <div
                                        class="absolute z-10 w-full h-full top-0 left-0 bg-gradient-to-b to-slate-950 via-slate-950/50 from-transparent overflow-hidden">
                                        <div class="absolute bottom-0 text-white py-1">
                                            <p class="font-bold px-2 text-sm line-clamp-2">{{ $seller->shop_name }}</p>
                                            <p class="font-bold px-2 text-xs line-clamp-1">
                                                <i class='fa fa-map-marker mr-1' style='font-size:10px'></i>
                                                {{ $seller->user->ward }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
                <h2 class="text-2xl font-bold">
                    Found Products
                    <sup class="text-sm">({{ $municipality->municipality_name }})</sup>
                </h2>

                @if ($products->count() > 0)
                    <div
                        class="grid product-municipality-grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-8 gap-2">
                        @foreach ($products as $product)
                            @php
                                $averageRating = $product->ratings->avg('rating');
                            @endphp
                            <a href="products/{{ $product->id }}"
                                class="mx-auto my-2 shadow w-44 sm:w-52 md:w-[185px] lg:w-[200px] xl:w-52 2xl:w-[185px] bg-white dark:bg-slate-900/60 dark:text-slate-200 text-slate-700 overflow-hidden rounded-md">
                                <div
                                    class="w-full h-44 sm:h-52 md:h-[185px] lg:h-[200px] xl:h-52 2xl:h-[185px] rounded-b overflow-hidden">
                                    @php
                                        $image = json_decode($product->images, true)[0];
                                        if (strpos($image, 'https://') !== 0 && strpos($image, 'http://') !== 0) {
                                            $imageUrl = Storage::url($image);
                                        } else {
                                            $imageUrl = $image;
                                        }
                                    @endphp
                                    <img src="{{ $imageUrl }}" alt="" class="w-full h-full object-cover">
                                </div>
                                <div class="px-2 py-1">
                                    <x-star :rating="$averageRating" size='xs' />
                                    <h3 class="text-md font-semibold line-clamp-1" title="{{ $product->product_name }}">
                                        {{ $product->product_name }}
                                    </h3>
                                    <strong class="line-clamp-1" title="Rs {{ $product->price }}">
                                        Rs {{ $product->price }}
                                    </strong>

                                    @php
                                        $seller_location = $product->seller->user->municipality->municipality_name . ', ' . $product->seller->user->ward;
                                    @endphp
                                    <p class="text-gray-500 dark:text-gray-400 line-clamp-1"
                                        title="Seller Location: {{ $seller_location }}">
                                        {{ $seller_location }}
                                    </p>
                                    <strong class="line-clamp-1 dynamic-link text-gray-500 dark:text-gray-400"
                                        data-href="shop/{{ $product->seller->id }}"
                                        title="{{ $product->seller->shop_name }}">
                                        {{ $product->seller->shop_name }}
                                    </strong>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No products found.</p>
                @endif
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.dynamic-link').click(function(e) {
                e.preventDefault();
                window.location.href = $(this).data('href');
            });
        });
    </script>
@endsection
