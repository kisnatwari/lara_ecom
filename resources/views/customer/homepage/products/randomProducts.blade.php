<div class="w-full bg-slate-50 dark:bg-slate-800 text-slate800 dark:text-slate-200 py-2">
    <div class="container mx-auto">
        <h1 class="text-center text-lg flex justify-between items-end">
            <span>Some Random Products</span>
            <a href="#" class="text-sm dark:text-indigo-300 text-indigo-700">See All</a>
        </h1>
        <div
            class="grid random-products-grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-8 gap-2">
            @for ($i = 0; $i < 20; $i++)
                <x-homepage-product-card-skeleton/>
            @endfor
        </div>
    </div>
    <script>
        function replaceRandomProducts(products) {
            var productContainer = $(".random-products-grid");
            productContainer.empty();
            products.forEach(product => {
                // Replace products in the above grid
                productContainer.append(`
                        <a href="/products/${product.id}" class="mx-auto my-2 shadow w-44 sm:w-52 md:w-[185px] lg:w-[200px] xl:w-52 2xl:w-[185px] dark:bg-slate-900/60 dark:text-slate-200 text-slate-700 overflow-hidden rounded-md bg-white">
                            <img src="${getProductImageUrl(product.images)}" alt="" class="h-44 sm:h-52 md:h-[185px] lg:h-[200px] xl:h-52 2xl:h-[185px] w-full object-cover rounded-b">
                            <div class="px-2 py-1">
                                <h5 class="text-md line-clamp-1" title="${product.product_name}">
                                    ${product.product_name}
                                </h5>
                                <p class="text-sm font-bold">
                                    <small class="text-muted" title="${product.price}">
                                        Rs ${product.price}
                                    </small>
                                </p>
                                <p data-href="/shop/${product.seller.id}" class="dynamic-link text-sm dark:text-slate-400 text-slate-700 line-clamp-1" title="${product.seller.shop_name}">
                                    ${product.seller.shop_name}
                                </p>
                                <p class="text-xs line-clamp-1" title="${product.seller.user.municipality.district.district_name} (${product.seller.user.municipality.municipality_name})">
                                    <span class="font-bold dark:text-slate-300 text-slate-700">
                                        ${product.seller.user.municipality.district.district_name}
                                    </span>
                                    (${product.seller.user.municipality.municipality_name})
                                </p>
                            </div>
                        </a>
                    `);
            });
        }
    </script>
</div>
