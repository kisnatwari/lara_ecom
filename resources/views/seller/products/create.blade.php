@extends('seller.layouts')

@section('content')
    <div class="h-full p-2">
        <div class="h-full overflow-auto flex flex-col justify-center items-center bg-white/5 p-2">
            <form class="min-w-[300px] relative">
                <h1 class="mb-4 border-b">Upload Products here</h1>
                <div class="flex flex-col gap-4">
                    <input type="text" id="product-name" placeholder="Enter name of your product to be uploaded"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-slate-800 dark:bg-opacity-50" />
                    <div class="flex gap-4">
                        <input type="text" id="product-price" placeholder="Price"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-slate-800 dark:bg-opacity-50"
                            required />
                        <input type="text" id="product-brand" placeholder="Brand name"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-slate-800 dark:bg-opacity-50"
                            required />
                        <input type="text" id="product-quantity" placeholder="Quantity"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-slate-800 dark:bg-opacity-50"
                            required />
                    </div>
                    <div>
                        <input type="text" id="category" placeholder="Start typing to choose category name"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-slate-800 dark:bg-opacity-50" />
                        <input type="hidden" name="category_id" value="0">
                        <div class="relative mt-1">
                            <div class="absolute top-0 left-0 w-full bg-slate-800/50 max-h-[350px] overflow-auto backdrop-blur-lg"
                                id="categories-list">
                                <!-- Categories dynamically rendered here -->
                            </div>
                        </div>
                    </div>
                    <textarea placeholder="Write some description about the product" rows="3"
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-slate-800 dark:bg-opacity-50"></textarea>
                    <div class="flex justify-between">
                        <div
                            class="w-24 h-24 flex justify-center items-center shadow-lg bg-slate-800/40 border-2 border-slate-400/80 border-dashed rounded-md relative overflow-hidden cursor-pointer">
                            <p class="text-sm text-center text-slate-200">Thumbnail image</p>
                            <input type="file" name="[img]" onchange="setBackground(this)" class="absolute top-0 left-0 cursor-pointer opacity-0 w-full h-full">
                        </div>
                        <div
                            class="w-24 h-24 flex justify-center items-center shadow-lg bg-slate-800/40 border-2 border-slate-400/80 border-dashed rounded-md relative overflow-auto">
                            <p class="text-sm text-center text-slate-200">Main image</p>
                            <input type="file" name="[img]" onchange="changeBackground(this)" class="absolute top-0 left-0 cursor-pointer opacity-0 w-full h-full">
                        </div>
                        <div
                            class="w-24 h-24 flex justify-center items-center shadow-lg bg-slate-800/40 border-2 border-slate-400/80 border-dashed rounded-md relative overflow-auto">
                            <p class="text-sm text-center text-slate-200">Additional image</p>
                            <input type="file" name="[img]" onchange="changeBackground(this)" class="absolute top-0 left-0 cursor-pointer opacity-0 w-full h-full">
                        </div>
                        <div
                            class="w-24 h-24 flex justify-center items-center shadow-lg bg-slate-800/40 border-2 border-slate-400/80 border-dashed rounded-md relative overflow-auto">
                            <p class="text-sm text-center text-slate-200">Additional image</p>
                            <input type="file" name="[img]" onchange="changeBackground(this)" class="absolute top-0 left-0 cursor-pointer opacity-0 w-full h-full">
                        </div>
                        <div
                            class="w-24 h-24 flex justify-center items-center shadow-lg bg-slate-800/40 border-2 border-slate-400/80 border-dashed rounded-md relative overflow-auto">
                            <p class="text-sm text-center text-slate-200">Additional image</p>
                            <input type="file" name="[img]" onchange="changeBackground(this)" class="absolute top-0 left-0 cursor-pointer opacity-0 w-full h-full">
                        </div>
                    </div>
                </div>
                <div class="text-right mt-4">
                    <button class="px-3 py-2 bg-gradient-to-tr from-indigo-600 to-purple-600 rounded-md">Add a
                        product</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function setCategoryValue(id, full_hierarchy) {
            //set the given id in category_id
            $("input[name='category_id']").val(id);
            $("#categories-list").html("");
            $("#category").val(full_hierarchy);
        }
        $(document).ready(function() {
            $("#category").on("input", async function() {
                const value = $(this).val();
                if (value.length > 2) {
                    const {
                        data
                    } = await axios.get("/category/search/" + value);
                    console.log(data);
                    /* prepare markup list for categories list and set in #categories list [{id:1, full_hierarchy: "Category name"},{...}] */
                    const categoryMarkup = `
  <ul>
    ${data.map(category => `<li onclick="setCategoryValue(${category.id}, '${category.full_hierarchy}')" class="text-sm cursor-pointer hover:bg-slate-900/50 p-2">${category.full_hierarchy}</li>`).join('')}
  </ul>
`;
                    $("#categories-list").html(categoryMarkup);
                } else
                    $("#categories-list").html("");
            })


        })
    </script>
@endsection
