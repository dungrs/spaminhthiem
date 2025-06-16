<div class="card shadow-sm">
    <a href="#addmodel-info-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true">
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
                    <h5 class="font-size-16 mb-1">{{ __('messages.general_information') }}</h5>
                    <p class="text-muted text-truncate mb-0">{{ __('messages.enter_title_description_content') }}</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                </div>
            </div>
        </div>
    </a>

    <div id="addmodel-info-collapse" class="collapse show" data-bs-parent="#addmodel-accordion">
        <div class="p-4 border-top">
            @include('backend.component.requiredFields')
            @if (!isset($offTitle))
                <div class="mb-3">
                    <label class="form-label fw-semibold" for="name">
                        {{ __('messages.title') }} <i class="uil uil-exclamation-circle text-danger"></i>
                    </label>
                    <input id="name" name="name" placeholder="{{ __('messages.enter_title') }}" type="text" class="form-control name" value="{{ $model->name ?? '' }}" {{ isset($disabled) ? 'disabled' : '' }}>
                </div>
            @endif
            <div class="mb-3">
                <label class="form-label fw-semibold" for="description">{{ __('messages.short_description') }}</label>
                <textarea id="description" name="description" class="form-control ckeditor-classic" placeholder="{{ __('messages.enter_short_description') }}" rows="10" {{ isset($disabled) ? 'disabled' : '' }}>
                    {{ $model->description ?? '' }}
                </textarea>
            </div>
            @if (!isset($offContent))
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center form-label">
                        <div class="fw-semibold">{{ __('messages.content') }}</div>
                        @if (!isset($disabled))
                            <a href="#" class="text-primary upload-image-ckeditor">{{ __('messages.upload_image') }}</a>
                        @endif
                    </div>
                    <textarea id="content" name="content" class="form-control ckeditor-classic" placeholder="{{ __('messages.enter_content') }}" rows="4" {{ isset($disabled) ? 'disabled' : '' }}>
                        {{ $model->content ?? '' }}
                    </textarea>
                </div>
            @endif
        </div>
    </div>
</div>
