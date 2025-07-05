@php
    $total = $product->product_variants->sum('quantity');
    $sold = $product->orders
        ->where('confirm', 'confirm')
        ->sum(function ($order) {
            return $order->pivot->qty;
        });

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

<div class="swiper-slide product-item">
    <div class="card dash-product-box shadow-none border mb-0 h-100">
        <div class="card-body d-flex flex-column">
            @if (isset($product->promotion))
                <div class="pricing-badge position-absolute">
                    <span class="badge bg-success">
                        @lang('messages.dashboard.sale_best_product.productItem.discount_badge', [
                            'value' => $discount['value'],
                            'type' => $discount['type']
                        ])
                    </span>
                </div>
            @endif

            <div class="dash-product-img mb-3 text-center">
                <img src="{{ $image }}" class="img-fluid" alt="" style="object-fit: contain; height: 160px;">
            </div>

            <h5 class="font-size-14 fw-semibold text-center" style="min-height: 40px;">
                <a href="{{ $canonical }}" class="text-dark lh-base text-decoration-none d-block text-truncate" title="{{ $name }}">{{ $name }}</a>
            </h5>

            <div class="d-flex align-items-baseline justify-content-center gap-2 mb-2">
                @if(isset($product->promotion))
                    <h5 class="font-size-16 text-primary mb-0">
                        <del class="font-size-14 text-muted fw-normal me-1">{{ $discount['sale_price'] }}đ</del> 
                        {{ $discount['old_price'] }}đ
                    </h5>
                @else
                    <h5 class="font-size-16 text-primary mb-0">{{ $price }}đ</h5>
                @endif
            </div>

            <div class="d-flex align-items-center justify-content-center my-2 small">
                @if($totalReviews > 0)
                    <div class="text-warning">
                        {!! generateStar($totalRate) !!}
                    </div>
                    <span class="text-muted ms-1">
                        @lang('messages.dashboard.sale_best_product.productItem.reviews_count', ['count' => $totalReviews])
                    </span>
                @else
                    <span class="text-muted">
                        <i class="fas fa-comment-slash me-1"></i> 
                        @lang('messages.dashboard.sale_best_product.productItem.no_reviews')
                    </span>
                @endif
            </div>

            <div class="mt-auto">
                <a href="{{ $canonical }}" class="btn btn-primary btn-sm w-100">
                    <i class="mdi mdi-cart me-1 align-middle"></i> 
                    @lang('messages.dashboard.sale_best_product.productItem.view_details')
                </a>
            </div>
        </div>
    </div>
</div>