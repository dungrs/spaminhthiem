{{-- Start Begin Content --}}
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="" id="form-store-modal" data-language-id="{{ isset($product) ? $product->language_id : '' }}" data-id="{{ isset($product) ? $product->id : '' }}">
                <div class="row">
                    <div class="col-lg-9">
                        <div id="addpost-accordion" class="custom-accordion">
                            @include("backend.component.content", ['model' => $product ?? null, 'index' => "01"])
                            @include("backend.component.album", ['index' => "02"])
                            @include("backend.product.product.component.variant")
                            @include("backend.component.seo", ['model' => $product ?? null, 'index' => "05"])
                        </div>
                    </div>
                    <div class="col-lg-3">
                        @include("backend.product.product.component.aside", ['model' => $product ?? null])
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
@php
    $variantReponse = isset($product) ? $product->product_variants->all() : [];
@endphp
<script>
    @php
        $attribute = isset($product->attribute) ? json_decode($product->attribute, true) : [];
    @endphp

    var ProductMessages = {
        messages: {!! json_encode(__('messages.product')) !!}
    }

    var attributes = "{{ base64_encode(json_encode($attribute)) }}";
    var variants = "{{ base64_encode(json_encode($variantReponse)) }}";
    var attributeCatalogues = @json($attributeCatalogues->map(function($item) {
        return [
            'id' => $item->id,
            'name' => $item->name
        ];
    }));
</script>