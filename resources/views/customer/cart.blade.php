@extends('customer.index')

@section('children')
    <div class="pt-10">
        @foreach ($cartItems as $shop => $items)
            <div class="container mx-auto">
                <h2 class="text-2xl font-bold mb-4">{{ $shop }}</h2>
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Product Name</th>
                            <th class="px-4 py-2 text-left">Units</th>
                            <th class="px-4 py-2 text-left">Unit Price</th>
                            <th class="px-4 py-2 text-left">Total Price</th>
                            <th class="px-4 py-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td class="border px-4 py-2">
                                    <a href="/products/{{$item["product_id"]}}">{{ $item['product_name'] }}</a>
                                </td>
                                <td class="border px-4 py-2">{{ $item['units'] }}</td>
                                <td class="border px-4 py-2">{{ $item['unit_price'] }}</td>
                                <td class="border px-4 py-2">{{ $item['total_price'] }}</td>
                                <td class="border px-4 py-2">
                                    <form method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                            <i class="fa fa-trash mr-1"></i> Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-end">
                    <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mt-4">
                        Order
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <button class="bg-purple-500 hover:bg-purple-600 text-white mx-auto font-bold py-2 px-16 rounded mt-4">
        Order From All Shops
    </button>
@endsection
