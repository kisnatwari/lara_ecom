@if (auth()->user() && auth()->user()->municipality)
    <div class="w-full bg-slate-50 dark:bg-slate-800 py-2 text-slate-800 dark:text-slate-200">
        <div class="container vendors-container mx-auto">
            <h1 class="text-center text-lg mb-3">Available Vendors</h1>
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
                        `<div>
                        <div class="w-40 ">
                            <img src="/storage/category.png" alt="" class="w-full h-24 object-cover">
                            <p class="font-bold px-2 py-1 text-start text-xs">${vendor.shop_name}</p>
                        </div>
                    </div>`
                    );
                });
                slickContent();
            }




            function slickContent() {
                $('.vendors-carousel').slick({
                    slidesToShow: 8,
                    dots: true,
                    arrows: true,
                    adaptiveHeight: true,
                    responsive: [{
                            breakpoint: 1920,
                            settings: {
                                slidesToShow: 8,
                                dots: true,
                                arrows: true
                            }
                        },
                        {
                            breakpoint: 1536,
                            settings: {
                                slidesToShow: 7,
                                dots: true,
                                arrows: true
                            }
                        },
                        {
                            breakpoint: 1366,
                            settings: {
                                slidesToShow: 6,
                                dots: true,
                                arrows: true
                            }
                        },
                        {
                            breakpoint: 1280,
                            settings: {
                                slidesToShow: 5,
                                dots: true,
                                arrows: true
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4,
                                dots: true,
                                arrows: true
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3,
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
            }

        });
    </script>
@endif
