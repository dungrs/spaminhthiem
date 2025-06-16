<div class="card shadow-sm">
    <a href="#addmodel-parent-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">06</div>
                    </div>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <h5 class="font-size-16 mb-1">{{ __('messages.advanced_settings') }}</h5>
                    <p class="text-muted text-truncate mb-0">{{ __('messages.configure_category_status_navigation') }}</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                </div>
            </div>
        </div>
    </a>

    <div id="addmodel-parent-collapse" class="collapse show">
        <div class="p-4 border-top">
            <div class="mb-3 parent-select">
                <div class="product_catalogue_id">
                    <label class="form-label fw-semibold">{{ __('messages.parent_category') }} <i class="uil uil-exclamation-circle text-danger"></i></label>
                    <div class="">
                        <select name="product_catalogue_id" class="form-control rounded choice-single">
                            @foreach ($dropdown as $key => $val)
                                <option {{ $key == old('product_catalogue_id', isset($model->product_catalogue_id) ? $model->product_catalogue_id : '') ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            @php
                $catalogues = isset($model) ? $product->product_catalogues->pluck('id')->toArray() : [];
                $selectedCatalogues = old('catalogues', $catalogues);
            @endphp
            
            <div class="mb-3">
                <label class="form-label fw-semibold">Chọn danh mục</label>
                <select class="form-control choice-multi" name="catalogue[]" multiple>
                    @foreach ($dropdown as $key => $val)
                        <option value="{{ $key }}" 
                            {{ in_array($key, $selectedCatalogues) && (!isset($model->product_catalogue_id) || $key !== $model->product_catalogue_id) ? 'selected' : '' }}>
                            {{ $val }}
                        </option>
                    @endforeach
                </select>
            </div>
        
            <div class="mb-3">
                <label for="publish" class="form-label fw-semibold">{{ __('messages.status') }}</label>
                <select name="publish" class="form-control rounded choice-single">
                    @foreach (__('general.publish') as $key => $val)
                        <option value="{{ $key }}" {{ isset($model->publish) && $model->publish == $key ? 'selected' : '' }}>
                            {{ $val }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="follow" class="form-label fw-semibold">{{ __('messages.navigation') }}</label>
                <select name="follow" class="form-control rounded choice-single">
                    @foreach (__('general.follow') as $key => $val)
                        <option value="{{ $key }}" {{ isset($model->follow) && $model->follow == $key ? 'selected' : '' }}>
                            {{ $val }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <a href="#addmodel-image-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">07</div>
                    </div>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <h5 class="font-size-16 mb-1">{{ __('messages.featured_image') }}</h5>
                    <p class="text-muted text-truncate mb-0">{{ __('messages.select_representative_image') }}</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                </div>
            </div>
        </div>
    </a>

    <div id="addmodel-image-collapse" class="collapse show">
        <div class="p-4 border-top">
            <div class="mb-3 form-row">
                <span class="image image-target">
                    <img class="preview-image" src="{{ isset($model->image) ? asset($model->image) : asset('backend/images/no-image.jpg') }}" alt="{{ __('messages.preview_image') }}">
                </span>
                <input type="hidden" name="image" value="{{ isset($model->image) ? asset($model->image) : asset('backend/images/no-image.jpg') }}">
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <a href="#addproduct-parent-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">08</div>
                    </div>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <h5 class="font-size-16 mb-1">@lang('messages.product.aside.card.title')</h5>
                    <p class="text-muted text-truncate mb-0">@lang('messages.product.aside.card.description')</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                </div>
            </div>
        </div>
    </a>

    <div id="addproduct-parent-collapse" class="collapse show">
        <div class="p-4 border-top">
            <div class="mb-3 parent-select">
                <label for="code" class="form-label fw-semibold">@lang('messages.product.aside.form.code.label')</label>
                <input type="text" class="form-control code" name="code" placeholder="@lang('messages.product.aside.form.code.placeholder')">
            </div>
            <div class="mb-3">
                <label for="made_in" class="form-label fw-semibold">@lang('messages.product.aside.form.made_in.label')</label>
                <input type="text" class="form-control made_in" name="made_in" placeholder="@lang('messages.product.aside.form.made_in.placeholder')" value="{{ isset($model->made_in) ? $model->made_in : '' }}"">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label fw-semibold">@lang('messages.product.aside.form.price.label')</label>
                <input type="text" class="form-control price int" name="price" placeholder="@lang('messages.product.aside.form.price.placeholder')">
            </div>
        </div>
    </div>
</div>