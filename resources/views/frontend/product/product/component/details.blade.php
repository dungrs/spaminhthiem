<div class="row mt-4">
    @if (!empty($album))
        <div class="col-xl-6 col-sm-12">
            <div class="product-gallery-container d-flex">
                <div class="swiper thumbSwiperProductDetails" style="width: 100px; height: 400px">
                    <div class="swiper-wrapper">
                        @foreach ($album as $key => $value)
                            <div class="swiper-slide custom-thumb-swiper-slide-product-details">
                                <img src="{{ $value }}" class="img-fluid cursor-pointer" style="object-fit: contain; height: 80%;" />
                            </div>
                        @endforeach
                    </div>
                </div>
            
                <div class="swiper mainSwiperProductDetails" style="width: calc(100% - 116px); height: 500px;">
                    <div class="swiper-wrapper">
                        @foreach ($album as $key => $value)
                            <div class="swiper-slide">
                                <img src="{{ $value }}" class="img-fluid" style="object-fit:cover; width: 100%; height: 100%;" />
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
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
                    <span class="text-muted ms-2" style="font-size: 0.9rem;">{{ $totalReviews }} đánh giá</span>
                </div>
                <div class="border-start ps-3 ms-2 text-muted" style="font-size: 0.9rem;">
                    Đã bán 320
                </div>
            </div>
        </div>

        <!-- Price -->
        <div class="d-flex align-items-center pb-3 border-bottom">
            <div class="me-auto">
                @if (!empty($product->promotions) && isset($discount[0]))
                    <span class="text-danger fw-bold price-sale" style="font-size: 1.3rem;">{{ $discount[0]['sale_price'] }}đ</span>
                    <span class="text-decoration-line-through text-muted ms-2 price-old" style="font-size: 0.9rem;">{{ $discount[0]['old_price'] }}đ</span>
                @else
                    <span class="text-danger fw-bold price-sale" style="font-size: 1.3rem;">{{ $price }}đ</span>
                @endif
                
                @if (!empty($product->promotions) && isset($discount[0]))
                    <span class="badge bg-warning text-danger ms-2 discount" style="font-size: 0.8rem;">-{{ $discount[0]['value'] }} {{ $discount[0]['type'] }}</span>
                @endif
            </div>
            <div class="d-flex align-items-center text-success">
                <i class="fas fa-check-circle me-2"></i>
                <span style="font-size: 0.9rem;">Còn hàng</span>
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
                        <input type="number" value="1" name="quantity" id="quantity" class="custom-input-quantity text-center">
                        <div class="custom-btn-quantity add">+</div>
                    </div>
                </div>
            </div>

            <div class="group-btn d-flex gap-4 mt-3">
                <div class="btn border-primary text-primary btn-outline-primary rounded-1 w-100 py-2">
                    <i class="fa-solid fa-heart"></i>
                    Yêu Thích
                </div>
            
                <button data-check="{{ empty($customer) ? 'false' : 'true' }}" type="submit" class="btn btn-primary rounded-1 w-100 py-2 submitCartButton">
                    <img src="{{ asset('frontend/img/icon/icon-cart-plus.svg') }}" />
                    Thêm Vào Giỏ Hàng
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