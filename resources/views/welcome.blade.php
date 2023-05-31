@extends('customer.index')

@section('children')
    <div class="flex flex-col gap-2 mt-2">
        @include('customer.videobackground')
        @include('customer.categories')
        @include('customer.vendors')
        @include('customer.products')
    </div>
@endsection
