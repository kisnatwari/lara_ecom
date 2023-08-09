@extends('seller.layouts')

@section('content')
    <style>
        .remove-image {
            position: absolute;
            top: 0;
            right: 0;
            cursor: pointer;
            color: #ff0000;
        }
    </style>

    <script>
        function setBackground(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(input).parent().css('background-image', 'url(' + e.target.result + ')');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function addImageField() {
            var container = $('#image-container');
            if (container.children().length >= 6) {
                return; // Limit reached, do not add more image fields
            }
            var newInput = $(
                '<div class="w-28 h-28 flex justify-center items-center shadow-lg bg-slate-800/40 border-2 border-slate-400/80 border-dashed rounded-md relative z-0 overflow-hidden cursor-pointer image-field" style="background-size: cover;"></div>'
            );
            newInput.append('<p class="text-sm text-center text-slate-200">Upload image</p>');
            newInput.append(
                '<input type="file" name="images[]" onchange="setBackground(this)" class="absolute top-0 left-0 cursor-pointer opacity-0 w-full h-full">'
            );
            newInput.append(
                '<span onclick="removeImageField(this)" class="remove-image text-xl absolute top-0 right-0 cursor-pointer text-red-500">&times;</span>'
            );
            $("#image-container #add-image-btn").before(newInput);
            checkLength();
        }

        function removeImageField(element) {
            $(element).parent().remove();
            checkLength();
        }

        function checkLength() {
            var container = $('#image-container');
            var length = container.children().length;
            if (length >= 6) {
                $("#add-image-btn").addClass("hidden");
            } else {
                $("#add-image-btn").removeClass("hidden");
            }
        }
    </script>

    <div class="h-full p-2">
        <div class="h-full overflow-auto flex flex-col justify-center items-center bg-slate-900/80 p-2">
            <form class="min-w-[300px] relative" action="{{ route('products.update', $product) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h1 class="mb-4 border-b">Edit Product</h1>
                <div class="flex flex-col gap-4">
                    <input type="text" name="product_name" placeholder="Enter name of your product to be uploaded"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-slate-800 dark:bg-opacity-50"
                        value="{{ $product->product_name }}" />
                    <div class="flex gap-4">
                        <input type="text" name="price" placeholder="Price"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-slate-800 dark:bg-opacity-50"
                            value="{{ $product->price }}" required />
                        <input type="text" name="brand" placeholder="Brand name"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-slate-800 dark:bg-opacity-50"
                            value="{{ $product->brand->brand_name }}" required />
                        <input type="text" name="quantity" placeholder="Quantity"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-slate-800 dark:bg-opacity-50"
                            value="{{ $product->quantity }}" required />
                    </div>
                    <div>
                        <select name="category_id" id="category"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-slate-800 dark:bg-opacity-50">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" class="bg-slate-900">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <textarea name="description" placeholder="Write some description about the product" rows="3"
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-slate-800 dark:bg-opacity-50">{{ $product->description }}</textarea>

                    <div id="image-container" class="flex flex-wrap gap-2 mt-4">
                        <div class="w-28 h-28 flex justify-center items-center shadow-lg bg-slate-800/40 border-2 border-slate-400/80 border-dashed rounded-md relative z-0 overflow-hidden cursor-pointer image-field"
                            style="background-size: cover;">
                            <p class="text-sm text-center text-slate-200 p-2">Thumbnail image</p>
                            <input type="file" name="images[]" onchange="setBackground(this)"
                                class="absolute top-0 left-0 cursor-pointer opacity-0 w-full h-full">
                        </div>
                        <button type="button" id="add-image-btn" class="h-24 flex items-center shadow-lg cursor-pointer"
                            style="background-size: cover;" onclick="addImageField()">
                            <span class="text-3xl px-2 text-slate-200 fa fa-plus"></span>
                        </button>
                    </div>
                </div>
                <div class="text-right mt-4">
                    <button class="px-3 py-2 bg-gradient-to-tr from-indigo-600 to-purple-600 rounded-md">Update
                        Product</button>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
