<div class="w-full bg-slate-800 py-2">
    <div class="container mx-auto">
      <h1 class="text-center text-lg mb-3">Available Vendors</h1>
      <div class="vendors-carousel">
        @foreach ($vendors as $vendor)
        <div>
          <div class="w-40 shadow shadow-slate-600">
            <img src="/storage/category.png" alt="" class="w-full h-24 object-cover">
            <p class="font-bold px-2 py-1 text-start text-xs">{{ $vendor->shop_name }}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  
  <script type="text/javascript">
    $(document).ready(function() {
      $('.vendors-carousel').slick({
        slidesToShow: 11,
        dots: true,
        arrows: true,
        adaptiveHeight: true,
        responsive: [
          {
            breakpoint: 1920,
            settings: {
              slidesToShow: 11,
              dots: true,
              arrows: true
            }
          },
          {
            breakpoint: 1366,
            settings: {
              slidesToShow: 10,
              dots: true,
              arrows: true
            }
          },
          {
            breakpoint: 1280,
            settings: {
              slidesToShow: 8,
              dots: true,
              arrows: true
            }
          },
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 6,
              dots: true,
              arrows: true
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 4,
              dots: true,
              arrows: true
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 2,
              dots: true,
              arrows: true
            }
          }
        ]
      });
    });
  </script>