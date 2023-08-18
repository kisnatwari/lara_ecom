@extends('seller.layouts')
@section('content')
    <div class="h-full p-1">
        <div class="h-full bg-white dark:bg-gray-900 p-2 overflow-auto">
            <div class="flex justify-between">
                <h1 class="text-gray-800 dark:text-gray-200 text-2xl mb-4">Ordered Products</h1>
                <a href="{{ route('orders.completed') }}"
                    class='bg-slate-800 hover:brightness-90 active:brightness-95 duration-300 px-5 py-2 rounded-md h-fit text-white'>
                    <span>See Completed Orders</span>
                </a>
            </div>
            <div class="pagination">
                {{ $orders->links() }}
            </div>
            @php
                $groupedOrders = $orders->groupBy('user_id');
            @endphp
            <div class="p-2">
                @foreach ($groupedOrders as $individualOrders)
                    @php
                        $user = $individualOrders->first()->user;
                        $municipality = $user->municipality;
                        $totalAmount = 0;
                    @endphp
                    <div class="bg-gray-50 shadow-lg dark:bg-gray-800/50 text-gray-800 dark:text-gray-300 rounded my-3 p-2">
                        <div class="flex justify-between px-2">
                            <span class="mr-4 text-lg">
                                <i class="fa fa-user mr-1"></i> {{ $user->name }}
                            </span>
                            <span>
                                <i class="fa fa-phone mr-1 text-xs"></i> {{ $user->phone }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-800 dark:text-gray-400 px-2">
                            <i class="fa fa-map-marker mr-1"></i>
                            {{ $municipality->municipality_name }},
                            {{ $municipality->district->district_name }}
                        </p>
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
                                        <th class="px-6 py-3">
                                            Action
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
                                            <td class="px-6 py-4 whitespace-nowrap flex justify-start gap-2 flex-wrap">
                                                @if ($order->status_id == 1)
                                                    <form action="{{ route('orders.deliver', ['order' => $order->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button
                                                            class="bg-teal-500 dark:bg-teal-700 text-white dark:text-gray-200 font-bold py-2 px-2 rounded text-sm">
                                                            Deliver
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('orders.cancel', ['order' => $order->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="bg-red-500 dark:bg-red-600 text-white dark:text-gray-200 font-bold py-2 px-2 rounded text-sm">
                                                            Cancel
                                                        </button>
                                                    </form>
                                                @else
                                                    @if ($order->status_id == 2)
                                                        <form
                                                            action="{{ route('orders.cancel', ['order' => $order->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                class="bg-emerald-500 dark:bg-emerald-700 text-white dark:text-gray-200 font-bold py-2 px-2 rounded text-sm">
                                                                Mark As Delivered
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
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
            <div class="pagination">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
