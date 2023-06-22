@if (auth()->user() && !auth()->user()->municipality_id)
    @php
        $districts = App\Models\District::all()->sortBy('district_name');
    @endphp
    <div class="bg-white dark:bg-slate-800 py-4 mx-2 rounded-lg" id="address-form-ui">
        <div class="container mx-auto">
            <h1 class="text-center text-lg">Update your address details to get the products from nearby shops</h1>
            <form action="/update-customer-address" method="POST" id="address-form">
                @csrf
                <div class="flex gap-2 my-2 flex-wrap justify-center">
                    <select name="district" id="district"
                        class="appearance-none block px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm  focus:ring-indigo-500 dark:bg-slate-700 dark:bg-opacity-50 dark:text-slate-200">
                        <option value="">Choose a district</option>
                        @foreach ($districts as $district)
                            <option class="dark:bg-slate-950/75" value="{{ $district->id }}">
                                {{ $district->district_name }}
                            </option>
                        @endforeach
                    </select>
                    <select name="municipality" id="municipality"
                        class="appearance-none block px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm  focus:ring-indigo-500 dark:bg-slate-700 dark:bg-opacity-50 dark:text-slate-200">
                        <option value="">Choose a municipality</option>
                    </select>
                    <input type="text" placeholder="Ward/Tole/Chok name"
                        class="appearance-none block px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 sm:text-sm dark:bg-slate-700 dark:bg-opacity-50 dark:text-slate-200"
                        required="" name="ward">
                </div>
                <div class="text-center">
                    <x-primary-button>Update</x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
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
                                class: "dark:bg-slate-950/75",
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

        $('#address-form').submit(function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            const url = $(this).attr('action');
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                    $("#address-form-ui").remove();
                    location.replace("/");
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>

@endif
