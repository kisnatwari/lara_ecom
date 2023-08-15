@props(['rating', 'size' => 'sm'])

<p class="text-{{ $size }}">
    @php
        $fullStars = floor($rating);
        $halfStar = $rating - $fullStars >= 0.5;
    @endphp
    @for ($i = 1; $i <= $fullStars; $i++)
        <i class="fa fa-star text-yellow-500"></i>
    @endfor
    @if ($halfStar)
        <i class="fas fa-star-half-stroke text-yellow-500" style="font-size: {{ $size }};"></i>
    @endif
    @for ($i = $fullStars + ($halfStar ? 1 : 0) + 1; $i <= 5; $i++)
        <i class="far fa-star text-yellow-500" style="font-size: {{ $size }};"></i>
    @endfor
</p>
