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
                    <div class="p-2 min-w-[20rem]">
                        <h1 class="text-xl"> {{ $product->product_name }} </h1>
                        <p> {{ $product->seller->shopCategory->name }} </p>
                        <p class="text-sm font-bold"> Rs {{ number_format($product->price, 2, '.', ',') }} </p>
                        <p> {{ $product->seller->shop_name }} </p>
                        <p class="text-sm">
                            {{ $product->seller->user->municipality->municipality_name }} ,
                            {{ $product->seller->user->municipality->district->district_name }}
                        </p>
                        {{-- show five star rating --}}
                        <p>
                            @php
                                $rating = $averageRating;
                                $fullStars = floor($rating);
                                $halfStar = $rating - $fullStars >= 0.5;
                            @endphp
                            @for ($i = 1; $i <= $fullStars; $i++)
                                <i class="fa fa-star text-yellow-500"></i>
                            @endfor
                            @if ($halfStar)
                                <i class="fas fa-star-half-stroke text-yellow-500"></i>
                            @endif
                            @for ($i = $fullStars + ($halfStar ? 1 : 0) + 1; $i <= 5; $i++)
                                <i class="far fa-star text-yellow-500"></i>
                            @endfor
                            <span class="text-xs block">({{ round($averageRating, 2) }}) from {{ $allRating->count() }}
                                ratings</span>
                        </p>
                    </div>
                </div>

                {{-- Reviews Section --}}
                <div class="flex-grow  h-full overflow-hidden">
                    <div class="bg-slate-700/40 p-3 rounded-lg shadow-lg">
                        <fieldset class="border-0 border-t">
                            <legend class="text-slate-300 text-xl">Express your experience&nbsp;</legend>
                        </fieldset>
                        @if ($userRating)
                            <div class="bg-slate-950/30 p-3 rounded-lg border border-dashed border-slate-600 mt-2 ">
                                <p class="text-lg"> {{ $userRating->user->name }} </p>
                                <div>
                                    <span class="text-xs">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $userRating->rating)
                                                <i class="fa fa-star text-yellow-500"></i>
                                            @else
                                                <i class="far fa-star text-yellow-500"></i>
                                            @endif
                                        @endfor
                                    </span>
                                </div>
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
                                    <div class="flex justify-between">
                                        <span class="flex flex-col">
                                            <p class="text-sm text-slate-300">{{ $rating->user->name }}</p>
                                            <span class="text-xs">
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $rating->rating)
                                                        <i class="fa fa-star text-yellow-500"></i>
                                                    @else
                                                        <i class="far fa-star text-yellow-500"></i>
                                                    @endif
                                                @endfor
                                            </span>
                                        </span>
                                        <p class="text-sm text-slate-400">{{ $rating->created_at->diffForHumans() }}</p>
                                    </div>
                                    <p class="mt-2 text-slate-300">{{ $rating->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
