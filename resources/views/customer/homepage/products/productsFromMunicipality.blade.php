@if (auth()->user() && auth()->user()->municipality_id)
    <div class="w-full bg-slate-50 dark:bg-slate-800 text-slate800 dark:text-slate-200 py-2">
        <div class="container mx-auto">
            <h1 class="text-center text-lg flex justify-between items-end">
                <span>Products in your area ({{ auth()->user()->municipality->municipality_name }})</span>
                <a href="#" class="text-sm dark:text-indigo-300 text-indigo-700">See All</a>
            </h1>
            <div
                class="grid product-municipality-grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-8 gap-2">
                @for ($i = 0; $i < 30; $i++)
                    <x-homepage-product-card-skeleton />
                @endfor
            </div>
        </div>
        <script>
            function replaceMunicipalityProducts(products) {
                var productContainer = $(".product-municipality-grid");
                productContainer.empty();
                products.forEach(product => {
                    productContainer.append(`
                        <a href="products/${product.id}" class="mx-auto my-2 shadow w-44 sm:w-52 md:w-[185px] lg:w-[200px] xl:w-52 2xl:w-[185px] bg-white dark:bg-slate-900/60 dark:text-slate-200 text-slate-700 overflow-hidden rounded-md">
                            <div class="w-full h-44 sm:h-52 md:h-[185px] lg:h-[200px] xl:h-52 2xl:h-[185px] rounded-b">
                                <img src="${getProductImageUrl(product.images)}" alt="" class="w-full h-full object-cover">
                            </div>
                            <div class="px-2 py-1">
                                <p class="text-md line-clamp-1">${product.product_name}</p>
                                <small class="line-clamp-1">${product.seller.shop_name}</small>
                                <small class="line-clamp-1">Rs ${product.price}</small>
                                <small class="line-clamp-1">
                                    ${product.seller.user.ward}
                                </small>
                            </div>
                        </a>
                    `);
                });
            }
        </script>
    </div>
@endif
