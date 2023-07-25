@extends('layouts.seller-app')
@section('seller-layout')
    @php
        function activeClass($path)
        {
            if (substr(request()->path(), 0, strlen($path)) === $path) {
                return 'bg-gradient-to-tr from-indigo-800 to-purple-800 text-white';
            } else {
                return '';
            }
        }
    @endphp
    <div class="flex dark:text-white h-full">
        {{-- Sidebar content here --}}
        <div class="flex flex-col gap-4 justify-between items-center h-full p-6 w-fit bg-gray-100 dark:bg-gray-900">
            @php
                $links = [['label' => 'Dashboard', 'href' => '/dashboard', 'icon' => 'fas fa-tachometer-alt'], ['label' => 'Categories', 'href' => '/categories', 'icon' => 'fas fa-list'], ['label' => 'Products', 'href' => '/products', 'icon' => 'fas fa-box-open'], ['label' => 'Orders', 'href' => '/orders', 'icon' => 'fas fa-clipboard-list'], ['label' => 'Profile', 'href' => '/profile', 'icon' => 'fas fa-user']];
            @endphp

            <!-- Navigation -->
            <div>
                <ul class="text-slate-700 dark:text-gray-200">
                    @foreach ($links as $link)
                        <li class="mb-2">
                            <a href="/seller{{ $link['href'] }}"
                                class="flex items-center gap-2 py-2 px-4 rounded-md hover:dark:bg-gray-700 hover:bg-gray-300
                                  {{ activeClass('seller' . $link['href']) }}">
                                <i class="{{ $link['icon'] }}"></i>
                                <span>{{ $link['label'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="text-center flex flex-col">
                <span class="mb-5 cursor-pointer w-fit mx-auto" @click="darkMode = !darkMode">
                    <span x-show="!darkMode" class="text-gray-800 px-2 py-1 rounded-md">
                        <i class="fa fa-moon"></i>
                    </span>

                    <span x-show="darkMode" class="text-gray-200 px-2 py-1 rounded-md">
                        <i class="fa fa-sun"></i>
                    </span>

                </span>
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
