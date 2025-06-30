@include('frontend.component.breadcrumb', ['model' => $productCatalogue, 'breadcrumb' => $breadcrumb])
<main class="body pt-4">
    <div class="container">
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

    @media (max-width: 1199.98px) {
        .filter-card-wrapper {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            max-width: 380px;
            background-color: #fff;
            z-index: 1055;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
            display: block !important;
        }

        .filter-card-wrapper.show {
            transform: translateX(0);
        }

        body.filter-open {
            overflow: hidden;
        }
    }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      const filterBtn = document.getElementById('mobile-filter-btn');
      const filterWrapper = document.querySelector('.filter-card-wrapper');
      const closeBtn = document.querySelector('.btn-close-filter');

      // Mở bộ lọc
      filterBtn?.addEventListener('click', function () {
          console.log(123);
          if (filterWrapper) {
              filterWrapper.classList.add('show');
              document.body.classList.add('filter-open');
          }
      });

      // Đóng bộ lọc
      closeBtn?.addEventListener('click', function () {
          if (filterWrapper) {
              filterWrapper.classList.remove('show');
              document.body.classList.remove('filter-open');
          }
      });
  });
</script>