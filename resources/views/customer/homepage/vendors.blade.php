@if (auth()->user() && auth()->user()->municipality)
    <div class="w-full bg-slate-50 dark:bg-slate-800 py-2 text-slate-800 dark:text-slate-200">
        <div class="container vendors-container mx-auto">
            <h1 class="text-center text-lg mb-3">Visit Nearby Vendors</h1>
            <div class="vendors-carousel-container">
                <div class="vendors-carousel">
                    @for ($i = 0; $i < 10; $i++)
                        <div class="px-5 flex flex-col gap-2">
                            <div class="skeleton rounded-md overflow-hidden w-40 h-32"></div>
                            <div class="skeleton mt-1 rounded-md overflow-hidden w-40 h-7"></div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            slickContent();

            $.ajax({
                url: '/homepageApi/vendors',
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    replaceVendors(data);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    console.log(status);
                    console.log(error);
                }
            });


            function replaceVendors(vendors) {
                var carouselContainer = $('.vendors-carousel-container');
                var carousel = $('<div>').addClass('vendors-carousel');
                $(carouselContainer).html(carousel);

                // Iterate over vendors and create vendor elements
                vendors.forEach(function(vendor) {
                    $(carousel).append(
                        `<a href="/shop/${vendor.id}" class="block relative">
                            <div class="w-48 max-[1024px]:w-44 min-[1367px]:w-52 h-40 relative rounded-lg overflow-hidden">
                                <img src="${vendor.user.profile_photo.replace('public', 'storage')}" alt="" class="w-full h-full object-cover">
                                <div class="absolute z-10 w-full h-full top-0 left-0 bg-gradient-to-b to-slate-950 via-slate-950/50 from-transparent overflow-hidden">
                                    <div class="absolute bottom-0 text-white py-1">
                                        <p class="font-bold px-2 text-sm line-clamp-2">${vendor.shop_name}</p>    
                                        <p class="font-bold px-2 text-xs line-clamp-1">
                                           <i class='fa fa-map-marker mr-1' style='font-size:10px'></i> ${vendor.user.ward}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>`
                    );
                });
                slickContent();
            }




            function slickContent() {
                $('.vendors-carousel').slick({
                    slidesToShow: 7,
                    arrows: true,
                    adaptiveHeight: true,
                    autoplay: true,
                    autoplaySpeed: 1000,
                    responsive: [{
                            breakpoint: 1920,
                            settings: {
                                slidesToShow: 7,
                                arrows: true
                            }
                        },
                        {
                            breakpoint: 1536,
                            settings: {
                                slidesToShow: 6,
                                arrows: true
                            }
                        },
                        {
                            breakpoint: 1366,
                            settings: {
                                slidesToShow: 6,
                                arrows: true
                            }
                        },
                        {
                            breakpoint: 1280,
                            settings: {
                                slidesToShow: 5,
                                arrows: true
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4,
                                arrows: true
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3,
                                arrows: true
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 2,
                                arrows: true
                            }
                        }
                    ]
                });
            }

        });
    </script>
@endif
