<div class="col-lg-3 pe-lg-4">
    <div class="filter-card mb-4 filter-data">
        <input type="hidden" name="product_catalogue_id" value="{{ $productCatalogue->id }}">
        <input type="hidden" name="language_id" value="{{ $languageId }}">

        <div class="filter-header d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 fw-bold">BỘ LỌC SẢN PHẨM</h5>
            <button class="btn btn-sm btn-reset text-danger d-flex align-items-center btn-reset" style="border: none; background: none;">
                <i class="bi bi-trash3-fill" style="font-size: 1.2rem;"></i> <!-- Bootstrap Icon for trash -->
                <span class="ms-2">Xóa tất cả</span>
            </button>
        </div>

        <!-- Price Filter Section -->
        <div class="filter-section mb-4">
            <h6 class="filter-title mb-3 fw-semibold d-flex justify-content-between align-items-center">
                <span>Mức giá</span>
            </h6>
            <div class="price-range-slider">
                <div id="price-slider" class="mb-3"></div>
                <div class="d-flex justify-content-between mt-2">
                    <span class="price-min small">100.000đ</span>
                    <span class="price-max small">1.000.000đ</span>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <input type="text" name="price_min" class="form-control form-control-sm price-input price-input-min" placeholder="Từ" style="width: 48%">
                    <input type="text" name="price_max" class="form-control form-control-sm price-input price-input-max" placeholder="Đến" style="width: 48%">
                </div>
            </div>
        </div>

        <!-- Rating Filter Section -->
        <div class="filter-section mb-4">
            <h6 class="filter-title mb-3 fw-semibold d-flex justify-content-between align-items-center" 
                data-bs-toggle="collapse" data-bs-target="#filter-rating" aria-expanded="true" role="button">
                <span>Đánh giá</span>
                <i class="fas fa-chevron-down"></i>
            </h6>
        
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
                <div class="filter-section {{ !$loop->last ? 'mb-3' : '' }} ">
                    <h6 class="filter-title mb-3 fw-semibold d-flex justify-content-between align-items-center" 
                        data-bs-toggle="collapse" data-bs-target="#filter-size-{{ $key }}" aria-expanded="true" role="button">
                        <span>{{ $val->name }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </h6>
                    <div class="collapse show" id="filter-size-{{ $key }}">
                        <ul class="filter-list">
                            @if (count($val->attributes))
                                <div class="filter-body">
                                    @foreach ($val->attributes as $index => $item)
                                        <li class="filter-item">
                                            <div class="form-check d-flex align-items-center">
                                                <input id="attribute-{{ $item->attribute_id }}" value="{{ $item->attribute_id }}" class="form-check-input filtering filterAttribute" type="radio" name="attributes[{{ $val->attribute_catalogue_id }}]" data-group="{{ $val->attribute_catalogue_id }}">
                                                <label class="form-check-label ms-2" for="attribute-{{ $item->attribute_id }}">{{ $item->name }}</label>
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
    </div>
</div>