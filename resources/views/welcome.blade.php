@extends('customer.index')

@section('children')
    <div class="flex flex-col gap-2 mt-2">
        @include('customer.homepage.videobackground')
        @include('customer.homepage.categories')
        @include('customer.homepage.address')
        @include('customer.homepage.vendors')
        @include('customer.homepage.products.products')
    </div>
@endsection
