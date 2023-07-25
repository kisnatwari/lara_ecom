@extends('seller.layouts')

@section('content')
    <div class="h-full p-1">
        <div class="h-full bg-gray-900/90 p-2 overflow-auto">
            <div class="flex justify-between">
                <h1 class="text-white text-2xl mb-4">Ordered Products</h1>
                <a href="/seller/orders/confirmed"
                    class='bg-gradient-to-tr from-indigo-800 to-purple-800 hover:brightness-90 active:brightness-95 duration-300 px-5 py-2 rounded-md h-fit'>
                    <span>See Confirmed Orders</span>
                </a>
            </div>
            <div class=" p-2">
                @foreach ($groupedOrders as $individualOrders)
                    @php
                        $user = $individualOrders->first()->user;
                        $municipality = $user->municipality;
                    @endphp
                    <div class="bg-white dark:bg-gray-700 my-3 p-2 rounded">
                        <div class="flex justify-between">
                            <span class="mr-4 text-lg">
                                <i class="fa fa-user mr-1"></i> {{ $user->name }}
                            </span>
                            <small class="text-gray-800 dark:text-gray-300 text-sm">
                                <i class="fa fa-phone mr-1 text-xs"></i> {{ $user->phone }}
                            </small>
                        </div>
                        <p class="text-sm text-gray-800 dark:text-gray-300">
                            <i class="fa fa-map-marker mr-1"></i>
                            {{ $municipality->municipality_name }},
                            {{ $municipality->district->district_name }}
                        </p>
                        <div class="overflow-x-auto">
                            <table class="min-w-full mt-4 rounded overflow-hidden divide-y divide-gray-200 dark:divide-gray-900">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr class="text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        <th class="px-6 py-3">
                                            Image
                                        </th>
                                        <th class="px-6 py-3">
                                            Product Name
                                        </th>
                                        <th class="px-6 py-3">
                                            Price
                                        </th>
                                        <th class="px-6 py-3">
                                            Quantity
                                        </th>
                                        <th class="px-6 py-3">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-900 text-black dark:text-gray-400">
                                    @foreach ($individualOrders as $order)
                                        @php
                                            $product = $order->product;
                                            $images = json_decode($product->images, true);
                                            $mainImage = $images[0];
                                            if (strpos($mainImage, 'https://') !== 0 && strpos($mainImage, 'http://') !== 0) {
                                                $mainImageUrl = Storage::url($mainImage);
                                            } else {
                                                $mainImageUrl = $mainImage;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <img src="{{ $mainImageUrl }}" class="w-12 h-12 rounded-full object-cover object-center" alt="">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $product->product_name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                Rs {{ $product->price }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $order->quantity }} Units
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                Rs {{ $product->price * $order->quantity }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection