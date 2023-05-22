<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" x-data="{ darkMode: false }" x-init="
    if (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
      localStorage.setItem('darkMode', JSON.stringify(true));
    }
    darkMode = JSON.parse(localStorage.getItem('darkMode'));
    $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" x-cloak  style="background-image: url(https://assets-global.website-files.com/6009ec8cda7f305645c9d91b/620bd6d655f2044afa28bff4_glassmorphism-p-1600.jpeg)">
        <div x-bind:class="{'dark' : darkMode === true}"  class="h-screen flex flex-col bg-slate-800/80 backdrop-blur-lg dark:text-white">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main class="flex-grow">
                @yield('seller-layout')
            </main>
        </div>
    </body>
</html>
