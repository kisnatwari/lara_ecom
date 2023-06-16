{{-- <div class="w-full h-screen overflow-auto"
    style="background-image:url({{ asset('assets/auth-bg.jpg') }});background-position:center;background-size:cover;background-attachment:fixed">
    asdf
</div>
 --}}

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
                <div>
                    <form class="flex flex-col gap-3 mx-3" enctype="multipart/form-data">
                        <div class="flex flex-col items-center justify-center">
                            <h1 class="text-white text-4xl font-bold">Seller Registeration</h1>
                            <p class="text-white text-lg">Please fill out this form to register.</p>
                        </div>
                        <div class=" bg-slate-700 bg-opacity-50 p-5 md:max-w-[670px]">
                            <p class="border-b border-dashed text-slate-300 border-slate-300 mb-2">Shop Details</p>
                            <div class="grid grid-flow-col gap-4 mb-3">
                                <div class="grid-cols">
                                    <div class="flex gap-3 flex-col">
                                        <x-input-group id="shop_name" placeholder="ABC Enterprises" label="Shop Name" />
                                        <x-input-group id="owner_name" placeholder="John Doe" label="Owner Name" />
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div
                                        class="relative h-32 border-dashed border-slate-500 border-4 bg-slate-800 bg-opacity-50 overflow-hidden cursor-pointer">
                                        <span
                                            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-sm text-center text-white">Upload
                                            Profile Photo</span><input type="file"
                                            class="z-20 relative w-full h-full opacity-0" name="profile_pic">
                                    </div>
                                    <div
                                        class="relative h-32 border-dashed border-slate-500 border-4 bg-slate-800 bg-opacity-50 overflow-hidden cursor-pointer">
                                        <span
                                            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-sm text-center text-white">Upload
                                            Profile Photo</span><input type="file"
                                            class="z-20 relative w-full h-full opacity-0" name="profile_pic">
                                    </div>
                                </div>
                            </div>
                            <p class="border-b border-dashed text-slate-300 border-slate-300 mb-2">Authentication</p>
                            <div class="grid grid-flow-col gap-4 mb-3">
                                <div class="grid-cols">
                                    <div class="flex gap-3 flex-col">
                                        <x-input-group id="email" placeholder="example@domain.com"
                                            label="Email Address" />
                                        <x-input-group id="phone" placeholder="9801234567"
                                            label="Phone Number (+977)" />
                                    </div>
                                </div>
                                <div class="grid-cols">
                                    <div class="flex gap-3 flex-col">
                                        <x-input-group id="password" type="password" placeholder="***************"
                                            label="Password" />
                                        <x-input-group id="confirm_password" type="password"
                                            placeholder="***************" label="Confirm Password" />
                                    </div>
                                </div>
                            </div>
                            <p class="border-b border-dashed text-slate-300 border-slate-300 mb-2">Address</p>
                            <div class="grid grid-flow-col gap-4 mb-3">
                                <div class="flex gap-1 flex-wrap">
                                    <select name="district" class="dark:bg-slate-700 border-0 rounded-md p-2">
                                        <option value="">Choose a district</option>
                                    </select>
                                    <select name="municipality" class="dark:bg-slate-700 border-0 rounded-md p-2">
                                        <option>Choose a municipality</option>
                                    </select>
                                    <input type="text" placeholder="Ward/Tole/Chok name"
                                        class="dark:bg-slate-700 border-0 rounded-md p-2 max-w-[200px]" required=""
                                        name="ward">
                                </div>
                            </div>
                            <div class="flex justify-between flex-row-reverse">
                                <button
                                    class="px-5 py-2 rounded-md duration-200 hover:brightness-95 active:brightness-90 bg-indigo-700 text-white border-0">Register
                                    Shop</button>
                            </div>
                        </div>
                        <p class="text-slate-300 text-sm text-end flex justify-between flex-wrap flex-row-reverse">
                            <a href="/login">Already have an account? Login</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
