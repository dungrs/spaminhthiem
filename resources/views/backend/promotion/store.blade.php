{{-- Start Begin Content --}}
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="" id="form-store-modal" data-id="{{ isset($promotion) ? $promotion->id : '' }}">
                <div class="row">
                    <div class="col-lg-8">
                        @include("backend.promotion.component.general", ['model' => $promotion ?? null])
                        @include("backend.promotion.component.details", ['model' => $promotion ?? null])
                    </div>
                    <div class="col-lg-4">
                        @include("backend.promotion.component.aside", ['model' => $promotion ?? null])
                    </div>
                </div>
                <!-- end row -->
    
                <div class="row mb-4">
                    <div class="col text-end">
                        <button type="submit" class="btn btn-success submitButton">
                            <i class="bx bx-file me-1"></i> {{ __('messages.save') }}
                        </button>
                    </div> <!-- end col -->
                </div> <!-- end row-->
                <!-- end row -->
            </form>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @include('backend.component.footer')
</div>
{{-- End Begin Content --}}
@include('backend.promotion.component.productModal')
<script>
    var PromotionAsidesMessages = {
        messages: {!! json_encode(__('messages.promotion.aside')) !!}
    };

    var PromotionDetailsMessages = {
        messages: {!! json_encode(__('messages.promotion.details')) !!}
    };
</script>
<input type="hidden" class="preload_select_module_type" value="{{ old('module_type', $promotion->discount_information['info']['model'] ?? '') }}">
<input type="hidden" class="input_order_amount_range" value='@json(old('promotion_order_amount_range', $promotion->discount_information['info'] ?? []))'>
<input type="hidden" class="input_product_and_quantity" value='@json(old('product_and_quantity', $inputProductAndQuantity ?? []))'>\
<input type="hidden" class="input_object" value='@json(old('object', $promotion->discount_information['info']['object'] ?? []))'>
<div id="productData" data-products='@json(__('module.item'))'></div>