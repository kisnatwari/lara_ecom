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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</head>

<body class="font-sans text-gray-900 antialiased" x-init="if (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    localStorage.setItem('darkMode', JSON.stringify(true));
}
darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" x-cloak>
    <div x-bind:class="{ 'dark': darkMode === true }">
        <div class="w-full h-screen overflow-auto"
            style="background-image:url('{{ asset('assets/auth-bg.jpg') }}');background-position:center;background-size:cover;background-attachment:fixed">
            <div class="bg-black bg-opacity-90 h-full min-h-full flex justify-center items-center">
               @yield('auth-form')
            </div>
        </div>
    </div>
</body>

</html>

