<div class="row mt-3 row-gap-4">
    <div class="text-center my-4">
        <h3 class="fw-bold text-uppercase section-home-header">
            Các sản phẩm liên quan
        </h3>
    </div>
    @if (isset($productRelateds))
        <div class="row mt-1 row-gap-4">
            <div class="position-relative px-3">
                <div class="swiper products-swiper" data-row="1">
                    <div class="swiper-wrapper">
                        @foreach ($productRelateds as $object)
                            <div class="col-6 col-md-4 col-lg-3 col-xl-15 product-col">
                                @include('frontend.component.productItem', ['product' => $object, 'details' => true])
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="swiper-button-prev-custom">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="swiper-button-next-custom">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>