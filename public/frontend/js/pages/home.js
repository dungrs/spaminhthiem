const Home = {
    debounceTimer: null,

    initSearchBoxToggle: function() {
        var $searchBox = $('.search-box');
        var $searchResult = $('.search-result');

        $searchResult.hide();

        $searchBox.on('focus', function() {
            $searchResult.stop(true, true).slideDown(200);
        });

        $(document).on('click', function(event) {
            if (!$(event.target).closest('.form-search, .search-result').length) {
                $searchResult.stop(true, true).slideUp(200);
            }
        });

        $searchBox.on('keyup', function() {
            clearTimeout(Home.debounceTimer);
            const keyword = $(this).val().trim();

            Home.debounceTimer = setTimeout(function() {
                Home.searchProduct(keyword);
            }, 300);
        });
    },

    searchProduct: function(keyword) {
        const productList = $('.search-result tbody');
        const resultCount = $('.result-count');
        
        if (keyword.trim() === '') {
            productList.html(`
                <tr>
                    <td colspan="4" class="text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-search fa-2x text-muted mb-3"></i>
                            <h5 class="fw-semibold mb-2">Không tìm thấy sản phẩm</h5>
                            <p class="text-muted">Vui lòng nhập từ khóa để tìm kiếm sản phẩm</p>
                        </div>
                    </td>
                </tr>`);
            
            resultCount.find('span').last().text('0');
    
            $('.search-result').slideDown(200);
            return;
        }

        $.ajax({
            url: '/ajax/product/filterUser',
            type: 'GET',
            data: { keyword: keyword },
            dataType: 'json',
            success: function (response) {
                const productList = $('.search-result tbody');
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
                        
                        let price = "0";
                        let oldPrice = null;
                        let discount = null;
                        
                        if (item.product_variants && item.product_variants.length > 0) {
                            price = new Intl.NumberFormat('vi-VN').format(item.product_variants[0].price || item.price || 0);
                        } else if (item.price) {
                            price = new Intl.NumberFormat('vi-VN').format(item.price);
                        }
                        
                        if (item.promotion) {
                            const promotion = item.promotion;
                            if (promotion.discountType === 'percent') {
                                discount = promotion.discountValue;
                                oldPrice = new Intl.NumberFormat('vi-VN').format(promotion.product_price);
                                price = new Intl.NumberFormat('vi-VN').format(promotion.product_price - promotion.finalDiscount);
                            }
                        }
                        
                        const totalReviews = item.reviews_count || 0;
                        let totalRate = 0;
                        
                        if (totalReviews > 0 && item.reviews && item.reviews.length > 0) {
                            const sum = item.reviews.reduce((acc, review) => acc + review.score, 0);
                            totalRate = parseFloat((sum / totalReviews).toFixed(1));
                        }
                        
                        // Build the product row HTML
                        let productHtml = `
                        <tr class="search-item">
                            <!-- Product Image -->
                            <td style="width: 80px;" class="ps-3">
                                <div class="position-relative">
                                    <img src="${image}" 
                                        class="img-fluid rounded-2 border" 
                                        width="64" 
                                        height="64" 
                                        alt="${name}" />`;
                        
                        // Discount badge
                        if (discount) {
                            productHtml += `
                                    <span class="badge bg-danger position-absolute top-0 start-0 translate-middle">-${discount}%</span>`;
                        }
                        
                        productHtml += `
                                </div>
                            </td>
        
                            <!-- Product Info -->
                            <td class="px-3">
                                <div class="d-flex flex-column">
                                    <a href="${canonical}" class="fw-semibold text-dark mb-1 text-decoration-none">
                                        ${name}
                                    </a>
                                    <div class="d-flex align-items-center mb-1">`;
                        
                        // Reviews
                        if (totalReviews > 0) {
                            productHtml += `
                                        <div class="text-warning small">
                                            ${Home.generateStar(totalRate)}
                                        </div>
                                        <span class="text-muted ms-1">(${totalReviews})</span>`;
                        } else {
                            productHtml += `
                                        <span class="text-muted small">
                                            <i class="fas fa-comment-slash me-1"></i> Chưa có đánh giá
                                        </span>`;
                        }
                        
                        productHtml += `
                                    </div>
                                    <div class="text-success small fw-bold">Còn hàng</div>
                                </div>
                            </td>
        
                            <!-- Price -->
                            <td class="px-2 text-end">
                                <div class="d-flex flex-column">`;
                        
                        if (oldPrice) {
                            productHtml += `
                                    <span class="fw-bold text-danger">${price}đ</span>
                                    <span class="text-muted text-decoration-line-through small">${oldPrice}đ</span>`;
                        } else {
                            productHtml += `
                                    <span class="fw-bold text-danger">${price}đ</span>`;
                        }
                        
                        productHtml += `
                                </div>
                            </td>
        
                            <!-- Actions -->
                            <td class="pe-3 text-end" style="width: 170px;">
                                <a href="${canonical}" class="btn btn-sm btn-outline-primary px-2 py-1">
                                    <i class="fas fa-eye me-1"></i> Chi tiết
                                </a>
                            </td>
                        </tr>`;
                        
                        productList.append(productHtml);
                    });
                } else {
                    productList.html(`
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="fas fa-search fa-2x text-muted mb-3"></i>
                                    <h5 class="fw-semibold mb-2">Không tìm thấy sản phẩm</h5>
                                    <p class="text-muted">Rất tiếc, không có sản phẩm phù hợp với từ khóa của bạn</p>
                                </div>
                            </td>
                        </tr>`);
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
    
};

$(document).ready(function () {
    Home.initSearchBoxToggle();
});
