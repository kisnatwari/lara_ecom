<x-guest-layout>
    <form method="POST" action="{{ route('seller-register') }}">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Propriter Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Shop Name -->
        <div class="mt-4">
            <x-input-label for="shop_name" :value="__('Shop Name')" />
            <x-text-input id="shop_name" class="block mt-1 w-full" type="text" name="shop_name" :value="old('shop_name')"
                required autofocus autocomplete="shop_name" />
            <x-input-error :messages="$errors->get('shop_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label :value="__('Choose your address')" />
            <select name="district" id="district" class="bg-gray-800 text-gray-200">
                @foreach ($districts as $district)
                    <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                @endforeach
            </select>
            <select id="municipality" name="municipality_id" class="bg-gray-800 text-gray-200">
                @foreach ($municipalities as $municipality)
                    <option value="{{ $municipality->id }}">{{ $municipality->municipality_name }}</option>
                @endforeach
            </select>
            <input type="hidden" name="ward" value="dummy ward">
            
        </div>

        {{-- Shop Type --}}
        <div class="mt-4">
            <x-input-label :value="__('Type of your shop')" />
            <select name="shop_category" id="shop_category" class="bg-gray-800 text-gray-200">
                @foreach ($shopCategories as $shopCategory)
                    <option value="{{ $shopCategory->id }}">{{ $shopCategory->name }}</option>
                @endforeach
            </select>
        </div>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            $('#district').on('change', function() {
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
</x-guest-layout>
