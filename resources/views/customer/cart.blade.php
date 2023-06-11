@extends('customer.index')

@section('children')
    <div class="pt-10">
        @foreach ($cartItems as $shop => $items)
            <div class="container mx-auto">
                <h2 class="text-2xl font-bold mb-4">{{ $shop }}</h2>
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Product Image</th>
                            <th class="px-4 py-2 text-left">Product Name</th>
                            <th class="px-4 py-2 text-left">Units</th>
                            <th class="px-4 py-2 text-left">Unit Price</th>
                            <th class="px-4 py-2 text-left">Total Price</th>
                            <th class="px-4 py-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            @php
                                $image = json_decode($item['images'], true)[0];
                                $imageUrl = '';
                                if (strpos($image, 'https://') !== 0 && strpos($image, 'http://') !== 0) {
                                    $imageUrl = Storage::url($image);
                                } else {
                                    $imageUrl = $image;
                                }
                            @endphp
                            <tr>
                                <td class="border px-4 py-2">
                                    <img src="{{ $imageUrl }}" alt="" class="w-20 h-20 object-contain">
                                </td>
                                <td class="border px-4 py-2">
                                    <b><a href="/products/{{ $item['product_id'] }}">{{ $item['product_name'] }}</a></b>
                                </td>
                                <td class="border px-4 py-2">
                                    <div class="flex items-center">
                                        <span id="quantity-{{ $item['product_id'] }}">{{ $item['units'] }}</span>

                                    </div>
                                </td>
                                <td class="border px-4 py-2">{{ $item['unit_price'] }}</td>
                                <td class="border px-4 py-2">{{ $item['total_price'] }}</td>
                                <td class="border px-4 py-2">
                                    <div class="flex">
                                        <form method="POST" action="/cart/{{ $item['product_id'] }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded animate__animated animate__fadeInLeft">
                                                <i class="fa fa-trash mr-1"></i>
                                            </button>
                                        </form>
                                        <button type="button"
                                            class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded ml-2 edit-button animate__animated animate__fadeInLeft"
                                            data-product-id="{{ $item['product_id'] }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-end">
                    <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mt-4">
                        Order
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <button class="bg-purple-500 hover:bg-purple-600 text-white mx-auto font-bold py-2 px-16 rounded mt-4">
        Order From All Shops
    </button>
    <!-- Modal -->
    <div id="editModal" class="fixed animate__animated z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500/75 dark:bg-gray-900/90 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="modal-form animate__faster inline-block align-bottom rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-slate-800 dark:text-slate-200 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-purple-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-edit text-purple-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-slate-200" id="modal-title">
                                Edit Units
                            </h3>
                            <div class="mt-2">
                                <form id="editForm" method="POST" action="">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label for="editedQuantity"
                                            class="block text-gray-700 dark:text-slate-400 text-sm font-bold mb-2">New
                                            Quantity:</label>
                                        <input type="number" name="editedQuantity" id="editedQuantity"
                                            class="w-full border-gray-300 dark:bg-slate-700 rounded-md shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                    </div>
                                    <div class="text-right">
                                        <button type="submit"
                                            class="bg-purple-500 hover:bg-purple-600 dark:bg-purple-600 dark:hover:bg-purple-700  text-white font-bold py-2 px-4 rounded animate__animated animate__fadeIn">
                                            Save
                                        </button>
                                        <button type="button" id="cancelButton"
                                            class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white font-bold py-2 px-4 rounded animate__animated animate__fadeIn">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.edit-button').on('click', function() {
                var productId = $(this).data('product-id');
                var currentQuantity = $('#quantity-' + productId).text();

                $('#editedQuantity').val(currentQuantity);
                $('#editForm').attr('action', '/cart/' + productId);
                $('#editModal').removeClass('hidden animate__fadeOut').addClass('animate__fadeIn');
                $(".modal-form").removeClass('animate__animated animate__fadeOutUp');
                $(".modal-form").addClass('animate__animated animate__fadeInDown');
                
            });

            $('#cancelButton').on('click', function() {
                $(".modal-form").removeClass('animate__animated animate__fadeInDown');
                $(".modal-form").addClass('animate__animated animate__fadeOutUp');
                $('#editModal').removeClass('animate__fadeIn').addClass('animate__fadeOut');
                setTimeout(function() {
                    $('#editModal').addClass('hidden');
                }, 500);
            });
        });
    </script>
@endsection
