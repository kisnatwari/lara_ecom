@extends('seller.layouts')

@section('content')
<div class="h-full p-2">
    <div class="h-full overflow-auto flex flex-col justify-center items-center bg-white/5 p-2">
      <form class="min-w-[300px] relative">
        <h1 class="mb-4 border-b">Upload Products here</h1>
        <div class="flex flex-col gap-4">
          <input type="text" id="product-name" placeholder="Enter name of your product to be uploaded" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-slate-700 dark:bg-opacity-50" />
          <div class="flex gap-4">
            <input type="text" id="product-price" placeholder="Price" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-slate-700 dark:bg-opacity-50" required />
            <input type="text" id="product-brand" placeholder="Brand name" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-slate-700 dark:bg-opacity-50" required />
            <input type="text" id="product-quantity" placeholder="Quantity" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-slate-700 dark:bg-opacity-50" required />
          </div>
          <div>
            <label for="category">Category</label>
            <input type="text" id="category" placeholder="Start typing to choose category name" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-slate-700 dark:bg-opacity-50" />
            <div class="relative mt-1">
              {{-- <div class="absolute top-0 left-0 w-full min-h-[150px] bg-slate-950/60 backdrop-blur-lg">
                <!-- Categories dynamically rendered here -->
              </div> --}}
            </div>
          </div>
          <textarea placeholder="Write some description about the product" rows="3" class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-slate-700 dark:bg-opacity-50"></textarea>
        </div>
        <div class="text-right mt-4">
          <button class="px-3 py-2 bg-gradient-to-tr from-indigo-600 to-purple-600 rounded-md">Add a product</button>
        </div>
      </form>
    </div>
  </div>
  
@endsection