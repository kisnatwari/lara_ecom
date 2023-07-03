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
    $(document).ready(function() {
    $.ajax({
        url: '/homepageApi/productsFromMunicipality',
        type: 'GET',
        success: function(data) {
            console.log(data);
            replaceMunicipalityProducts(data);
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            console.log(status);
            console.log(error);            
        },
        complete:function(){
            loadProductsFromDistrict();
        }
    });

    function loadProductsFromDistrict() {
        $.ajax({
            url: '/homepageApi/productsFromDistrict',
            type: 'GET',
            success: function(data) {
                console.log(data);
                replaceDistrictProducts(data);
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);
            },
            complete:function(){
                loadRandomProducts();
            }
        });
    }

    function loadRandomProducts() {
        $.ajax({
            url: '/homepageApi/randomProducts',
            type: 'GET',
            success: function(data) {
                replaceRandomProducts(data);
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);
            }
        });
    }
});

</script>
