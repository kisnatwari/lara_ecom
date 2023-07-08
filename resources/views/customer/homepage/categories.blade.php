<style>
  .slick-prev:before, .slick-next:before {
    color: #222;
  }

  .dark .slick-prev:before, .dark .slick-next:before {
    color: #ddd;
  }
</style>
<div class="w-full bg-slate-50 dark:bg-slate-800 text-slate-800 dark:text-slate-200 py-2">
  <div class="container mx-auto">
    <h1 class="text-center text-lg mb-3">Categories</h1>
    <div class="category-carousel">
      @foreach ($shopcategories as $shopcategory )
        <div>
          <a href="{{route('shopcategory', $shopcategory -> id)}}" class="w-24 block">
            <img src="{{Storage::url("/categories/". $shopcategory->name . ".jpg")}}" alt="" class="w-full h-24 object-cover">
            <p class="font-bold px-2 py-1 text-center text-xs">{{ $shopcategory->name }}</p>
          </a>
        </div>
      @endforeach
    </div>
  </div>
</div>
  
<script type="text/javascript">
  $(document).ready(function() {
    $('.category-carousel').slick({
      slidesToShow: 11,
      dots: false,
      arrows: true,
      adaptiveHeight: true,
      autoplay: true,
      autoplaySpeed:1000,
      responsive: [
        {
          breakpoint: 1920,
          settings: {
            slidesToShow: 11
          }
        },
        {
          breakpoint: 1366,
          settings: {
            slidesToShow: 10,
          }
        },
        {
          breakpoint: 1280,
          settings: {
            slidesToShow: 8,
          }
        },
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 6,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 4,
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 2,
          }
        }
      ]
    });
  });
</script>