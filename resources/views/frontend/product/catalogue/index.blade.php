<main class="body pt-4">
    <div class="container">
        @include('frontend.component.breadcrumb', ['model' => $productCatalogue, 'breadcrumb' => $breadcrumb])
        <div class="row mt-4">
            @include("frontend.product.catalogue.component.filterContent")
            <div class="col-lg-9">
                @include("frontend.product.catalogue.component.filter")
                <div class="row product-list">
                   
                </div>
                <ul class="pagination pagination-rounded justify-content-center mb-2 mt-4">
                    
                </ul>
            </div>
        </div>
    </div>
</main>
@include("frontend.component.productDetailsModal")

<script>
    const baseUrl = "{{ url('/') }}";
</script>

<style>
    .noUi-target {
      background: #e0e0e0;
      border: none;
      box-shadow: none;
      height: 3px;
      border-radius: 2px;
    }
    
    .noUi-connect {
      background: #01964a;
    }
    
    .noUi-handle {
      background: #fff;
      border: 2px solid #01964a;
      box-shadow: 0 0 2px rgba(0,0,0,0.15);
      cursor: pointer;
    }
    
    .noUi-handle::before,
    .noUi-handle::after {
      display: none;
    }
    
    .price-input {
      border: 1px solid #ccc;
      border-radius: 4px;
      padding: 4px 8px;
      font-size: 12px;
      text-align: center;
      width: 48%;
    }
    
    .price-input:focus {
      border-color: #01964a;
      box-shadow: none;
    }
    
    .price-min,
    .price-max {
      font-size: 12px;
      font-weight: 500;
      color: #555;
    }
    
    .filter-title {
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 10px;
    }
    
    .noUi-horizontal .noUi-handle {
      width: 15px !important;
      height: 15px !important;
      right: -10px !important;
    }
</style>