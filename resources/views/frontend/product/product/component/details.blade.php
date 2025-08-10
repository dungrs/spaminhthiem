<div class="row my-4">
    @if (!empty($album))
        <div class="col-xl-6 col-sm-12">
            <div class="row g-3">
                <!-- Main Image Swiper -->
                <div class="col-12">
                    <div class="swiper productImagesSwiper rounded-3 overflow-hidden" style="height: 100%; background: #f8f9fa;">
                        <div class="swiper-wrapper">
                            @foreach ($album as $key => $value)
                                <div class="swiper-slide">
                                    <img src="{{ $value }}" class="w-100 h-100 object-fit-contain" alt="Product Image">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
        
                <!-- Thumbnail Swiper -->
                <div class="col-12">
                    <div class="swiper productThumbsSwiper">
                        <div class="swiper-wrapper justify-content-center">
                            @foreach ($album as $key => $value)
                                <div class="swiper-slide" style="width: 80px;">
                                    <div class="ratio ratio-1x1 border rounded-2 overflow-hidden" style="cursor: pointer;">
                                        <img src="{{ $value }}" class="object-fit-cover">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="col-xl-6 col-sm-12 d-flex flex-column gap-3">
        <div class="d-flex flex-column gap-1">
            <h4 class="text-start fw-bold mb-1 product-main-title">{{ $name }}</h4>
            <input type="hidden" class="product-name" value="{{ $name }}">
            <div class="mb-1">
                <p class="text-muted mb-2" style="font-size: 0.9rem; line-height: 1.5;">
                    {{ $meta_description }}
                </p>
            </div>
            <div class="d-flex align-items-center flex-wrap gap-2">
                <div class="d-flex align-items-center">
                    {!! generateStar($totalRate) !!}
                    <span class="text-muted ms-2 mt-1" style="font-size: 0.9rem;">{{ $totalReviews }} đánh giá</span>
                </div>
                <div class="border-start ps-3 ms-2 text-muted mt-1" style="font-size: 0.9rem;">
                    Đã bán {{ $sold }}
                </div>
            </div>
        </div>

        @php
            $totalQty = 1
        @endphp

       <!-- Price + Stock + SKU -->
        <div class="d-flex align-items-center pb-3 border-bottom flex-wrap gap-2">
            <div class="me-auto">
                @if (!empty($product->promotions) && isset($discount[0]))
                    <span class="text-danger fw-bold price-sale" style="font-size: 1.3rem;">{{ $discount[0]['sale_price'] }}đ</span>
                    <span class="text-decoration-line-through text-muted ms-2 price-old" style="font-size: 0.9rem;">{{ $discount[0]['old_price'] }}đ</span>
                @else
                    <span class="text-danger fw-bold price-sale" style="font-size: 1.3rem;">{{ $price }}đ</span>
                @endif

                @if (!empty($product->promotions) && isset($discount[0]))
                    <span class="badge bg-warning text-danger ms-2 discount" style="font-size: 0.8rem;">
                        -{{ $discount[0]['value'] }} {{ $discount[0]['type'] }}
                    </span>
                @endif

                <!-- SKU -->
                @if (!empty($product->product_variants->first()))
                    <div class="mt-1 text-muted text-right" style="font-size: 0.85rem;">
                        Mã sản phẩm (SKU): 
                        <span class="fw-semibold text-dark sku">{{ $product->product_variants->first()->sku ?? '---' }}</span>
                    </div>
                @endif
            </div>

            <!-- Stock status - Sẽ được cập nhật bằng JS -->
            <div class="stock-status d-flex align-items-center">
                
            </div>
        </div>

        <form action="" id="form-store-cart">
            @csrf
            @include('frontend.product.product.component.variant')

            <div class="group-quantity my-4">
                <div class="d-flex flex-column gap-2">
                    <span class="fs-6 fw-bold d-block text-uppercase">Số Lượng</span>
                    <div class="d-flex">
                        <div class="custom-btn-quantity minus">-</div>
                        <input type="number" value="1" name="quantity" id="quantity" class="custom-input-quantity text-center" min="1" max="">
                        <div class="custom-btn-quantity add">+</div>
                    </div>
                    <small class="text-muted available-quantity">Còn <span class="fw-bold"></span> sản phẩm</small>
                </div>
            </div>

            <div class="group-btn d-flex gap-4 mt-3">
                <button class="btn border-primary text-primary btn-outline-primary rounded-1 w-100 py-2 buyNowButton"
                        data-check="{{ empty($customer) ? 'false' : 'true' }}"
                        >
                    <i class="fas fa-bolt me-2"></i> Mua Ngay
                </button>
                <button
                    data-check="{{ empty($customer) ? 'false' : 'true' }}"
                    type="submit" 
                    class="btn btn-primary rounded-1 w-100 py-2 submitCartButton"> 
                    <i class="fas fa-cart-plus me-2"></i>Thêm Vào Giỏ Hàng
                </button>
            </div>
        </form>
        
        <div class="btn btn-outline-dark w-100 py-2">
            <i class="fa-solid fa-location"></i>
            Tìm Cửa Hàng Có Sản Phẩm
        </div>

        <div class="group-delivery d-flex align-items-center justify-content-between gap-4 text-center pt-3 border-top border-dark-subtle">
            <div class="d-flex flex-column gap-2 align-items-center justify-content-center">
                <img src="{{ asset('frontend/img/icon/policy_product_image_1.webp') }}" width="30px" height="30px" class="img-fluid">
                <span class="fs-6">
                    Miễn phí vận chuyển với đơn hàng từ 500K
                </span>
            </div>
            <div class="d-flex flex-column gap-2 align-items-center justify-content-center">
                <img src="{{ asset('frontend/img/icon/policy_product_image_2.webp') }}" width="30px" height="30px" class="img-fluid">
                <span class="fs-6">
                    1 đổi 1 trong vòng 7 ngày
                </span>
            </div>
            <div class="d-flex flex-column gap-2 align-items-center justify-content-center">
                <img src="{{ asset('frontend/img/icon/policy_product_image_3.webp') }}" width="30px" height="30px" class="img-fluid">
                <span class="fs-6">
                    Kiểm tra hàng trước khi thanh toán
                </span>
            </div>
        </div>
    </div>
</div>