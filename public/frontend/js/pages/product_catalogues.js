const ProductCatalogue = {
    initPriceSlider: function() {
        const $priceSlider = $('#price-slider');
        const $priceMin = $('.price-min');
        const $priceMax = $('.price-max');
        const $inputMin = $('.price-input-min');
        const $inputMax = $('.price-input-max');
    
        let timeout;
    
        if ($priceSlider.length) {
            noUiSlider.create($priceSlider[0], {
                start: [100000, 1000000],
                connect: true,
                range: {
                    'min': 100000,
                    'max': 5000000
                },
                step: 10000,
                format: {
                    to: function(value) {
                        return Math.round(value).toLocaleString('vi-VN') + 'đ';
                    },
                    from: function(value) {
                        return Number(value.replace(/\D/g, ''));
                    }
                }
            });
    
            $priceSlider[0].noUiSlider.on('update', function(values, handle) {
                if (handle === 0) {
                    $priceMin.text(values[0]);
                    $inputMin.val(values[0].replace('đ', '').trim());
                } else {
                    $priceMax.text(values[1]);
                    $inputMax.val(values[1].replace('đ', '').trim());
                }
    
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                    ProductCatalogue.sendDataFilter(HT.currentPage, values[0], values[1]);
                }, 500);
            });
    
            $inputMin.on('change', function() {
                const minValue = Number($(this).val().replace(/\D/g, ''));
                $priceSlider[0].noUiSlider.set([minValue, null]);
                ProductCatalogue.sendDataFilter(HT.currentPage, minValue, null);
            });
    
            $inputMax.on('change', function() {
                const maxValue = Number($(this).val().replace(/\D/g, ''));
                $priceSlider[0].noUiSlider.set([null, maxValue]);
                ProductCatalogue.sendDataFilter(HT.currentPage, null, maxValue);
            });
        }
    },
    
    sendDataFilter: function(page = 1, minPrice = null, maxPrice = null) {
        let dataFilterSend = { page: page };
    
        $('.filter-data').find("input, select").each(function () {
            const $this = $(this);
            const name = $this.attr("name");
            const type = $this.attr("type");
            
            if (!name) return;
            
            if (type === 'checkbox' || type === 'radio') {
                if ($this.is(':checked')) {
                    if (type === 'checkbox') {
                        if (!dataFilterSend[name]) {
                            dataFilterSend[name] = [];
                        }
                        dataFilterSend[name].push($this.val());
                    } else {
                        dataFilterSend[name] = $this.val();
                    }
                }
            } else {
                dataFilterSend[name] = $this.val();
            }
        });
    
        // Add price filters if specified
        if (minPrice !== null) {
            dataFilterSend['price_min'] = minPrice;
        }
        if (maxPrice !== null) {
            dataFilterSend['price_max'] = maxPrice;
        }

        $.ajax({
            url: '/ajax/product/filterUser',
            type: 'GET',
            data: dataFilterSend,
            dataType: 'json',
            success: function (response) {
                const productList = $('.product-list');
                productList.empty();
                
                let productsData = [];
                
                if (response.data) {
                    if (response.data.data && Array.isArray(response.data.data)) {
                        productsData = response.data.data;
                    } else if (typeof response.data === 'object' && !Array.isArray(response.data)) {
                        productsData = Object.values(response.data).filter(item => item !== null);
                    } else if (Array.isArray(response.data)) {
                        productsData = response.data;
                    }
                }

                const totalProducts = response.total || productsData.length;
                const resultCount = $('.result-count');
                resultCount.find('span').last().text(totalProducts);
                
                if (productsData.length > 0) {
                    const baseUrl = window.location.origin;
                    
                    productsData.forEach(item => {
                        if (!item) return;
                        
                        const name = item.name || 'Sản phẩm';
                        const brand = item.brand || item.vendor || 'Thương hiệu';
                        const image = item.image && item.image.startsWith('http') ? item.image : `${baseUrl}${item.image || ''}`;
                        const canonical = `${baseUrl}/${item.canonical || 'product-detail'}.html`;
                        
                        // Process promotion
                        let promotion = null;
                        let discount = null;
                        let price = "0";
                        let comparePrice = "";
                        let discountPercent = "";
                        
                        if (item.product_variants && item.product_variants.length > 0) {
                            price = new Intl.NumberFormat('vi-VN').format(item.product_variants[0].price || item.price || 0) + '₫';
                        } else if (item.price) {
                            price = new Intl.NumberFormat('vi-VN').format(item.price) + '₫';
                        }
                        
                        if (item.promotion) {
                            promotion = item.promotion;
                            if (promotion.discountType === 'percent') {
                                discountPercent = Math.round(promotion.discountValue) + '%';
                                comparePrice = new Intl.NumberFormat('vi-VN').format(promotion.product_price) + '₫';
                                price = new Intl.NumberFormat('vi-VN').format(promotion.product_price - promotion.finalDiscount) + '₫';
                            }
                        }
                        
                        const totalReviews = item.reviews_count || 0;
                        let totalRate = 0;
                        
                        if (totalReviews > 0 && item.reviews && item.reviews.length > 0) {
                            const sum = item.reviews.reduce((acc, review) => acc + review.score, 0);
                            totalRate = parseFloat((sum / totalReviews).toFixed(1));
                        }
                        
                        let productHtml = `
                        <div class="col-lg-3 col-md-3 col-sm-3 col-6 product-col">
                            <div class="item_product_main">
                                    <div class="product-thumbnail pos-relative">
                                        <a class="image_thumb pos-relative embed-responsive embed-responsive-1by1" href="${canonical}" title="${name}">
                                            <img
                                                width="480"
                                                height="480"
                                                style="--image-scale: 1;"
                                                src="${image}"
                                                alt="${name}"
                                            />
                                        </a>`;

                        // Promotion label
                        if (promotion) {
                            productHtml += `
                                        <div class="label_product">
                                            <div class="label_wrapper">
                                                -${discountPercent}
                                            </div>
                                        </div>`;
                        }

                        // Quick view button
                        productHtml += `
                                        <div class="product-action">
                                            <div class="group_action" data-url="${canonical}">
                                                <a title="Xem nhanh" href="${canonical}" data-handle="${item.canonical || 'product-detail'}" class="xem_nhanh btn-circle btn-views btn_view btn right-to quick-view">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            </div>
                                            <div class="group_action" data-url="${canonical}">
                                                <button
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#productDetailModal"
                                                    class="btn-circle btn-views btn_view btn show-product-btn right-to">
                                                    <i class="fas fa-search"></i>
                                                    <input type="hidden" name="product_id" value="${item.id}">
                                                    <input type="hidden" name="language_id" value="${item.language_id || 1}">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <span class="product-vendor">${brand}</span>
                                        <h3 class="product-name"><a href="${canonical}" title="${name}">${name}</a></h3>`;

                        // Reviews
                        productHtml += `
                                        <div class="sapo-product-reviews-badge" data-id="${item.id}">
                                            <div class="sapo-product-reviews-star" data-score="${totalRate}" data-number="5" style="color: #ffbe00;" title="${totalRate > 0 ? 'Rated ' + totalRate + ' stars' : 'Not rated yet!'}">`;
                        
                        // Generate star icons
                        for (let i = 1; i <= 5; i++) {
                            const starClass = i <= totalRate ? 'star-on-png' : 'star-off-png';
                            productHtml += `<i data-alt="${i}" class="${starClass}" title="${i <= totalRate ? 'Rated' : 'Not rated'}"></i>&nbsp;`;
                        }
                        
                        productHtml += `
                                                <input name="score" type="hidden" readonly="" />
                                            </div>
                                        </div>`;

                        // Price and add to cart
                        productHtml += `
                                        <div class="product-item-cta position-relative">
                                            <div class="price-box">
                                                <span class="price">${price}</span>`;

                        if (promotion) {
                            productHtml += `
                                                <span class="compare-price">${comparePrice}</span>`;
                        }

                        // Mobile discount label
                        if (promotion) {
                            productHtml += `
                                                <div class="label_product d-lg-none d-md-none d-xl-none d-inline-block">
                                                    <div class="label_wrapper">
                                                        -${discountPercent}
                                                    </div>
                                                </div>`;
                        }

                        productHtml += `
                                            </div>
                                            <input type="hidden" name="variantId" value="${item.product_variants && item.product_variants.length > 0 ? item.product_variants[0].id : ''}" />
                                            <button class="product-item-btn btn add_to_cart active" title="Thêm vào giỏ hàng">
                                                <svg class="icon">
                                                    <use xlink:href="#icon-plus"></use>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                            </div>
                        </div>`;
                        
                        productList.append(productHtml);
                    });
                    
                    console.log(response.data.links)
                    Product.setupProductDetailAndShowModal();
                    Library.renderPagination(response);
                } else {
                    productList.html('<div class="col-12 text-center py-5"><p>Không tìm thấy sản phẩm phù hợp</p></div>');
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    console.error('Validation Error: ', xhr.responseText);
                } else {
                    console.error('AJAX Error: ', xhr.responseText);
                }
            },
        });
    },

    generateStar: function(rating) {
        const fullStars = Math.floor(rating);
        const halfStar = rating % 1 >= 0.5 ? 1 : 0;
        const emptyStars = 5 - fullStars - halfStar;
        
        let stars = '';
        for (let i = 0; i < fullStars; i++) {
            stars += '<i class="fas fa-star"></i>';
        }
        if (halfStar) {
            stars += '<i class="fas fa-star-half-alt"></i>';
        }
        for (let i = 0; i < emptyStars; i++) {
            stars += '<i class="far fa-star"></i>';
        }
        return stars;
    },

    attachPaginationEvent: function () {
        $(document).on('click', '.pagination .page-link', function (e) {
            e.preventDefault();

            let page = $(this).data('page');
            HT.currentPage = page;
            if (!page) return;

            
            ProductCatalogue.sendDataFilter(HT.currentPage);
        });
    },

    attachFilterEvent: function () {
        $(".filter-data").find("input, select").on("input change", function () {
            clearTimeout(HT.filterTimeout);

            HT.filterTimeout = setTimeout(() => {
                ProductCatalogue.sendDataFilter();
            }, 500);
        });
    },

    initMobileFilterToggle: function() {
        const $filterBtn = $('#mobile-filter-btn');
        const $filterWrapper = $('.filter-card-wrapper');
        const $closeBtn = $('.btn-close-filter');

        $filterBtn.on('click', function () {
            console.log(123);
            $filterWrapper.addClass('show');
            $('body').addClass('filter-open');
        });

        $closeBtn.on('click', function () {
            $filterWrapper.removeClass('show');
            $('body').removeClass('filter-open');
        });
    }
};

