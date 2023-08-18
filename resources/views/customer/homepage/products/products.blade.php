@include('customer.homepage.products.productsFromMunicipality')
@include('customer.homepage.products.productsFromDistrict')
@include('customer.homepage.products.randomProducts')

<script>
    function getProductImageUrl(images) {
        var imageArray = JSON.parse(images);
        var imageUrl = imageArray.length > 0 ? imageArray[0] : '/storage/default-image.png';

        if (imageUrl.startsWith('https://') || imageUrl.startsWith('http://')) {
            console.log(imageUrl);
            return imageUrl;
        } else {
            return imageUrl.replace("public", "storage");
        }
    }

    $(window).on('load', function() {
        @if (auth()->user() && auth()->user()->municipality)
            $.ajax({
                url: '/homepageApi/productsFromMunicipality',
                type: 'GET',
                success: data => replaceMunicipalityProducts(data),
                error: (xhr, status, error) => {
                    console.log(xhr.responseText);
                    console.log(status);
                    console.log(error);
                },
                complete: () => loadProductsFromDistrict()
            });

            function loadProductsFromDistrict() {
                $.ajax({
                    url: '/homepageApi/productsFromDistrict',
                    type: 'GET',
                    success: data => replaceDistrictProducts(data),
                    error: (xhr, status, error) => {
                        console.log(xhr.responseText);
                        console.log(status);
                        console.log(error);
                    },
                    complete: () => loadRandomProducts()
                });
            }
        @else
            loadRandomProducts();
        @endif
        function loadRandomProducts() {
            $.ajax({
                url: '/homepageApi/randomProducts',
                type: 'GET',
                success: data => replaceRandomProducts(data),
                error: (xhr, status, error) => {
                    console.log(xhr.responseText);
                    console.log(status);
                    console.log(error);
                },
                complete: () => refreshDynamicLink()
            });
        }
    });

    function getStarRating(rating, size) {
        let fullStars = Math.floor(rating);
        let halfStar = rating - fullStars >= 0.5;
        let output = '';
        for (let i = 1; i <= fullStars; i++) {
            output += '<i class="fa fa-star text-yellow-500"></i>';
        }
        if (halfStar) {
            output += '<i class="fas fa-star-half-stroke text-yellow-500"></i>';
        }
        for (let i = fullStars + (halfStar ? 1 : 0) + 1; i <= 5; i++) {
            output += '<i class="far fa-star text-yellow-500"></i>';
        }
        return '<p class="text-' + size + '">' + output + '</p>';
    }
</script>
