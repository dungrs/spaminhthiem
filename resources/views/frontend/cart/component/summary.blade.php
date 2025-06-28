<div class="card-header bg-white border-0 pt-4 pb-0">
    <h5 class="mb-0 fw-bold">Tóm Tắt Đơn Hàng</h5>
</div>
<div class="card-body" id="cart-total-item">
    <div class="border-top pt-3 mb-3">
        <div class="d-flex justify-content-between mb-2">
            <span>Tạm Tính:</span>
            <span class="recalculate-cart-total">{{ convert_price($reCalculateCart['cartTotal']) }}</span>
        </div>
        <div class="d-flex justify-content-between mb-2">
            <span>Giảm Giá:</span>
            <span class="text-primary recalculate-cart-discount">-{{ convert_price($cartPromotion['discount']) }}</span>
        </div>
        <div class="d-flex justify-content-between mb-2">
            <span>Phí Vận Chuyển:</span>
            <span class="text-primary">Miễn phí</span>
        </div>
    </div>

    <div class="pt-3 mb-3 border-top">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Mã giảm giá">
            <button class="btn text-primary btn-warning" type="button">Áp dụng</button>
        </div>
    </div>
    
    <div class="border-top pt-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Tổng Cộng:</h5>
            <h4 class="mb-0 text-danger fw-bold recalculate-cart-final">
                {{ convert_price($reCalculateCart['cartTotal'] - $cartPromotion['discount']) }}
            </h4>
        </div>
        <small class="text-muted d-block mt-1">(Đã bao gồm VAT nếu có)</small>
    </div>
</div>