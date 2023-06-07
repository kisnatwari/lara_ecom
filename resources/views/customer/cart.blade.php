@extends('customer.index')

@section('children')
    <h1>Cart</h1>


    @foreach ($groupedItems as $sellerId => $items)
        <h2>{{ $items->first()->product->seller->shop_name }}</h2>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->product->price }}</td>
                        <td>{{ $item->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    <p>
        <strong>Total: {{ $quantity }}</strong>
    </p>

    <p>
        <a class="btn btn-primary btn-lg" href="/cart/pay-with-paypal">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet" viewBox="0 0 16 16">
                <path d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5V3zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a1.99 1.99 0 0 1-1-.268zM1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1z"/>
            </svg> Pay with PayPal
        </a>
    </p>
@endsection