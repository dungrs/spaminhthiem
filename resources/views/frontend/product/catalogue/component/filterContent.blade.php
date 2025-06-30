<div class="col-lg-3 pe-lg-4 filter-card-wrapper d-none d-xl-block">
    <div class="filter-card mb-4 filter-data">
        <input type="hidden" name="product_catalogue_id" value="{{ $productCatalogue->id }}">
        <input type="hidden" name="language_id" value="{{ $languageId }}">

        <!-- Header bộ lọc -->
        <div class="filter-header d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 fw-bold">BỘ LỌC SẢN PHẨM</h5>

            <div class="d-flex justify-content-end mb-3 d-xl-none sticky-top">
                <button type="button" class="btn btn-close-filter pe-0" style="padding-top: 20px !important;">
                    <i class="fas fa-times" style="font-size: 1.2rem; color: #495057;"></i>
                </button>
            </div>

            <!-- Nút "Xóa tất cả" - chỉ hiển thị trên desktop -->
            <div class="d-none d-md-flex justify-content-end">
                <button class="btn btn-sm btn-reset text-danger d-flex align-items-center pe-0" style="border: none; background: none;">
                    <i class="bi bi-trash3-fill" style="font-size: 1.2rem;"></i>
                    <span class="ms-2 text-primary">Xóa tất cả</span>
                </button>
            </div>
        </div>
        
        <!-- Price Filter Section -->
        <div class="filter-section mb-2">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="filter-title mb-0 fw-semibold" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#filter-price" 
                    aria-expanded="true" 
                    role="button"
                    style="cursor: pointer;">
                    <span>Mức giá</span>
                    <i class="fas fa-chevron-down ms-2"></i>
                </h6>
                <button class="btn-reset-section btn-reset-list btn btn-link p-0 text-decoration-none" 
                        data-section="price" 
                        style="font-size: 0.8rem; color: #01964a;">
                    <i class="fas fa-redo me-1"></i> Đặt lại
                </button>
            </div>
            <div class="collapse show" id="filter-price">
                <div class="price-range-slider">
                    <div id="price-slider" class="mb-3"></div>
                    <div class="d-flex justify-content-between mt-2">
                        <span class="price-min small">100.000đ</span>
                        <span class="price-max small">5.000.000đ</span>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <input type="text" name="price_min" class="form-control form-control-sm price-input price-input-min" placeholder="Từ" style="width: 48%">
                        <input type="text" name="price_max" class="form-control form-control-sm price-input price-input-max" placeholder="Đến" style="width: 48%">
                    </div>
                </div>
            </div>
        </div>

        <!-- Rating Filter Section -->
        <div class="filter-section mb-2">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="filter-title mb-0 fw-semibold" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#filter-rating" 
                    aria-expanded="true" 
                    role="button"
                    style="cursor: pointer;">
                    <span>Đánh giá</span>
                    <i class="fas fa-chevron-down ms-2"></i>
                </h6>
                <button class="btn-reset-section btn-reset-list btn btn-link p-0 text-decoration-none" 
                        data-section="rating" 
                        style="font-size: 0.8rem; color: #01964a;">
                    <i class="fas fa-redo me-1"></i> Đặt lại
                </button>
            </div>
            
            @php
                $ratings = [
                    ['star' => 5, 'count' => 128],
                    ['star' => 4, 'count' => 84],
                    ['star' => 3, 'count' => 42],
                    ['star' => 2, 'count' => 15],
                    ['star' => 1, 'count' => 8],
                ];
            @endphp

            <div class="collapse show" id="filter-rating">
                <ul class="filter-list">
                    @foreach($ratings as $rating)
                        <li class="filter-item">
                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input filtering" name="score" type="radio" id="rating-{{ $rating['star'] }}" value="{{ $rating['star'] }}">
                                <label class="form-check-label ms-2" for="rating-{{ $rating['star'] }}">
                                    <span class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $rating['star'])
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </span>
                                    @if($rating['star'] < 5)
                                        <span class="text-muted ms-1">& up</span>
                                    @endif
                                </label>
                                <span class="badge bg-light text-dark ms-auto">{{ $rating['count'] }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Size Filter -->
        @if (!is_null($filters))
            @foreach ($filters as $key => $val)
                <div class="filter-section {{ !$loop->last ? 'mb-2' : '' }}">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="filter-title mb-0 fw-semibold flex-grow-1" 
                            data-bs-toggle="collapse" data-bs-target="#filter-size-{{ $key }}" 
                            aria-expanded="true" role="button">
                            <span>{{ $val->name }}</span>
                            <i class="fas fa-chevron-down ms-2"></i>
                        </h6>
                        <button class="btn-reset-section btn-reset-list btn btn-link p-0 text-decoration-none me-2" 
                                data-section="attribute-{{ $val->attribute_catalogue_id }}" 
                                style="font-size: 0.8rem; color: #01964a;">
                            <i class="fas fa-redo me-1"></i> Đặt lại
                        </button>
                    </div>
                    <div class="collapse show" id="filter-size-{{ $key }}">
                        <ul class="filter-list">
                            @if (count($val->attributes))
                                <div class="filter-body">
                                    @foreach ($val->attributes as $index => $item)
                                        <li class="filter-item">
                                            <div class="form-check d-flex align-items-center">
                                                <input id="attribute-{{ $item->attribute_id }}" 
                                                    value="{{ $item->attribute_id }}" 
                                                    class="form-check-input filtering filterAttribute" 
                                                    type="radio" 
                                                    name="attributes[{{ $val->attribute_catalogue_id }}]" 
                                                    data-group="{{ $val->attribute_catalogue_id }}">
                                                <label class="form-check-label ms-2" for="attribute-{{ $item->attribute_id }}">
                                                    {{ $item->name }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </div>
                            @endif
                        </ul>
                    </div>
                </div>
            @endforeach
        @endif
        <!-- Nút "Xóa tất cả" ở cuối - chỉ hiển thị trên mobile -->
        <div class="d-flex d-xl-none justify-content-center mt-4 mb-3 px-3">
            <button class="btn w-100 btn-outline-danger rounded-pill py-2 btn-reset" style="font-weight: 500;">
                <i class="bi bi-trash3-fill me-2"></i> Xóa tất cả bộ lọc
            </button>
        </div>
    </div>
</div>