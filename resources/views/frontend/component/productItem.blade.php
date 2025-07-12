@php
    $total = $product->product_variants->sum('quantity');
    $sold = $product->sold;
    $name = $product->name;
    $image = asset(image($product->image));
    $price = number_format($product->product_variants->first()->price ?? 0);
    if (isset($product->promotion)) {
        $promotion = $product->promotion->toArray();
        $discount = getDiscountType($promotion);
    }

    $canonical = writeUrl($product->canonical, true, true);
    $percent = round(($sold / $total) * 100);

    $totalReviews = $product->reviews()->count();
    $totalRate = number_format($product->reviews()->avg('score'), 1);
    $starPercent = ($totalReviews == 0) ? '0' : $totalRate / 5 * 100;
@endphp
<div class="item_product_main">
    <!-- Ảnh sản phẩm -->
    <div class="product-thumbnail pos-relative">
        <a class="image_thumb pos-relative embed-responsive embed-responsive-1by1"
            href="{{ $canonical }}"
            title="{{ $name }}">
            <img loading="lazy"
                    width="480"
                    height="480"
                    style="--image-scale: 1;"
                    src="{{ $image }}"
                    alt="{{ $name }}">
        </a>

        @if (isset($product->promotion))
            <div class="label_product">
                <div class="label_wrapper">
                    -{{ $discount['value'] }} {{ $discount['type'] }}
                </div>
            </div>
        @endif

        <div class="product-action">
            <div class="group_action" data-url="{{ $canonical }}">
                <button
                    data-bs-toggle="modal" 
                    data-bs-target="#productDetailModal"
                    class="btn-circle btn-views btn_view btn show-product-btn right-to">
                    <i class="fas fa-search"></i>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="language_id" value="{{ $languageId }}">
                </button>
            </div>
        </div>
    </div>

    <!-- Thông tin sản phẩm -->
    <div class="product-info">
        <span class="product-vendor">{{ $product->made_in }}</span>

        <h3 class="product-name">
            <a href="{{ $canonical }}" title="{{ $name }}">
                {{ $name }}
            </a>
        </h3>

        <div class="d-flex align-items-center mb-2">
            @if($totalReviews > 0)
                <div class="text-warning small">
                    {!! generateStar($totalRate) !!}
                </div>
                <span class="text-muted me-1 small">({{ $totalReviews }} đánh giá)</span>
            @else
                <span class="text-muted me-1 small">
                    <i class="fas fa-comment-slash me-1"></i> Chưa có đánh giá
                </span>
            @endif
        </div>

        <div class="product-item-cta position-relative">
            <div class="price-box">
                @if (isset($product->promotion))
                    <span class="price">{{ $discount['sale_price'] }}đ</span>
                    <span class="compare-price">{{ $discount['old_price'] }}đ</span>

                    <div class="label_product d-lg-none d-md-none d-xl-none d-inline-block">
                        <div class="label_wrapper">
                            -{{ $discount['value'] }} {{ $discount['type'] }}
                        </div>
                    </div>
                @else
                    <span class="price">{{ $price }}đ</span>
                @endif
            </div>
        </div>

        <!-- Progress Bar - Giao diện đã bán -->
        <div class="sales-progress mt-3">
            <div class="progress-wrapper">
                <div class="progress-info d-flex justify-content-between mb-1">
                    <span class="progress-label"><i class="fas fa-fire text-danger me-1"></i>Đã bán {{ $sold }}</span>
                    <span class="progress-value">{{ $percent }}%</span>
                </div>
                <div class="progress bg-light">
                    <div class="progress-bar progress-fill" 
                        role="progressbar" 
                        style="width: {{ $percent }}%" 
                        aria-valuenow="{{ $percent }}" 
                        aria-valuemin="0" 
                        aria-valuemax="100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Sales Progress - Green Theme */
    .sales-progress {
        margin-top: 14px;
        padding: 8px 0;
    }
    
    .progress-info {
        font-size: 12px;
    }
    
    .progress-text {
        color: #4a5568;
    }
    
    .progress-text strong {
        color: #2d3748;
        font-weight: 600;
    }
    
    .progress-percent {
        color: #38a169;
    }
    
    .progress-bar {
        height: 6px;
        background: #edf2f7;
        border-radius: 3px;
        overflow: hidden;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
    }
    
    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #48bb78, #2f855a);
        border-radius: 3px;
        transition: width 0.6s ease;
    }
</style>