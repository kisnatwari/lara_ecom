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
            @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="text-red-500 text-sm">{{$error}}</p>
            @endforeach
        @endif
        </div>
        <div class="text-slate-300 text-right text-sm">
            <a href="/register">Don't have an account?</a>
        </div>
    </form>
@endsection
