<main class="body">
    <!-- Progress Steps -->
    <div class="checkout-progress py-4 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="step active">
                            <div class="step-icon bg-danger text-white">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <div class="step-label mt-2">Giỏ Hàng</div>
                        </div>
                        
                        <div class="step-connector active"></div>
                        
                        <div class="step">
                            <div class="step-icon ">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                            <div class="step-label mt-2">Đặt Hàng</div>
                        </div>
                        
                        <div class="step-connector"></div>
                        
                        <div class="step">
                            <div class="step-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="step-label mt-2">Hoàn Thành</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Content -->
    <div class="cart-main container mt-3 mb-5">
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8 mb-4">
                <div class="card shadow-lg rounded-3">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0 fw-bold cart-count">Sản Phẩm ({{ $carts->count() }})</h5>
                    </div>
                    <div class="card-body p-0">
                        @if (count($carts) && !is_null($carts))
                            @foreach ($carts as $cart)
                                <div class="cart-item p-3 border-bottom d-flex">
                                    <div class="item-image me-3">
                                        <img src="{{ $cart->image ?? '' }}" 
                                            class="rounded-2 object-fit-contain" width="80px" height="100px">
                                    </div>
                                    <div class="item-details flex-grow-1 ">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-1 fw-bold">{{ $cart->name }}</h6>
                                            <button class="btn btn-sm btn-link text-danger p-0 delete-cart-item" data-row-id="{{ $cart->rowId }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                        <p class="text-muted small mb-2">
                                            @foreach ($cart->options['attributes'] as $attribute)
                                                <span class="d-block">{{ $attribute['attribute_catalogue_name'] }}: {{ $attribute['attribute_name'] }}</span>
                                            @endforeach
                                        </p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex cart-item-qty">
                                                <div class="custom-btn-quantity minus cart">-</div>
                                                <input type="number" value="{{ $cart->qty }}" name="quantity" id="quantity" 
                                                       class="custom-input-quantity cart text-center" min="1">
                                                <input type="hidden" class="rowId" value="{{ $cart->rowId }}">
                                                <div class="custom-btn-quantity add cart">+</div>
                                            </div>
                                            <div class="text-end">
                                                @if($cart->price != $cart->priceOriginal)
                                                    <div class="text-decoration-line-through text-muted small price-old">
                                                        {{ convert_price($cart->priceOriginal * $cart->qty) }}
                                                    </div>
                                                    <div class="fw-bold text-danger price-sale">
                                                        {{ convert_price($cart->price * $cart->qty) }}
                                                    </div>
                                                @else
                                                    <div class="fw-bold text-danger price-sale">
                                                        {{ convert_price($cart->price * $cart->qty) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="card-footer delete-all-cart bg-white border-0 {{ count($carts) && !is_null($carts) ? '' : 'd-none' }}" id="delete-all-cart-btn">
                        <button class="btn btn-outline-danger w-100">
                            <i class="fas fa-trash-alt me-2"></i> Xoá Hết Giỏ Hàng
                        </button>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card shadow-lg rounded-3">
                    @include('frontend.cart.component.summary')
                    <div class="card-footer bg-white border-0">
                        <a href="{{ route('checkout') }}" class="btn btn-danger w-100 py-2">
                            <i class="fas fa-credit-card me-2"></i> Thanh Toán
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>