const Product = {
    handleAttributeSelection: function (formData = null) {
        let selectedAttributes = {};
        let totalGroups = $('[data-group-index]').length;
        let ajaxRequest = null;
    
        $(document).off('click', '.choose-attribute');
    
        let updateHiddenInputs = () => {
            $('.attribute-wrapper').empty();
            Object.entries(selectedAttributes).forEach(([groupIndex, attributeId]) => {
                $('.attribute-wrapper').append(
                    `<input type="hidden" name="attribute_id[]" value="${attributeId}" data-group="${groupIndex}">`
                );
            });
        };
    
        let checkAndSubmit = function () {
            if (Object.keys(selectedAttributes).length === totalGroups) {
                let data = {};
                if (formData) {
                    data = {
                        'attribute_id': selectedAttributes,
                        'product_id': formData.product_id,
                        'language_id': formData.language_id,
                    };
                } else {
                    data = {
                        'attribute_id': selectedAttributes,
                        'product_id': $("input[name=product_id]").val(),
                        'language_id': $("input[name=language_id]").val()
                    };
                }

                if (ajaxRequest) {
                    ajaxRequest.abort();
                }

                ajaxRequest = $.ajax({
                    url: '/ajax/product/loadVariant',
                    type: 'GET',
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        if (response.data) {
                            Product.setupVariantName(response.data);
                            Product.setupVariantPrice(response.data);
                            Product.updateStockInfo(response.data);
                            Product.initQuantityHandler();
                        }
                        ajaxRequest = null;
                    },
                    error: function (xhr) {
                        if (xhr.statusText !== "abort") {
                            console.error("Lỗi AJAX:", xhr);
                        }
                        ajaxRequest = null;
                    },
                });
            }
        };
    
        let initializeSelectedAttributes = () => {
            selectedAttributes = {}; // đảm bảo reset khi gọi lại
            $('.choose-attribute.active').each(function () {
                let $this = $(this);
                let attributeId = $this.data('attributeid');
                let groupIndex = $this.closest('[data-group-index]').data('group-index');
                selectedAttributes[groupIndex] = attributeId;
            });
            updateHiddenInputs();
            checkAndSubmit();
        };
    
        $(document).on('click', '.choose-attribute', function (e) {
            e.preventDefault();
    
            let $this = $(this);
            let attributeId = $this.data('attributeid');
            let groupIndex = $this.closest('[data-group-index]').data('group-index');
    
            $this.closest('.d-flex').find('.choose-attribute').removeClass('active');
            $this.addClass('active');
    
            selectedAttributes[groupIndex] = attributeId;
            updateHiddenInputs();
            checkAndSubmit();
        });
    
        if (totalGroups > 0) {
            initializeSelectedAttributes();
        }
    },

    setupVariantName: function(object) {
        let productName = $('.product-name').val();
        if (productName === '') {
            productName = object.name;
        }
        let productVariantName = productName + ' - ' + object.name;
        $('.product-main-title').html(productVariantName);
    },

    setupVariantPrice: function(object) {
        let price = object.price;
        if (object.promotion && object.promotion.length > 0) {
            let promotion = object.promotion[0];
            let finalDiscount = promotion.finalDiscount;
            let priceDiscount = price - finalDiscount;

            let formattedPriceDiscount = priceDiscount.toLocaleString('vi-VN');
            let formattedPrice = price.toLocaleString('vi-VN');

            $('.price-sale').text(formattedPriceDiscount + ' đ');
            $('.price-old').text(formattedPrice + ' đ');
            
            let discountPercentage = Math.round((finalDiscount / price) * 100);
            $('.discount').text(`-${discountPercentage}%`).show();
        } else {
            let formattedPrice = price.toLocaleString('vi-VN');
            $('.price-sale').text(formattedPrice + ' đ');
            $('.price-old').text('');
            $('.discount').hide();
        }
    },

    updateStockInfo: function (variantData) {
        const quantity = parseInt(variantData.quantity) || 0;
        const stockStatus = $('.stock-status');
        const quantityInput = $('#quantity');
        const submitButton = $('.submitCartButton');
        const buyNowButton = $('.buyNowButton');
        const availableQuantity = $('.available-quantity span');
        const skuElement = $('.sku');

        // Cập nhật SKU
        skuElement.text(variantData.sku || '');

        // Cập nhật số lượng còn lại và giới hạn
        availableQuantity.text(quantity);
        quantityInput.attr('max', quantity);

        const isAvailable = quantity > 0;

        // Trạng thái còn hàng / hết hàng
        if (isAvailable) {
            stockStatus.html(`
                <i class="fas fa-check-circle me-2 text-primary"></i>
                <span class="text-primary" style="font-size: 0.9rem;">Còn hàng</span>
            `);
            quantityInput.prop('disabled', false);
            buyNowButton.prop('disabled', false);
            submitButton.prop('disabled', false).html(`
                <i class="fas fa-cart-plus me-2"></i>
                Thêm Vào Giỏ Hàng
            `);
        } else {
            stockStatus.html(`
                <i class="fas fa-times-circle me-2 text-danger"></i>
                <span class="text-danger" style="font-size: 0.9rem;">Hết hàng</span>
            `);
            quantityInput.prop('disabled', true);
            buyNowButton.prop('disabled', true);
            submitButton.prop('disabled', true).html(`
                <i class="fas fa-times-circle me-2"></i> Hết hàng
            `);
        }

        // Reset số lượng nếu vượt quá tồn kho
        const currentQty = parseInt(quantityInput.val());
        if (currentQty > quantity && isAvailable) {
            quantityInput.val(1).trigger('change');
        }

        // Cập nhật nút tăng/giảm
        Product.updateQuantityButtons();
    },

    initQuantityHandler: function () {
        $(document).off('click', '.custom-btn-quantity.minus');
        $(document).off('click', '.custom-btn-quantity.add');

        $(document).on('click', '.custom-btn-quantity.minus', () => {
            const quantityInput = $('#quantity');
            const current = parseInt(quantityInput.val()) || 1;

            if (current > 1) {
                quantityInput.val(current - 1).trigger('change');
            }
        });

        $(document).on('click', '.custom-btn-quantity.add', () => {
            const quantityInput = $('#quantity');
            const max = parseInt(quantityInput.attr('max')) || 0;
            const current = parseInt(quantityInput.val()) || 1;

            if (current < max) {
                quantityInput.val(current + 1).trigger('change');
            } else {
                if (max <= 0) {
                    alert('Sản phẩm đã hết hàng!');
                } else {
                    alert(`Bạn chỉ có thể mua tối đa ${max} sản phẩm`);
                }
            }
        });

        this.updateQuantityButtons();
    },

    updateQuantityButtons: function () {
        const quantityInput = $('#quantity');
        const max = parseInt(quantityInput.attr('max')) || 0;
        const current = parseInt(quantityInput.val()) || 1;

        const minusBtn = $('.custom-btn-quantity.minus');
        const addBtn = $('.custom-btn-quantity.add');
        
        addBtn.prop('disabled', current >= max || max <= 0)
            .css('opacity', current >= max || max <= 0 ? '0.5' : '1');

        minusBtn.prop('disabled', current < 1 || max <= 0)
                .css('opacity', current < 1 || max <= 0 ? '0.5' : '1');
    },

    setupProductDetailAndShowModal: function() {
        $('.show-product-btn').off('click');
    
        $(document).on('click', '.show-product-btn', function (e) {
            e.preventDefault();
    
            let product_id = $(this).find('input[name="product_id"]').val();
            let language_id = $(this).find('input[name="language_id"]').val();
    
            Product.resetModalContent();
    
            $.ajax({
                url: '/product-details',
                method: 'POST',
                data: {
                    product_id: product_id,
                    language_id: language_id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.data) {
                        let data = response.data;
                        console.log(data);
    
                        let formData = {
                            product_id: data.product.attributes.id,
                            language_id: data.product.attributes.language_id,
                        };
    
                        $('#productDetailModal input[name="product_id"]').val(data.product.attributes.id);
                        $('#productDetailModal input[name="language_id"]').val(data.product.attributes.language_id);
                        $('.attribute-wrapper').empty();
                        $('#productDetailModal .choose-attribute').removeClass('active');
    
                        Product.renderProductModalImage(data.product.attributes.album);
                        Product.renderProductNameModal(data.product);
                        Product.renderSoldProductModal(data.product);
                        Product.renderTotalReview(data.product);
                        Product.renderProductDescriptionModal(data.seo);
                        Product.renderAttributeGroups(data.product.attributes.attributeCatalogue);
    
                        setTimeout(() => {
                            Product.handleAttributeSelection(formData);
                        }, 0);
    
                        $('#quantity').val(1);
                    }
                },
                error: function (xhr) {
                    console.error("Không thể tải chi tiết sản phẩm:", xhr);
                }
            });
        });
    },
    
    resetModalContent: function() {
        $('.productImagesSwiper .swiper-wrapper').empty();
        $('.productThumbsSwiper .swiper-wrapper').empty();
        
        $('.product-main-title').html('');
        $('.product-name').val('');
        $('.product-main-description').html('');
        
        $('.attribute-container').empty();
        
        $('.price-sale').text('');
        $('.price-old').text('');
        $('.discount').hide();
        
        $('#quantity').val(1);
    },

    renderProductModalImage: function(imageData) {
        var imageUrls = typeof imageData === 'string' ? JSON.parse(imageData) : imageData;

        var mainImagesHtml = '';
        var thumbsHtml = '';

        $.each(imageUrls, function(index, url) {
            mainImagesHtml += `
                <div class="swiper-slide">
                    <img src="${url}" class="w-100 h-100 object-fit-contain" alt="Product Image">
                </div>
            `;

            thumbsHtml += `
                <div class="swiper-slide" style="width: 80px;">
                    <div class="ratio ratio-1x1 border rounded-2 overflow-hidden" style="cursor: pointer;">
                        <img src="${url}" class="object-fit-cover">
                    </div>
                </div>
            `;
        });

        $('.productImagesSwiper .swiper-wrapper').html(mainImagesHtml);
        $('.productThumbsSwiper .swiper-wrapper').html(thumbsHtml);

        if (typeof BannerSlide !== 'undefined' && typeof BannerSlide.swiperProductModal === 'function') {
            BannerSlide.swiperProductModal();
        }
    },

    renderProductNameModal: function(data) {
        const $productNameInput = $('.product-name');
        const nameFromData = data.name || '';
    
        $('.product-main-title').html(nameFromData);
    
        if ($productNameInput.val() === '') {
            $productNameInput.val(nameFromData);
        }
    },

    renderProductDescriptionModal: function(data) {
        $('.product-main-description').html(data.meta_description);
    },

    renderSoldProductModal: function(data) {
        $('.product-sold').text(`Đã bán ${data.sold}`);
    },

    renderTotalReview: function(data) {
        const totalReviews = data.reviews.length || 0;
        let totalRate = 0;
        let reviewHtml = ``;
        if (totalReviews > 0 && data.reviews && data.reviews.length > 0) {
            const sum = data.reviews.reduce((acc, review) => acc + review.score, 0);
            totalRate = parseFloat((sum / totalReviews).toFixed(1));
        }
        if (totalReviews > 0) {
            reviewHtml += `
                    <div class="d-flex align-items-center">
                        <div class="text-warning">
                            ${Library.generateStar(totalRate)}
                        </div>
                        <span class="text-muted ms-1 small">(${totalReviews} đánh giá)</span>
                    </div>`;
        } else {
            reviewHtml += `
                        <span class="text-muted mb-1">
                            <i class="fas fa-comment-slash me-2"></i> Chưa có đánh giá
                        </span>
                    `;
        }
        $('.product-review').html(reviewHtml);
    },

    renderAttributeGroups: function(attributeCatalogue) {
        const $wrapper = $('.attribute-container');
        $wrapper.empty();
    
        if (!attributeCatalogue || !Array.isArray(attributeCatalogue) || attributeCatalogue.length === 0) {
            return;
        }
    
        attributeCatalogue.forEach((group, groupIndex) => {
            const groupDiv = $(`
                <div class="${groupIndex === 0 ? 'mt-2' : 'mt-4'}" data-group-index="${groupIndex}">
                    <h6 class="fw-bold mb-3 text-uppercase mb-2">${group.name}</h6>
                    <div class="d-flex flex-wrap gap-2"></div>
                </div>
            `);
    
            const $buttonContainer = groupDiv.find('.d-flex');
    
            if (Array.isArray(group.attributes) && group.attributes.length) {
                group.attributes.forEach((attr, attrIndex) => {
                    const attrBtn = $(`
                        <a class="btn btn-outline-primary rounded-pill px-3 py-1 choose-attribute border-primary ${attrIndex === 0 ? 'active' : ''}"
                           data-attributeid="${attr.id}"
                           title="${attr.name}"
                           style="font-size: 0.85rem; border-width: 1.5px;">
                            ${attr.name}
                        </a>
                    `);
                    $buttonContainer.append(attrBtn);
                });
            }
    
            $wrapper.append(groupDiv);
        });
        
        if ($('.attribute-wrapper').length === 0) {
            $wrapper.append('<div class="attribute-wrapper"></div>');
        }
    },

    bindStoreCartHandler: function () {
        $(document).off('click', '.submitCartButton, #productDetailModal .btn-danger, .buyNowButton');
    
        $(document).on('click', '.submitCartButton', function (e) {
            e.preventDefault();
    
            const isCustomerAvailable = $(this).data('check') === true || $(this).data('check') === 'true';
            if (!isCustomerAvailable) {
                Product.notifyCustomerRequired();
                return false;
            }
    
            let formElement = document.getElementById('form-store-cart');
            if (formElement) {
                let formData = new FormData(formElement);
                Product.storeCart(formData, '.submitCartButton');
            }
        });
    
        $(document).on('click', '.buyNowButton', function (e) {
            e.preventDefault();
    
            const isCustomerAvailable = $(this).data('check') === true || $(this).data('check') === 'true';
            if (!isCustomerAvailable) {
                Product.notifyCustomerRequired();
                return false;
            }
    
            let formElement = document.getElementById('form-store-cart');
            if (formElement) {
                let formData = new FormData(formElement);
                Product.storeCart(formData, '.buyNowButton', function () {
                    window.location.href = `thanh-toan.html?action_type=buy_now`;
                });
            }
        });
    
        $(document).on('click', '#productDetailModal .submitCartModal', function (e) {
            e.preventDefault();
    
            const isCustomerAvailable = $(this).data('check') === true || $(this).data('check') === 'true';
            if (!isCustomerAvailable) {
                Product.notifyCustomerRequired();
                return false;
            }
    
            const formData = new FormData();
            formData.append('product_id', $('#productDetailModal input[name="product_id"]').val());
            formData.append('language_id', $('#productDetailModal input[name="language_id"]').val());
            formData.append('quantity', $('#quantity').val());
    
            $('.attribute-wrapper input[name="attribute_id[]"]').each(function () {
                formData.append('attribute_id[]', $(this).val());
            });
    
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    
            Product.storeCart(formData);
        });
    },
    
    storeCart: function(formData, button, callback) {
        let $button = $(button);
        let originalText;
        let action_type;

        if ($button.hasClass('buyNowButton')) {
            originalText = `<i class="fas fa-bolt me-2"></i> Mua Ngay`;
            action_type = 'buy_now';
        } else {
            originalText = `<i class="fas fa-cart-plus me-2"></i>Thêm Vào Giỏ Hàng`;
            action_type = 'add_to_cart';
        }

        if (formData instanceof FormData) {
            formData.append('action_type', action_type);
        }

        $button.html('<i class="fas fa-spinner fa-spin me-2"></i> ĐANG XỬ LÝ...');
        $button.prop('disabled', true);
        
        $.ajax({
            url: '/ajax/cart/create',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                $button.html(originalText);
                $button.prop('disabled', false);
                
                if (response.status === 'success') {
                    alertify.success(response.message);
                    $('#productDetailModal').modal('hide');
                    if (typeof callback === 'function') {
                        callback();
                    }
                }
            },
            error: function(xhr) {
                $button.html(originalText);
                $button.prop('disabled', false);
                
                alertify.error('Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng. Vui lòng thử lại.');
            },
        });
    },
    
    notifyCustomerRequired: function() {
        Swal.fire({
            icon: 'warning',
            title: 'Thông báo',
            text: 'Bạn cần đăng nhập hoặc cung cấp thông tin khách hàng trước khi thực hiện thao tác này!',
            confirmButtonText: 'OK',
        });
    }
};

$(document).ready(function () {
    Product.handleAttributeSelection();
    Product.bindStoreCartHandler();
    Product.setupProductDetailAndShowModal();
    
    $('#productDetailModal').on('hidden.bs.modal', function () {
        Product.resetModalContent();
    });
});