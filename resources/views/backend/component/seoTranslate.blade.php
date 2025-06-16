<div class="card shadow-sm">
    <a href="#addmodal-metadata-collapse-translate" class="text-dark collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-haspopup="true" aria-controls="addproduct-metadata-collapse">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                            02
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

    <div id="addmodal-metadata-collapse-translate" class="collapse show">
        <div class="p-4 border-top rounded-3">
            @include('backend.component.requiredFields')
            <div class="mb-3">
                <p class="meta_title_trans fw-semibold fs-6 mb-1 text-primary">
                    {{ $model->meta_title ?? __('messages.seo_default.no_seo_title') }}
                </p>
                <small class="canonicalTextTranslate text-success mb-1 d-block">
                    {{ isset($model->canonical) 
                        ? url('/') . '/' . $model->canonical . config('apps.general.suffix') 
                        : __('messages.seo_default.default_canonical')
                    }}
                </small>
                <p class="meta_description_trans text-muted fs-6">
                    {{ $model->meta_description ?? __('messages.seo_default.no_seo_description') }}
                </p>
            </div>

            <hr class="border-muted">

            <div class="row">
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="meta_title_trans">{{ __('messages.seo_title') }}</label>
                        <input id="meta_title_trans" name="meta_title_trans" placeholder="{{ __('messages.enter_seo_title') }}" type="text" class="form-control border-muted meta_title" value="{{ $model->meta_title ?? '' }}">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="meta_keyword_trans">{{ __('messages.seo_keywords') }}</label>
                        <input id="meta_keyword_trans" name="meta_keyword_trans" placeholder="{{ __('messages.enter_seo_keywords') }}" type="text" class="form-control border-muted" value="{{ $model->meta_keyword ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" for="meta_description">{{ __('messages.seo_description') }}</label>
                <textarea id="meta_description_trans" class="form-control border-muted" name="meta_description_trans" placeholder="{{ __('messages.enter_seo_description') }}" rows="6">{{ $model->meta_description ?? '' }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" for="canonical_trans">
                    {{ __('messages.keyword') }} <i class="uil uil-exclamation-circle text-danger"></i>
                </label>
                <div class="input-group">
                    <span class="input-group-text base-url">{{ url('/') }}/</span>
                    <input name="canonical_trans" type="text" class="form-control border-muted canonical_trans" id="canonical_trans" placeholder="{{ __('messages.enter_keyword') }}" value="{{ $model->canonical ?? '' }}">
                </div>
            </div>
        </div>
    </div>
</div>
