@extends('layouts.auth')

@section('auth-form')
<x-auth-session-status class="mb-4" :status="session('status')" />
    <form action="{{ route('login') }}" method="POST" class="flex flex-col gap-3 mx-3">
        @csrf
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-white text-4xl font-bold">Upabhog</h1>
            <p class="text-white text-lg">Login here to get started.</p>
        </div>
        <div class=" bg-slate-700 bg-opacity-50 p-5 md:w-[300px] flex flex-col gap-3">
            <x-input-group id="email" placeholder="example@domain.com" label="Email ID" class="dark:bg-slate-900" />
            <x-input-group id="password" type="password" placeholder="Password" label="Password" class="dark:bg-slate-900" />
            <div class="text-right">
                <button class="bg-indigo-700 py-2 w-full rounded-md px-7 text-white">Login</button>
            </div>
        </div>
        <div class="text-slate-300 text-right text-sm">
            <a href="/register">Don't have an account?</a>
        </div>
    </form>
@endsection

{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
 --}}
