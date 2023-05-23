@php
    use App\Models\Seller;
@endphp
@extends('layouts.seller-app')

@section('seller-layout')
    @php
        function activeClass($path)
        {
            return $path == request()->path() ? 'bg-gradient-to-tr from-indigo-800 to-purple-800' : '';
        }
    @endphp
    <div class="flex dark:text-white h-full">
        {{-- Sidebar content here --}}
        <div class="flex flex-col gap-4 justify-around items-center h-full p-6 w-fit backdrop-blur-lg">
            <!-- User profile -->
            <div class="mb-14">
                <div class="w-20 h-20 mx-auto bg-slate-500 rounded-full"></div>
                <h1 class="text-center mt-2 text-white font-bold text-xl">{{Seller::find(Auth::user()->id)->shop_name}}</h1>
            </div>

            <!-- Navigation -->
            <div>
                <ul class="text-white">
                    <li class="mb-2">
                        <a href="/seller/dashboard" class="flex items-center gap-2 py-2 px-4 rounded-md hover:bg-slate-700 {{activeClass('seller/dashboard')}}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/seller/products" class="flex items-center gap-2 py-2 px-4 rounded-md hover:bg-slate-700  {{activeClass('seller/products')}}">
                            <i class="fas fa-box-open"></i> 
                            <span>Products</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/seller/orders" class="flex items-center gap-2 py-2 px-4 rounded-md hover:bg-slate-700  {{activeClass('seller/orders')}}">
                            <i class="fas fa-clipboard-list"></i> 
                            <span>Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="/seller/profile" class="flex items-center gap-2 py-2 px-4 rounded-md hover:bg-slate-700  {{activeClass('seller/profile')}}">
                            <i class="fas fa-user"></i> 
                            <span>Profile</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="text-center">
                <p>SELLERSEEK</p>
                <small>
                    COPYRIGHT <br />
                    &copy; Krishna Tiwari
                </small>
            </div>
        </div>

        <div class="flex-grow h-full overflow-auto p-1">
            @yield('content')
        </div>
    </div>
@endsection