ProductCatalogue.attachFilterEvent = function () {
    $(".filter-data").on("change", "input, select", function () {
        clearTimeout(HT.filterTimeout);
        HT.filterTimeout = setTimeout(() => {
            ProductCatalogue.sendDataFilter();
        }, 500);
    });
};


ProductCatalogue.attachResetEvent = function () {
    $(".btn-reset").on("click", function(e) {
        e.preventDefault();
        
        $('.filter-data').find("input[type=checkbox], input[type=radio]").prop('checked', false);
        $('.filter-data').find("select").val('');
        $('.filter-data').find("input[type=text], input[type=number]").val('');
        
        if ($('#price-slider')[0].noUiSlider) {
            $('#price-slider')[0].noUiSlider.set([100000, 5000000]);
        }
        
        $('.price-min').text('100.000đ');
        $('.price-max').text('1.000.000đ');
        $('.price-input-min').val('100000');
        $('.price-input-max').val('5000000');
        
        ProductCatalogue.sendDataFilter(1);
    });
};

ProductCatalogue.attachResetFilterSections = function () {
    $('.btn-reset-section').off('click').on('click', function (e) {
        e.preventDefault(); 
        e.stopPropagation();
        e.stopImmediatePropagation();

        const section = $(this).data('section');

        if (section === 'price') {
            if ($('#price-slider')[0].noUiSlider) {
                $('#price-slider')[0].noUiSlider.set([100000, 5000000]);
            }
            $('.price-min').text('100.000đ');
            $('.price-max').text('5.000.000đ');
            $('.price-input-min').val('100000');
            $('.price-input-max').val('5000000');

        } else if (section === 'rating') {
            $('input[name="score"]').prop('checked', false);

        } else if (section.startsWith('attribute-')) {
            const groupId = section.replace('attribute-', '');
            $(`.filterAttribute[data-group="${groupId}"]`).prop('checked', false);
        }

        ProductCatalogue.sendDataFilter(1);
    });
};

$(document).ready(function () {
    ProductCatalogue.initPriceSlider();
    ProductCatalogue.sendDataFilter();
    ProductCatalogue.attachFilterEvent();
    ProductCatalogue.attachPaginationEvent();
    ProductCatalogue.attachResetEvent();
    ProductCatalogue.attachResetFilterSections();
    ProductCatalogue.initMobileFilterToggle();
    HT.attachFilterEvent(ProductCatalogue);
});