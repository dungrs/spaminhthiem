<main class="checkout-page">
    @include('frontend.cart.component.checkoutProgress')
    <form action="{{ route('cart.store') }}" method="post">
        @csrf
        <!-- Checkout Content -->
        <div class="container my-4">
            <div class="row g-4">
                <!-- Left Column - Shipping & Payment -->
                <div class="col-lg-8">
                    <div class="card shadow-sm rounded-3">
                        <div class="card-header bg-white border-0 pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 fw-bold">Thông Tin Thanh Toán</h4>
                                <a href="#login" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-user-circle me-1"></i> Đăng Nhập
                                </a>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <form class="needs-validation" novalidate>
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
                    <div class="card shadow-sm rounded-3">
                        @include('frontend.cart.component.summary')
                        <div class="card-footer bg-white border-0">
                            <button type="submit" class="btn btn-danger w-100 py-2 fw-bold">
                                <i class="fas fa-check-circle me-2"></i> Hoàn Thành Đơn Hàng
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>