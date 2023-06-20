@extends('layouts.auth')

@section('auth-form')
    <div>
        <form class="flex flex-col gap-3 mx-3" enctype="multipart/form-data" method="POST" action="/seller-register">
            @csrf
            <div class="flex flex-col items-center justify-center">
                <h1 class="text-white text-4xl font-bold">Seller Registeration</h1>
                <p class="text-white text-lg">Please fill out this form to register.</p>
            </div>
            <div class=" bg-slate-700 bg-opacity-50 p-5 md:max-w-[690px]">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <p class="border-b border-dashed text-slate-300 border-slate-300 mb-2">Shop Details</p>
                <div class="grid grid-flow-col gap-4 mb-3">
                    <div class="grid grid-cols grid-flow-col">
                        <div class="flex gap-3 flex-col">
                            <x-input-group id="shop_name" placeholder="ABC Enterprises" label="Shop Name" />
                            <x-input-group id="name" placeholder="John Doe" label="Owner Name" />
                            <div>
                                <label for="shop_type"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Choose
                                    Shop Type</label>
                                <select name="shop_category" id="shop_type"
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:ring-indigo-500 sm:text-sm dark:bg-slate-700 dark:bg-opacity-50 dark:text-slate-200">
                                    @foreach ($shopCategories as $category)
                                        <option class="bg-slate-950/75" value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-center items-center">
                            <div
                                class="relative w-32 h-32 border-dashed border-slate-500 border-4 bg-slate-800 bg-opacity-50 overflow-hidden cursor-pointer">
                                <span
                                    class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-sm text-center text-white">Upload
                                    Profile Photo</span>
                                <input type="file" class="z-20 relative w-full h-full opacity-0" name="profile_pic">
                            </div>
                        </div>
                    </div>

                </div>
                <p class="border-b border-dashed text-slate-300 border-slate-300 mb-2">Authentication</p>
                <div class="grid grid-flow-col gap-4 mb-3">
                    <div class="grid-cols">
                        <div class="flex gap-3 flex-col">
                            <x-input-group id="email" placeholder="example@domain.com" label="Email Address" />
                            <x-input-group id="phone" placeholder="9801234567" label="Phone Number (+977)" />
                        </div>
                    </div>
                    <div class="grid-cols">
                        <div class="flex gap-3 flex-col">
                            <x-input-group id="password" type="password" placeholder="***************" label="Password" />
                            <x-input-group id="password_confirmation" type="password" placeholder="***************"
                                label="Confirm Password" />
                        </div>
                    </div>
                </div>
                <p class="border-b border-dashed text-slate-300 border-slate-300 mb-2">Address</p>
                <div class="grid grid-flow-col gap-4 mb-3">
                    <div class="flex gap-1 flex-wrap">
                        <select name="district" id="district"
                            class="appearance-none block px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:ring-indigo-500 dark:bg-slate-700 dark:bg-opacity-50 dark:text-slate-200">
                            <option value="">Choose a district</option>
                            @foreach ($districts as $district)
                                <option class="bg-slate-950/75" value="{{ $district->id }}">
                                    {{ $district->district_name }}
                                </option>
                            @endforeach
                        </select>
                        <select name="municipality" id="municipality"
                            class="appearance-none block px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:ring-indigo-500 dark:bg-slate-700 dark:bg-opacity-50 dark:text-slate-200">
                            <option value="">Choose a municipality</option>
                        </select>
                        <input type="text" placeholder="Ward/Tole/Chok name"
                            class="appearance-none block px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:ring-indigo-500 sm:text-sm dark:bg-slate-700 dark:bg-opacity-50 dark:text-slate-200"
                            required="" name="ward">
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
        <script>
            $(document).ready(function() {
                $("input[name=profile_pic]").change(function() {
                    if (this.files && this.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $(this).parent().css('background-image', 'url(' + e.target.result + ')');
                            $(this).parent().css('background-size', 'cover');
                        }.bind(this);
                        reader.readAsDataURL(this.files[0]);
                    }
                });
                $('#district').change(function() {
                    const selectedDistrict = $(this).val();
                    const url = '/get-municipalities/' + selectedDistrict;
                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function(response) {
                            const municipalities = response;
                            const $municipalitySelect = $('#municipality');
                            $municipalitySelect.empty();

                            municipalities.forEach(function(municipality) {
                                $municipalitySelect.append(
                                    $('<option>', {
                                        class: "bg-slate-950/75",
                                        value: municipality.id,
                                        text: municipality.municipality_name
                                    })
                                );
                            });
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });
            });
        </script>

    </div>
@endsection
