@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\Route;
    
    /* counting cart items */
    $cartCount = null;
    if (auth()->check()) {
        $user = auth()->user();
        $cartCount = $user->carts()->sum('quantity');
    }
@endphp

<div class="py-4 border border-slate-400 dark:border-slate-800 bg-white dark:bg-slate-800 dark:text-slate-300">
    <nav class="container mx-auto flex items-center justify-between flex-wrap h-full">
        <a href="/" class="flex items-center flex-shrink-0 gap-2 mr-6 backdrop-blur-md">
            <i class="fa fa-basket"></i>
            <span class="font-semibold tracking-tight font-righteous text-4xl"> Upabhog</span>
        </a>
        <div class="flex items-center gap-3">
            @if (auth()->user())
                <a href="/myorders">
                    <button class="border px-5 py-1 rounded-3xl dark:border-gray-500 border-gray-300">My Orders</button>
                </a>
                <a href="/cart" class="rounded-3xl w-7 h-7 flex justify-center items-center relative">
                    <i class="fa fa-shopping-cart dark:text-slate-200 text-slate-800 text-lg"></i>
                    <span
                        class="absolute -top-2 -right-1 w-4 h-4 bg-purple-600 flex items-center justify-center rounded-full text-white text-sm overflow-hidden">
                        <small>{{ $cartCount }}</small>
                    </span>
                </a>
                <form method="POST" action="http://localhost:8000/logout">
                    @csrf
                    <a href="http://localhost:8000/logout"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fa fa-sign-out"></i>
                    </a>
                </form>
                <img src="https://cdn.iconscout.com/icon/free/png-256/free-avatar-370-456322.png?f=webp" width="40"
                    height="40" class="border border-slate-950 rounded-full">
            @else
                <div class="flex flex-row gap-5">
                    <a href="/login">
                        <button>
                            <i class="fa fa-sign-in mr-[2px]"></i> Login
                        </button>
                    </a>
                    <a href="/register">
                        <button>
                            <i class="fa fa-user mr-[2px]"></i> Register
                        </button>
                    </a>
                </div>
            @endif
            <button @click="darkMode = !darkMode">
                <i x-show="!darkMode" class="fa fa-moon"></i>
                <i x-show="darkMode" class="fa fa-sun"></i>
            </button>
        </div>
    </nav>
</div>
