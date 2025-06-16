@php
    $name = $product->name;
    $image = asset(image($product->image));
    $price = number_format($product->product_variants->first()->price ?? 0);
    if (isset($product->promotion)) {
        $promotion = $product->promotion->toArray();
        $discount = getDiscountType($promotion);
    }

    $canonical = writeUrl($product->canonical, true, true);

    $total = rand(30, 100);
    $sold = rand(1, $total); 
    $percent = round(($sold / $total) * 100);

    $totalReviews = $product->reviews()->count();
    $totalRate = number_format($product->reviews()->avg('score'), 1);
    $starPercent = ($totalReviews == 0) ? '0' : $totalRate / 5 * 100;
@endphp
<div class="swiper-slide">
    <div class="card position-relative custom-card-hover h-100">
        @if (isset($product->promotion))
            <div class="position-absolute top-0 start-0" style="z-index: 1">
                <div class="discount-ribbon">
                    <span class="discount-percent">-{{ $discount['value'] }} {{ $discount['type'] }}</span>
                    <div class="ribbon-tail"></div>
                </div>
            </div>
        @endif

        <a href="{{ $canonical }}" class="text-decoration-none">
            <div class="ratio ratio-1x1">
                <img src="{{ $image }}" 
                        class="card-img-top p-3 object-fit-contain" 
                        alt="">
            </div>
        </a>

        <div class="card-body p-2 d-flex flex-column">
            <a href="{{ $canonical }}" class="text-decoration-none text-dark">
                <h5 class="card-title fs-6 fw-semibold mb-2 product-title hover-red">{{ $name }}
                </h5>
            </a>

            <div class="d-flex align-items-center mb-2">
                @if($totalReviews > 0)
                    <div class="text-warning small">
                        {!! generateStar($totalRate) !!}
                    </div>
                    <span class="text-muted ms-1 small">({{ $totalReviews }} đánh giá)</span>
                @else
                    <span class="text-muted ms-1 small">
                        <i class="fas fa-comment-slash me-1"></i> Chưa có đánh giá
                    </span>
                @endif
            </div>
            
            <div class="mt-2">
                <div class="d-flex align-items-baseline gap-2 mb-2">
                    @if(isset($product->promotion))
                        <span class="text-danger fw-bold fs-5">{{ $discount['sale_price'] }}đ</span>
                        <span class="text-muted text-decoration-line-through small">{{ $discount['old_price'] }}đ</span>
                    @else
                        <span class="text-danger fw-bold fs-5">{{ $price }}đ</span>
                    @endif
                </div>

                <div class="progress mb-2" style="height: 6px;">
                    <div class="progress-bar bg-danger" role="progressbar"
                        style="width: {{ $percent }}%;" 
                        aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
                <p class="small text-muted mb-2">Đã bán {{ $sold }}/{{ $total }}</p>
                
                @if (!isset($details))
                    <button class="btn btn-danger w-100 py-2 show-product-btn" 
                        data-bs-toggle="modal" 
                        data-bs-target="#productDetailModal">
                        <i class="fas fa-cart-plus me-2"></i> Thêm vào giỏ
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="language_id" value="{{ $languageId }}">
                    </button>
                @else
                    <a href="{{ $canonical }}" class="btn btn-danger w-100 py-2" aria-label="Xem chi tiết sản phẩm">
                        <span class="btn-content">
                            <i class="fas fa-eye me-2"></i> Xem chi tiết
                        </span>
                        <span class="btn-hover-effect"></span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>