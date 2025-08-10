<main class="checkout-page">
    @include('frontend.cart.component.checkoutProgress')
    <form action="{{ route('cart.store') }}" method="post">
        @csrf
        <!-- Checkout Content -->
        <div class="container my-4">
            <div class="row g-4">
                <!-- Left Column - Shipping & Payment -->
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="mb-0 fw-bold">Thông Tin Thanh Toán</h5>
                        </div>
                        
                        <div class="card-body">
                            <form class="needs-validation" novalidate>
                                <input type="hidden" name="action_type" value="{{ $checkoutMode }}">
                                @include('frontend.cart.component.information')
                                @include('frontend.cart.component.shippingAddress')
                                @include('frontend.cart.component.method')
                            </form>
                        </div>
                    </div>
                    
                    @include('frontend.cart.component.orderItem')
                </div>
                
                <!-- Right Column - Order Summary -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-3">
                        @include('frontend.cart.component.summary')
                        <div class="card-footer bg-white border-0">
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                                <i class="fas fa-check-circle me-2"></i> Hoàn Thành Đơn Hàng
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>