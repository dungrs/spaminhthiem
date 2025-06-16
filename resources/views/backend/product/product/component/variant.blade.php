<div class="card shadow-sm">
    <a href="#addproduct-variant-collapse" class="text-dark collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-haspopup="true" aria-controls="addproduct-variant-collapse">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                            04
                        </div>
                    </div>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <h5 class="font-size-16 mb-1">{{ __('messages.product.step_4_title') }}</h5>
                    <p class="text-muted text-truncate mb-0">{{ __('messages.product.step_4_description') }}</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                </div>
                
            </div>
        </div>
    </a>
    @php
        $attributeCatalogueResponse = isset($product->attributeCatalogue) ? json_decode($product->attributeCatalogue, TRUE) : [];
    @endphp

    <div id="addproduct-variant-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
        <div class="p-4 border-top rounded-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-check font-size-16 d-flex">
                        <input type="checkbox" class="form-check-input variantCheckbox me-2" name="accept" value="1" id="variantCheckbox" {{ (isset($product) && count($product->product_variants) > 0) ? 'checked' : '' }}> 
                        <label class="form-check-label mb-0 turnOnVariant" for="variantCheckbox">{{ __('messages.product.has_variant_label') }}</label>
                    </div>
                </div>
            </div>

            <div class="variant-wrapper mt-4  {{ count($attributeCatalogueResponse) > 0 ? "" : "hidden" }}">
                <div class="row variant-container">
                    <div class="col-lg-4">
                        <div class="attribute-title mb-3">{{ __('messages.product.choose_attribute_group') }}</div>
                    </div>
                    <div class="col-lg-8">
                        <div class="attribute-title mb-3">{{ __('messages.product.choose_attribute_value') }}</div>
                    </div>
                </div>
                <div class="variant-body">
                    @if (!empty($attributeCatalogueResponse))
                        @foreach ($attributeCatalogueResponse as $value)
                        <div class="row mb-2 variant-item">
                            <div class="col-lg-4">
                                <div class="attribute-catalogue">
                                    <div class="mb-2">
                                        <select class="form-control rounded choice-single choose-attribute" name="attributeCatalogue[]">
                                            <option value="">{{ __('messages.product.choose_attribute_group') }}</option>
                                            @foreach ($attributeCatalogues as $item)
                                                <option {{ $value == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <select class="form-control choice-multi selectVariant variant-{{ $value }}" data-catId="{{ $value }}" name="attribute[{{ $value }}][]" multiple>
                                    <option value="">{{ __('messages.product.choose_attribute_value') }}</option>
                                </select>
                            </div>
                            <div class="col-lg-1">
                                <button type="button" class="remove-attribute btn btn-danger">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
                <div class="variant-foot mt-3 col text-end me-4">
                    <button type="button" class="add-variant btn btn-soft-primary w-md text-truncate">{{ __('messages.product.add_variant_button') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card shadow-sm">
    <a href="#addproduct-variant-list-collapse" class="text-dark collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-haspopup="true" aria-controls="addproduct-variant-list-collapse">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                            05
                        </div>
                    </div>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <h5 class="font-size-16 mb-1">{{ __('messages.product.step_5_title') }}</h5>
                    <p class="text-muted text-truncate mb-0">{{ __('messages.product.step_5_description') }}</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                </div>
            </div>
        </div>
    </a>

    <div id="addproduct-variant-list-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
        <div class="p-4 border-top rounded-3">
            <table class="table table-bordered variantTable">
                <thead></thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>