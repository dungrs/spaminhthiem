const Product = {
    initQuantityHandler: function() {
        $(document).on('click', '.custom-btn-quantity.minus', function() {
            let $input = $(this).siblings('#quantity');
            let currentVal = parseInt($input.val());
            if (currentVal > 1) {
                $input.val(currentVal - 1);
            }
        });
    
        $(document).on('click', '.custom-btn-quantity.add', function() {
            let $input = $(this).siblings('#quantity');
            let currentVal = parseInt($input.val());
            $input.val(currentVal + 1);
        });
    },

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
                        <a class="btn btn-outline-primary rounded-pill px-3 py-1 choose-attribute ${attrIndex === 0 ? 'active border-primary' : 'border-dark'}"
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
                Product.storeCart(formData);
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
    
                Product.storeCart(formData, function () {
                    window.location.href = 'gio-hang.html';
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
    
    storeCart: function(formData, callback) {
        const $button = $('.submitCartButton');
        const originalText = `
            <img src="frontend/img/icon/icon-cart-plus.svg" >
                    Thêm Vào Giỏ Hàng
        `;
        $button.html('<i class="fas fa-spinner fa-spin me-2"></i> ĐANG XỬ LÝ...');
        $button.prop('disabled', true);
        
        $.ajax({
            url: '/ajax/cart/create',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
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
            error: function (xhr) {
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
    Product.initQuantityHandler();
    Product.handleAttributeSelection();
    Product.bindStoreCartHandler();
    Product.setupProductDetailAndShowModal();
    
    $('#productDetailModal').on('hidden.bs.modal', function () {
        Product.resetModalContent();
    });
});