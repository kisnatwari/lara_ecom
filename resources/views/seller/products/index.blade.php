@extends('seller.layouts')

@section('content')
    <div class="h-full">
        <div class='p-2 h-full flex flex-col gap-2'>
            <div class='bg-slate-900/30 flex-grow flex flex-col p-4'>
              <div class='flex justify-between'>
                <h1 class='text-xl font-bold'>All Products</h1>
                <a href="/seller/products/create" class='bg-gradient-to-tr from-indigo-800 to-purple-800 hover:brightness-90 active:brightness-95 duration-300 px-4 py-2 rounded-md flex items-center gap-2'>
                  <span>Add Products</span>
                </a>
              </div>
              <div class='flex-grow flex justify-center items-center'>
                <!-- Content for No products found -->
                <div class='text-center'>
                  
                  <h1 class='text-3xl font-bold dark:text-slate-200'>No products found</h1>
                  <p class='text-slate-300 dark:text-slate-400'>
                    You haven't added any products yet.
                  </p>
                  <p class='text-slate-300 dark:text-slate-400'>
                    You can add products by clicking the button above.
                  </p>
                </div>
              </div>
            </div>
          </div>
          
    </div>
@endsection