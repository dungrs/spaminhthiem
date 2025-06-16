<div class="card shadow-sm">
    <a href="#addpost-metadata-collapse" class="text-dark collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-haspopup="true" aria-controls="addproduct-metadata-collapse">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                            @isset($index)
                                {!! $index !!}
                            @endisset
                        </div>
                    </div>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <h5 class="font-size-16 mb-1">{{ __('messages.configuration') }}</h5>
                    <p class="text-muted text-truncate mb-0">{{ __('messages.setup_title_description_keywords') }}</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                </div>
            </div>
        </div>
    </a>

    <div id="addpost-metadata-collapse" class="collapse show">
        <div class="p-4 border-top rounded-3">
            @include('backend.component.requiredFields')
            <div class="mb-3">
                <p class="meta_title fw-semibold fs-6 mb-1 text-primary">
                    {{ $model->meta_title ?? __('messages.seo_default.no_seo_title') }}
                </p>
                <small class="canonicalText text-success mb-1 d-block">
                    {{ isset($model->canonical) 
                        ? url('/') . '/' . $model->canonical . config('apps.general.suffix') 
                        : __('messages.seo_default.default_canonical')
                    }}
                </small>
                <p class="meta_description text-muted fs-6">
                    {{ $model->meta_description ?? __('messages.seo_default.no_seo_description') }}
                </p>
            </div>

            <hr class="border-muted">

            <div class="row">
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="meta_title">{{ __('messages.seo_title') }}</label>
                        <input id="meta_title" name="meta_title" placeholder="{{ __('messages.enter_seo_title') }}" type="text" class="form-control border-muted meta_title" value="{{ $model->meta_title ?? '' }}" {{ isset($disabled) ? 'disabled' : '' }}>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="meta_keyword">{{ __('messages.seo_keywords') }}</label>
                        <input id="meta_keyword" name="meta_keyword" placeholder="{{ __('messages.enter_seo_keywords') }}" type="text" class="form-control border-muted" value="{{ $model->meta_keyword ?? '' }}" {{ isset($disabled) ? 'disabled' : '' }}>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" for="meta_description">{{ __('messages.seo_description') }}</label>
                <textarea class="form-control border-muted" name="meta_description" id="meta_description" placeholder="{{ __('messages.enter_seo_description') }}" rows="6" {{ isset($disabled) ? 'disabled' : '' }}>{{ $model->meta_description ?? '' }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" for="canonical">
                    {{ __('messages.keyword') }} <i class="uil uil-exclamation-circle text-danger"></i>
                </label>
                <div class="input-group">
                    <span class="input-group-text base-url">{{ url('/') }}/</span>
                    <input name="canonical" type="text" class="form-control border-muted canonical seo-canonical" id="canonical" placeholder="{{ __('messages.enter_keyword') }}" value="{{ $model->canonical ?? '' }}" {{ isset($disabled) ? 'disabled' : '' }}>
                </div>
            </div>
        </div>
    </div>
</div>
