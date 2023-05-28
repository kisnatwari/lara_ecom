@php
    use App\Models\Seller;
@endphp
@extends('layouts.seller-app')

@section('seller-layout')
    @php
        function activeClass($path)
        {
            if (substr(request()->path(), 0, strlen($path)) === $path) {
                return 'bg-gradient-to-tr from-indigo-800 to-purple-800';
            } else {
                return '';
            }
        }
    @endphp
    <div class="flex dark:text-white h-full">
        {{-- Sidebar content here --}}
        <div class="flex flex-col gap-4 justify-between items-center h-full p-6 w-fit backdrop-blur-lg">
            <!-- User profile -->
            {{-- <div class="mb-14">
                <div class="w-20 h-20 mx-auto bg-slate-500 rounded-full"></div>
                <h1 class="text-center mt-2 text-white font-bold text-xl">{{ Seller::find(Auth::user()->id)->shop_name }}
                </h1>
            </div> --}}
            @php
                $links = [['label' => 'Dashboard', 'href' => '/dashboard', 'icon' => 'fas fa-tachometer-alt'], ['label' => 'Categories', 'href' => '/categories', 'icon' => 'fas fa-list'], ['label' => 'Products', 'href' => '/products', 'icon' => 'fas fa-box-open'], ['label' => 'Orders', 'href' => '/orders', 'icon' => 'fas fa-clipboard-list'], ['label' => 'Profile', 'href' => '/profile', 'icon' => 'fas fa-user']];
            @endphp

            <!-- Navigation -->
            <div>
                <ul class="text-white">
                    @foreach ($links as $link)
                        <li class="mb-2">
                            <a href="/seller{{ $link['href'] }}"
                                class="flex items-center gap-2 py-2 px-4 rounded-md hover:bg-slate-700 {{ activeClass('seller' . $link['href']) }}">
                                <i class="{{ $link['icon'] }}"></i>
                                <span>{{ $link['label'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="text-center">
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
