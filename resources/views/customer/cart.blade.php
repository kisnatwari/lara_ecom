@extends('customer.index')

@section('children')
    <div class="pt-2">
        @foreach ($cartItems as $shop => $items)
            @php
                $totalAmount = 0;
            @endphp
            <div class="bg-white/100 dark:bg-slate-800/75 py-5 mb-2">
                <div class="container mx-auto">
                    <h2 class="text-2xl font-bold mb-4">
                        <a href="/shop/{{ $items[0]['seller_id'] }}">{{ $shop }}</a>
                    </h2>
                    <table class="w-full border-collapse divide-y shadow-lg divide-slate-800 dark:divide-slate-200">
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
                        <tbody class="divide-y">
                            @foreach ($items as $item)
                                @php
                                    $image = json_decode($item['images'], true)[0];
                                    $imageUrl = '';
                                    if (strpos($image, 'https://') !== 0 && strpos($image, 'http://') !== 0) {
                                        $imageUrl = Storage::url($image);
                                    } else {
                                        $imageUrl = $image;
                                    }
                                    
                                    $totalAmount += $item['total_price'];
                                @endphp
                                <tr>
                                    <td class="px-4 py-2">
                                        <img src="{{ $imageUrl }}" alt="" class="w-16 h-16 rounded-full object-contain border-2 border-slate-500">
                                    </td>
                                    <td class="px-4 py-2">
                                        <b><a href="/products/{{ $item['product_id'] }}">{{ $item['product_name'] }}</a></b>
                                    </td>
                                    <td class="px-4 py-2">
                                        <div class="flex items-center">
                                            <span id="quantity-{{ $item['product_id'] }}">{{ $item['units'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2">{{ $item['unit_price'] }}</td>
                                    <td class="px-4 py-2">{{ $item['total_price'] }}</td>
                                    <td class="px-4 py-2">
                                        <div class="flex">
                                            <form method="POST" action="/cart/{{ $item['product_id'] }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                                    <i class="fa fa-trash mr-1"></i>
                                                </button>
                                            </form>
                                            <button type="button"
                                                class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded ml-2 edit-button"
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
                        <form method="post" action="{{route('order.store')}}" onsubmit="checkout(event)" class="bg-slate-100 dark:bg-slate-900/30 border-2 border-dashed dark:border-slate-900/50 p-4 mt-4 w-fit ml-auto">
                            <input type="hidden" name="shop_id" value="{{ $items[0]['seller_id'] }}">
                            <input type="hidden" name="total_amount" value="{{ $totalAmount * 100 }}">
                            @csrf
                            <fieldset class="w-fit">
                                @php
                                    $random_id = rand();
                                @endphp
                                <legend class="font-bold">Payment Mode</legend>
                                <p class="text-start mb-1">
                                    <input required type="radio" name="payment_mode" value="cod" id="cod{{ $random_id }}">
                                    <label for="cod{{ $random_id }}">&nbsp; Cash On Delivery</label>
                                </p>
                                <p class="text-start">
                                    <input required type="radio" name="payment_mode" value="khalti" id="khalti{{ $random_id }}">
                                    <label for="khalti{{ $random_id }}">&nbsp; Pay with Khalti</label>
                                </p>
                            </fieldset>
                            <p class="mt-2">
                                <span class="font-bold">
                                    Total Amount: Rs {{ number_format($totalAmount, 2, '.', ',') }}
                                </span>
                            </p>
                            <button type="submit"
                                class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mt-4">
                                Proceed to checkout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div id="editModal" class="fixed animate__animated z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500/75 dark:bg-gray-900/90 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="modal-form animate__faster inline-block align-bottom rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-slate-800 dark:text-slate-200 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <!-- Left Side: Label and Input Fields -->
                        <div class="sm:w-2/3">
                            <div class="flex items-center justify-start gap-3">
                                <div
                                    class="mx-auto flex-shrink-0 flex items-center justify-center h-5 w-5 rounded-full bg-purple-100 dark:bg-purple-950/75 sm:mx-0 sm:h-7 sm:w-7">
                                    <i class="fas fa-edit text-purple-600 dark:text-purple-500 text-xs"></i>
                                </div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-slate-200"
                                    id="modal-title">
                                    Edit Units
                                </h3>
                            </div>
                            <div class="mt-2">
                                <form id="editForm" method="POST" action="">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label for="editedQuantity"
                                            class="block text-gray-700 dark:text-slate-400 text-sm font-bold mb-2">New
                                            Quantity:</label>
                                        <input type="number" name="quantity" id="editedQuantity"
                                            class="w-full border-gray-300 dark:bg-slate-700 rounded-md shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                    </div>

                                    <div class="text-right mt-4">
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
                        <!-- Right Side: Image of Product Quantity Being Edited -->
                        <div class="sm:w-1/3 flex items-center justify-center">
                            <img src="" alt="" id="productImage" class="w-32 h-32 object-contain">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>

    <script>
        $(document).ready(function() {
            $('.edit-button').on('click', function() {
                var productId = $(this).data('product-id');
                var currentQuantity = $('#quantity-' + productId).text();
                var imageUrl = $('#quantity-' + productId).closest('tr').find('img').attr('src');

                $('#editedQuantity').val(currentQuantity);
                $('#editForm').attr('action', '/cart/' + productId);
                $('#editModal').removeClass('hidden animate__fadeOut').addClass('animate__fadeIn');
                $(".modal-form").removeClass('animate__animated animate__fadeOutUp');
                $(".modal-form").addClass('animate__animated animate__fadeInDown');
                $('#productImage').attr('src', imageUrl);

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


    <script>
        function checkout(event) {
            event.preventDefault();
            var form = event.target;
            var paymentmode = form.elements['payment_mode'].value;
            if(paymentmode === 'cod'){
                form.submit();
                return;
            }
            var config = {
                // replace the publicKey with yours
                "publicKey": "test_public_key_c9718b52b20145c1851d1ef3d4a42d54",
                "productIdentity": "1234567890",
                "productName": "Dragon",
                "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
                "paymentPreference": [
                    "KHALTI",
                    "EBANKING",
                    "MOBILE_BANKING",
                    "CONNECT_IPS",
                    "SCT",
                ],
                "eventHandler": {
                    onSuccess(payload) {
                        // hit merchant api for initiating verfication
                        console.log(payload);
                        payload['seller'] = form.elements['shop_id'].value;
                        if (payload.idx) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            });

                            $.ajax({
                                method: 'post',
                                url: "{{ route('ajax.khalti.verify_order') }}",
                                data: payload,
                                success: function(response) {
                                    console.log(response);
                                    form.submit();
                                }
                            })
                        }
                    },
                    onError(error) {
                        console.log(error);
                    },
                    onClose() {
                        console.log('widget is closing');
                    }
                }
            };
            var checkout = new KhaltiCheckout(config);
            var amount = form.elements['total_amount'].value;
            checkout.show({
                amount: amount >= 20000 ? 19999 : amount,
            });
        }
    </script>
@endsection
