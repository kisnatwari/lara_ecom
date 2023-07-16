@extends('customer.index')

@section('children')
    <div class="flex flex-col gap-1 mt-1">
        <div class="w-full bg-slate-50 dark:bg-slate-800">
            <div class="container mx-auto flex flex-wrap p-2 justify-between items-center">
                <div class="flex gap-3">
                    <img src="{{ Storage::url('/categories/' . $shopcategory->name . '.jpg') }}" alt=""
                        class="w-10 h-10 object-cover rounded-full">
                    <h1 class="text-3xl text-slate-700 dark:text-slate-200">{{ $shopcategory->name }}</h1>
                </div>
                <p>{{ $sellers->count() }} sellers found in your area.</p>
            </div>
        </div>
        <div class="w-full bg-slate-50 dark:bg-slate-800">
            <div class="container mx-auto py-4 overflow-hidden">
                @if ($sellers->count() == 0)
                    <div class="w-full flex justify-center items-center">
                        <p class="text-lg text-slate-700 dark:text-slate-200">No shops of this category has been found in your area.</p>
                    </div>
                @else
                    <h1 class="text-lg mb-2">Related shops found in {{ auth()->user()->municipality->municipality_name }}
                        area</h1>
                    <div
                        class="grid grid-cols-1 min-[400px]:grid-cols-2 mx-auto w-fit sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-7 gap-4">

                        @foreach ($sellers as $seller)
                            <a href="/shop/{{ $seller->id }}" class="block relative">
                                <div
                                    class="w-48 max-[1024px]:w-44 min-[1367px]:w-52 h-40 relative rounded-lg overflow-hidden">
                                    <img src="{{ Storage::url($seller->user->profile_photo) }}" alt=""
                                        class="w-full h-full object-cover">
                                    <div
                                        class="absolute z-10 w-full h-full top-0 left-0 bg-gradient-to-b to-slate-950 via-slate-950/50 from-transparent overflow-hidden">
                                        <div class="absolute bottom-0 text-white py-1">
                                            <p class="font-bold px-2 text-sm line-clamp-2">{{ $seller->shop_name }}</p>
                                            <p class="font-bold px-2 text-xs line-clamp-1">
                                                <i class='fa fa-map-marker mr-1' style='font-size:10px'></i>
                                                {{ $seller->user->ward }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
