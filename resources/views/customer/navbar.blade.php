@php
  use Illuminate\Support\Facades\Storage;
  use Illuminate\Support\Facades\Route;
@endphp

<div class="py-4 border border-slate-400 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-300">
  <nav class="container mx-auto flex items-center justify-between flex-wrap">
    <div class="flex items-center flex-shrink-0 gap-2 mr-6 backdrop-blur-md">
      <i class="fa fa-basket"></i>
      <span class="font-semibold tracking-tight font-righteous text-4xl"> Upabhog</span>
    </div>
    <div class="flex items-center gap-3">
      <button onclick="handleThemeChange()">
        @if (config('theme.mode') == 'light')
          <i class="fa fa-sun text-lg"></i>
        @else
          <i class="fa fa-moon text-lg"></i>
        @endif
      </button>
      <button class="rounded-3xl text-slate-600 w-7 h-7 flex justify-center items-center relative">
        <i class="fa fa-shopping-cart text-slate-200 text-lg"></i>
        <span class="absolute -top-2 -right-1 w-4 h-4 bg-purple-600 flex items-center justify-center rounded-full text-white text-sm overflow-hidden">
          <small>5</small>
        </span>
      </button>
      <div onclick="showMenu = !showMenu" class="relative">
        <img src="https://cdn.iconscout.com/icon/free/png-256/free-avatar-370-456322.png?f=webp" width="40" height="40" class="border border-slate-950 rounded-full">
{{--         @if ($showMenu)
          <div class="absolute top-12 -right-3 w-56 bg-white dark:bg-slate-800 shadow-lg rounded-lg shadow-md z-10">
            <nav>
              <ul class="flex flex-col">
                @foreach ($menuItems as $menuItem)
                  <li class="min-h-[40px] flex items-center hover:bg-purple-100 dark:hover:bg-slate-900">
                    <a href="{{ $menuItem['link'] }}" class="w-full">
                      <span class="px-3">{{ $menuItem['label'] }}</span>
                    </a>
                  </li>
                @endforeach
              </ul>
            </nav>
          </div>
        @endif --}}
      </div>
    </div>
  </nav>
</div>