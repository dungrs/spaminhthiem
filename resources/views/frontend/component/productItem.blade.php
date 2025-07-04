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
        <span class="product-vendor">Usolab</span>

        <h3 class="product-name">
            <a href="{{ $canonical }}" title="{{ $name }}">
                {{ $name }}
            </a>
        </h3>

        <div class="sapo-product-reviews-badge" data-id="36047637"></div>

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

            <button class="product-item-btn btn active" title="Thêm vào giỏ hàng">
                <svg class="icon">
                    <use xlink:href="#icon-plus"/>
                </svg>
            </button>
        </div>
    </div>

</div>