@extends('customer.index')

@section('children')
    @php
        // Extract image URL from product images data
        $image = json_decode($product->images, true)[0];
        if (strpos($image, 'https://') !== 0 && strpos($image, 'http://') !== 0) {
            $imageUrl = Storage::url($image);
        } else {
            $imageUrl = $image;
        }
    @endphp
    <div class="pt-2 flex-grow">
        <div class="bg-white/100 dark:bg-slate-800 py-5 mb-2 min-h-full">
            <div class="container mx-auto flex flex-col md:flex-row gap-5 h-full">
                {{-- Product view --}}
                <div
                    class="flex flex-row md:flex-col flex-wrap gap-3 md:w-60 lg:w-72 xl:w-80 bg-slate-700/40 p-3 product-view">
                    <img src="{{ $imageUrl }}" alt="" class="w-20 md:w-80 h-fit rounded-lg">
                    <div class="p-2">
                        <h1 class="text-xl"> {{ $product->product_name }} </h1>
                        <p> {{ $product->seller->shopCategory->name }} </p>
                        <p class="text-sm font-bold"> Rs {{ number_format($product->price, 2, '.', ',') }} </p>
                        <p> {{ $product->seller->shop_name }} </p>
                        <p class="text-sm">
                            {{ $product->seller->user->municipality->municipality_name }} ,
                            {{ $product->seller->user->municipality->district->district_name }}
                        </p>
                        <x-star :rating="$averageRating" size='lg' />
                        <span class="text-xs">
                            {{ round($averageRating, 2) }} from {{ $totalRatings }} ratings
                        </span>
                        <hr>
                        <div class="my-5">
                            {{-- showing counted stars for each numbers --}}
                            @foreach ($num_ratings as $star => $count)
                                <div class="flex gap-5 md:gap-2 lg:gap-5 mb-2 items-center flex-wrap">
                                    <x-star :rating="$star" size='xs' />
                                    <div class="w-20 sm:w-40 md:w-6 lg:w-20 h-2 border border-yellow-600 rounded-lg">
                                        <div class="bg-yellow-600 h-full"
                                            style="width: {{ $totalRatings > 0 ? ($count / $totalRatings) * 100 : 0 }}%">
                                        </div>
                                    </div>
                                    <span> {{ $count }} </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Reviews Section --}}
                <div class="flex-grow  h-full overflow-hidden">
                    <div class="bg-slate-700/40 p-3 rounded-lg shadow-lg">
                        <fieldset class="border-0 border-t">
                            <legend class="text-slate-300 text-xl">Express your experience&nbsp;</legend>
                        </fieldset>
                        @if ($userRating)
                            {{-- Showing logged in user's rating if available --}}
                            <div class="bg-slate-950/30 p-3 rounded-lg border border-dashed border-slate-600 mt-2 ">
                                <p class="text-lg"> {{ $userRating->user->name }} </p>
                                <x-star :rating="$userRating->rating" size="sm" />
                                <p>{{ $userRating->comment }}</p>
                                <form class="text-end" action="{{ route('rating.destroy', $userRating->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-700 px-3 py-1 rounded">Delete Review</button>
                                </form>
                            </div>
                        @else
                            <form action="{{ route('rating.store', $product->id) }}" method="POST"
                                class="bg-slate-950/40 p-3 rounded-lg border border-dashed border-slate-600 mt-2">
                                @csrf
                                <div class="flex flex-col gap-2">
                                    <div class="flex flex-col gap-1">
                                        <span>Leave a star...</span>
                                        <div class="text-yellow-400 stars">
                                            <i class="fa-regular fa-star cursor-pointer"></i>
                                            <i class="fa-regular fa-star cursor-pointer"></i>
                                            <i class="fa-regular fa-star cursor-pointer"></i>
                                            <i class="fa-regular fa-star cursor-pointer"></i>
                                            <i class="fa-regular fa-star cursor-pointer"></i>
                                        </div>
                                        <input type="hidden" name="star-rating" required>
                                        <script>
                                            const stars = document.querySelectorAll('.stars .fa-star');
                                            const ratingInput = document.querySelector('input[name="star-rating"]');

                                            stars.forEach((star, index) => {
                                                star.addEventListener('click', () => {
                                                    for (let i = 0; i <= index; i++) {
                                                        stars[i].classList.remove('fa-regular');
                                                        stars[i].classList.add('fa-solid');
                                                    }
                                                    for (let i = index + 1; i < stars.length; i++) {
                                                        stars[i].classList.remove('fa-solid');
                                                        stars[i].classList.add('fa-regular');
                                                    }
                                                    ratingInput.value = index + 1;
                                                });
                                            });
                                        </script>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <label for="comment" class="text-sm">Comment</label>
                                        <textarea name="comment" id="comment" rows="2" placeholder="Write your experience about this product..."
                                            class="border-0 border-b-2 border-white/20 bg-black/20 resize-none focus:ring-0"></textarea>
                                    </div>
                                </div>
                                <div class="text-end mt-4">
                                    <button type="submit" class="bg-indigo-700 text-white px-5 py-2 pb-1 rounded">Post
                                        a
                                        review</button>
                                </div>
                            </form>
                        @endif

                        {{-- Showing all reviews of different customers --}}
                        <div class="flex flex-col gap-4 pt-3">
                            @foreach ($allRating as $rating)
                                <div class="bg-slate-950/20 p-3 rounded">
                                    <div class="flex justify-between mb-1">
                                        <p class="text-sm text-slate-300">{{ $rating->user->name }}</p>
                                        <p class="text-sm text-slate-400">{{ $rating->created_at->diffForHumans() }}</p>
                                    </div>
                                    <x-star :rating="$rating->rating" size="xs" />
                                    <p class="text-slate-300">{{ $rating->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
