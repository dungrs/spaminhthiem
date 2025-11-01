const Cart = {
    initQuantityHandler: function () {
        $(document).on('click', '.custom-btn-quantity.minus', function () {
            let _this = $(this);
            let $input = _this.siblings('#quantity');
            let currentVal = parseInt($input.val());
            if (currentVal > 1) {
                currentVal = currentVal - 1;
                $input.val(currentVal);

                let option = {
                    qty: currentVal,
                    rowId: _this.siblings('.rowId').val(),
                    id: _this.siblings('.id').val(),
                    _token: $('meta[name="csrf-token"]').attr('content'),
                };

                Cart.handleUpdateCart($input, option);
            }
        });

        $(document).on('click', '.custom-btn-quantity.add', function () {
            let _this = $(this);
            let $input = _this.siblings('#quantity');
            let currentVal = parseInt($input.val());
            currentVal = currentVal + 1;
            $input.val(currentVal);

            let option = {
                qty: currentVal,
                rowId: _this.siblings('.rowId').val(),
                id: _this.siblings('.id').val(),
                _token: $('meta[name="csrf-token"]').attr('content'),
            };

            Cart.handleUpdateCart($input, option);
        });
    },

    deleteCartItem: function() {
        $(document).on('click', '.delete-cart-item', function(){
            let _this = $(this)
            let option = {
               rowId: _this.data('row-id'),
               _token: $('meta[name="csrf-token"]').attr('content'),
            }

            $.ajax({
                url: '/ajax/cart/delete',
                type: 'POST',
                data: option,
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        _this.closest('.cart-item').remove();
                        Cart.updateCartTotalUI(response.data.cartRecaculate);
                        Cart.updateCartCountUI();
                        alertify.success(response.message);
                    } else {
                        alertify.error(response.message || 'Cập nhật thất bại');
                    }
                },
                error: function () {
                    alertify.error('Có lỗi xảy ra khi cập nhật giỏ hàng. Vui lòng thử lại.');
                },
            });
        })
    },

    deleteAllCartItem: function() {
        $(document).on('click', '#delete-all-cart-btn', function () {
            Swal.fire({
                title: 'Bạn có chắc không?',
                text: "Tất cả sản phẩm trong giỏ hàng sẽ bị xoá!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Vâng, xoá hết!',
                cancelButtonText: 'Huỷ',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/ajax/cart/deleteAll',
                        type: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                $('.cart-item').remove();
                                Cart.updateCartCountUI();
                                Cart.updateCartTotalUI(response.data.cartRecaculate);
                                Swal.fire('Đã xoá!', response.message, 'success');
                            } else {
                                Swal.fire('Lỗi!', response.message || 'Xoá giỏ hàng thất bại.', 'error');
                            }
                        },
                        error: function () {
                            Swal.fire('Lỗi!', 'Đã xảy ra lỗi khi xoá giỏ hàng.', 'error');
                        }
                    });
                }
            });
        });
    },

    handleUpdateCart: function ($input, option) {
        $.ajax({
            url: '/ajax/cart/update',
            type: 'POST',
            data: option,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    Cart.updateCartItemPriceUI($input, response.data.cart);
                    Cart.updateCartTotalUI(response.data.cartRecaculate);
                    Cart.updateCartCountUI();
                } else {
                    if (response.max_qty) {
                        alertify.error('Số lượng vượt quá giỏ hàng. Số lượng tối đa có thể đặt là ' + response.max_qty);
                        $input.val(response.max_qty);
                    } else {
                        alertify.error(response.message || 'Cập nhật thất bại');
                    }
                }
            },
            error: function () {
                alertify.error('Có lỗi xảy ra khi cập nhật giỏ hàng. Vui lòng thử lại.');
            },
        });
    },

    updateCartItemPriceUI: function ($input, cartItem) {
        const $cartItem = $input.closest('.cart-item');
        const newPrice = cartItem.price * cartItem.qty;
        const newPriceOriginal = cartItem.priceOriginal * cartItem.qty;
    
        if (cartItem.price !== cartItem.priceOriginal) {
            $cartItem.find('.price-old').text(Cart.formatCurrency(newPriceOriginal));
            $cartItem.find('.price-sale').text(Cart.formatCurrency(newPrice));
        } else {
            $cartItem.find('.price-sale').text(Cart.formatCurrency(newPrice));
            $cartItem.find('.price-old').text('');
        }
    },
    
    updateCartTotalUI: function (recaculate) {
        $('.recalculate-cart-total').text(
            Cart.formatCurrency(recaculate.cartTotal + recaculate.cartDiscount)
        );
        $('.recalculate-cart-discount').text(
            '-' + Cart.formatCurrency(recaculate.cartDiscount)
        );
        $('.recalculate-cart-final').text(
            Cart.formatCurrency(recaculate.cartTotal)
        );
    },

    updateCartCountUI: function () {
        const count = $('.cart-item').length;
        $('.cart-count').text(`Sản Phẩm (${count})`);

        if (count > 0) {
            $('.delete-all-cart').removeClass('d-none');
            $('.btn-checkout').removeClass('d-none');
        } else {
            $('.delete-all-cart').addClass('d-none');
            $('.btn-checkout').addClass('d-none');

            // Hiển thị giao diện giỏ hàng trống
            if (!$('.empty-cart').length) {
                $('.card-body').html(`
                    <div class="p-5 text-center text-muted empty-cart">
                        <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                        <h6 class="fw-bold">Giỏ hàng của bạn đang trống</h6>
                        <p class="small">Hãy thêm sản phẩm vào giỏ để tiếp tục mua sắm.</p>
                        <a href="/" class="btn btn-primary mt-3">
                            <i class="fas fa-arrow-left me-2"></i> Tiếp tục mua sắm
                        </a>
                    </div>
                `);
            }
        }
    },

    formatCurrency: function (number) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
        }).format(number);
    }
};

$(document).ready(function () {
    Cart.initQuantityHandler();
    Cart.deleteCartItem();
    Cart.deleteAllCartItem();
});