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
                start: [100000, 500000],
                connect: true,
                range: {
                    'min': 100000,
                    'max': 1000000
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
    
        // Collect all filter inputs
        $('.filter-data').find("input, select").each(function () {
            const $this = $(this);
            const name = $this.attr("name");
            const type = $this.attr("type");
            
            if (!name) return;
            
            // Handle different input types
            if (type === 'checkbox' || type === 'radio') {
                if ($this.is(':checked')) {
                    // For checkbox groups, create array if multiple selections allowed
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
                // Handle text inputs, hidden fields, etc.
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
                        const image = item.image && item.image.startsWith('http') ? item.image : `${baseUrl}${item.image || ''}`;
                        const canonical = `${baseUrl}/${item.canonical || 'product-detail'}.html`;
                        
                        const total = Math.floor(Math.random() * 71) + 30; // 30-100
                        const sold = Math.floor(Math.random() * total) + 1; // 1-total
                        const percent = Math.round((sold / total) * 100);
                        
                        // Process promotion
                        let promotion = null;
                        let discount = null;
                        let price = "0";
                        
                        if (item.product_variants && item.product_variants.length > 0) {
                            price = new Intl.NumberFormat('vi-VN').format(item.product_variants[0].price || item.price || 0);
                        } else if (item.price) {
                            price = new Intl.NumberFormat('vi-VN').format(item.price);
                        }
                        
                        if (item.promotion) {
                            promotion = item.promotion;
                            if (promotion.discountType === 'percent') {
                                discount = {
                                    type: '%',
                                    value: promotion.discountValue,
                                    old_price: new Intl.NumberFormat('vi-VN').format(promotion.product_price)
                                };
                                price = new Intl.NumberFormat('vi-VN').format(promotion.product_price - promotion.finalDiscount);
                            }
                        }
                        
                        const totalReviews = item.reviews_count || 0;
                        let totalRate = 0;
                        
                        if (totalReviews > 0 && item.reviews && item.reviews.length > 0) {
                            const sum = item.reviews.reduce((acc, review) => acc + review.score, 0);
                            totalRate = parseFloat((sum / totalReviews).toFixed(1));
                        }
                        
                        // Build the product card HTML
                        let productHtml = `
                        <div class="col-lg-3">
                            <div class="card position-relative custom-card-hover">`;
                        
                        // Promotion ribbon
                        if (promotion) {
                            productHtml += `
                                <div class="position-absolute top-0 start-0" style="z-index: 1">
                                    <div class="discount-ribbon">
                                        <span class="discount-percent">-${discount.value}${discount.type}</span>
                                        <div class="ribbon-tail"></div>
                                    </div>
                                </div>`;
                        }
                        
                        // Product image
                        productHtml += `
                                <a href="${canonical}" class="text-decoration-none">
                                    <div class="ratio ratio-1x1">
                                        <img src="${image}" class="card-img-top p-3 object-fit-contain" alt="${name}">
                                    </div>
                                </a>
                                <div class="card-body p-3 d-flex flex-column">
                                    <a href="${canonical}" class="text-decoration-none text-dark">
                                        <h5 class="card-title fs-6 fw-semibold mb-2 product-title hover-red">${name}</h5>
                                    </a>
                                    <div class="d-flex align-items-center">`;
                        
                        // Reviews
                        if (totalReviews > 0) {
                            productHtml += `
                                        <div class="text-warning small">
                                            ${ProductCatalogue.generateStar(totalRate)}
                                        </div>
                                        <span class="text-muted ms-1 small">(${totalReviews} đánh giá)</span>`;
                        } else {
                            productHtml += `
                                        <span class="text-muted ms-1 small">
                                            <i class="fas fa-comment-slash me-1"></i> Chưa có đánh giá
                                        </span>`;
                        }
                        
                        // Price
                        productHtml += `
                                    </div>
                                    <div class="mt-2">
                                        <div class="d-flex align-items-baseline gap-2 mb-2">`;
                        if (promotion) {
                            productHtml += `
                                            <span class="text-danger fw-bold fs-5">${price}đ</span>
                                            <span class="text-muted text-decoration-line-through small">${discount.old_price}đ</span>`;
                        } else {
                            productHtml += `
                                            <span class="text-danger fw-bold fs-5">${price}đ</span>`;
                        }
                        
                        // Sales progress
                        productHtml += `
                                        </div>
                                        <div class="progress mb-2" style="height: 6px;">
                                            <div class="progress-bar bg-danger" role="progressbar" 
                                                style="width: ${percent}%;" 
                                                aria-valuenow="${percent}" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                        <p class="small text-muted text-center mb-2">Đã bán ${sold}/${total}</p>`;
                        
                        // Add to cart button
                        productHtml += `
                                        <button class="btn btn-danger w-100 py-2 show-product-btn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#productDetailModal">
                                            <i class="fas fa-cart-plus me-2"></i> Thêm vào giỏ
                                            <input type="hidden" name="product_id" value="${item.id}">
                                            <input type="hidden" name="language_id" value="${item.language_id || 1}">
                                        </button>`;
                        
                        // Close all tags
                        productHtml += `
                                    </div>
                                </div>
                            </div>
                        </div>`;
                        
                        productList.append(productHtml);
                    });
                    
                    // Setup post-render functions
                    Product.setupProductDetailAndShowModal();
                    HT.openChangeStatus();
                    
                    // Update pagination if available
                    if (response.data && (response.data.links || response.data.current_page)) {
                        HT.renderPagination(response);
                    }
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
            $('#price-slider')[0].noUiSlider.set([100000, 500000]);
        }
        
        $('.price-min').text('100.000đ');
        $('.price-max').text('500.000đ');
        $('.price-input-min').val('100000');
        $('.price-input-max').val('500000');
        
        ProductCatalogue.sendDataFilter(1);
    });
};

$(document).ready(function () {
    ProductCatalogue.initPriceSlider();
    ProductCatalogue.sendDataFilter();
    ProductCatalogue.attachFilterEvent();
    ProductCatalogue.attachPaginationEvent();
    ProductCatalogue.attachResetEvent();
    HT.attachFilterEvent(ProductCatalogue);
});