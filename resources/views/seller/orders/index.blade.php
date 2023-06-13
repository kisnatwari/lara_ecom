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
            <div class="grid grid-cols-1  lg:grid-cols-2 xl:grid-cols-3  gap-2">
                @foreach ($orders as $order)
                    @php
                        // manupulating image url
                        $image = json_decode($order->product->images, true)[1];
                        if (strpos($image, 'https://') !== 0 && strpos($image, 'http://') !== 0) {
                            $imageUrl = Storage::url($image);
                        } else {
                            $imageUrl = $image;
                        }
                        
                        //customer address
                        $municipality = $order->user->municipality->municipality_name;
                        $district = $order->user->municipality->district->district_name;
                    @endphp
                    <div class="bg-white dark:bg-slate-800 p-4">
                        <h2 class="text-gray-900 dark:text-gray-100 text-lg font-bold mb-2">Order #{{ $order->id }}</h2>
                        <div class="flex gap-2">
                            <div class="text-gray-600 dark:text-gray-200">
                                <p class="text-lg font-bold">{{ $order->product->product_name }}</p>
                                <p>Customer: {{ $order->user->name }}</p>
                                <p>Quantity: {{ $order->quantity }}</p>
                                <p>Status: {{ $order->status->name }}</p>
                                <p> From: {{ $district }} ( {{ $municipality }} ) </p>
                                <small class="block font-bold"> {{ $order->created_at->diffForHumans() }} </small>
                            </div>
                            <div>
                                <img src="{{ $imageUrl }}" alt="{{ $order->product->name }}"
                                    class="w-28 h-28 object-contain">
                            </div>
                        </div>
                        <!-- Action Buttons -->
                        <div class="flex mt-4">
                            <form action="{{-- {{ route('orders.update', $order->id) }} --}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status_id" value="{{ 4 }}">
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 h-full">Confirm</button>
                            </form>

                            <form action="{{-- {{ route('orders.update', $order->id) }} --}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status_id" value="{{ 2 }}">
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 h-full">Cancel</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
