<div class="card shadow-sm">
    <a href="#addpost-parent-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">03</div>
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

    <div id="addpost-parent-collapse" class="collapse show">
        <div class="p-4 border-top">
            <div class="mb-3 parent-select">
                <label class="form-label fw-semibold">{{ __('messages.parent_category') }}</label>
                <select name="parent_id" class="form-control rounded choice-single">
                    @foreach ($dropdown as $key => $val)
                        <option {{ $key == old('parent_id', isset($model->parent_id) ? $model->parent_id : '') ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
                <small class="text-muted d-block">
                    <i class="uil uil-info-circle text-primary"></i> {!! __('messages.select_root_if_no_parent') !!}
                </small>
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
    <a href="#addpost-image-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">04</div>
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

    <div id="addpost-image-collapse" class="collapse show">
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