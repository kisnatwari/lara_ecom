@extends('seller.layouts')

@section('content')
    <div class="h-full p-1">
        <div class="h-full bg-white dark:bg-gray-900 p-2 overflow-auto">
            <div class="flex justify-between">
                <h1 class="text-gray-800 dark:text-gray-200 text-2xl mb-4">Completed Orders</h1>
                <a href="{{ route('orders.index') }}"
                    class='bg-slate-800 hover:brightness-90 active:brightness-95 duration-300 px-5 py-2 rounded-md h-fit text-white'>
                    <span>See Unprocessed Orders</span>
                </a>
            </div>
            <div class="p-2">
                @foreach ($groupedOrders as $individualOrders)
                    @php
                        $user = $individualOrders->first()->user;
                        $municipality = $user->municipality;
                        $totalAmount = 0;
                    @endphp
                    <div class="bg-gray-50 shadow-lg dark:bg-gray-800/50 text-gray-800 dark:text-gray-300 rounded my-3 p-2">
                        <div class="flex justify-between px-2">
                            <div class="flex gap-1">
                                <div class="self-center">
                                    <i class="fa fa-user mr-1 text-4xl"></i>    
                                </div> 
                                <div class="flex flex-col">
                                    <span class="mr-4 text-lg">
                                      {{ $user->name }}
                                    </span>
                                    <span>
                                        {{ $municipality->municipality_name }},
                                        {{ $municipality->district->district_name }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table
                                class="min-w-full table-auto mt-4 rounded overflow-hidden divide-y divide-gray-200 dark:divide-gray-900">
                                <thead class="">
                                    <tr
                                        class="text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        <th>Ordered On</th>
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
                                        <th class="px-6 py-3">
                                            Payment
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-600 dark:text-gray-400">
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
                                            $totalAmount += $product->price * $order->quantity;
                                        @endphp
                                        <tr>
                                            <td>
                                                {{ $order->created_at->diffForHumans() }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <img src="{{ $mainImageUrl }}"
                                                    class="w-12 h-12 rounded-full object-cover object-center"
                                                    alt="">
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="/seller/products/{{ $product->id }}">
                                                    {{ $product->product_name }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                Rs {{ number_format($product->price, 2, '.', ',') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $order->quantity }} Units
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                Rs {{ number_format($product->price * $order->quantity, 2, '.', ',') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $order->payment_mode }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="text-gray-600 dark:text-gray-400 text-end px-5 py-2">
                                Total Amount: Rs {{ number_format($totalAmount, 2, '.', ',') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
