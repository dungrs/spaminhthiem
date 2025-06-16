<div class="card shadow-sm">
    <a href="#addmodal-info-collapse-translate" class="text-dark" data-bs-toggle="collapse" aria-expanded="true">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                            01
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

    <div id="addmodal-info-collapse-translate" class="collapse show" data-bs-parent="#addpost-accordion">
        <div class="p-4 border-top">
            @include('backend.component.requiredFields')
            @if (!isset($offTitle))
                <div class="mb-3">
                    <label class="form-label fw-semibold" for="name_trans">
                        {{ __('messages.title') }} <i class="uil uil-exclamation-circle text-danger"></i>
                    </label>
                    <input id="name_trans" name="name_trans" placeholder="{{ __('messages.enter_title') }}" type="text" class="form-control name_trans" value="{{ $model->name ?? '' }}">
                </div>
            @endif
            <div class="mb-3">
                <label class="form-label fw-semibold" for="description_trans">{{ __('messages.short_description') }}</label>
                <textarea id="description_trans" name="description_trans" class="form-control ckeditor-classic trans" placeholder="{{ __('messages.enter_short_description') }}" rows="10">
                    {{ $model->description ?? '' }}
                </textarea>
            </div>
            @if(!isset($offContent))
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center form-label">
                        <div class="fw-semibold">{{ __('messages.content') }}</div>
                        <a href="#" class="text-primary upload-image-ckeditor">{{ __('messages.upload_image') }}</a>
                    </div>
                    <textarea id="content_trans" name="content_trans" class="form-control ckeditor-classic trans" placeholder="{{ __('messages.enter_content') }}" rows="4">
                        {{ $model->content ?? '' }}
                    </textarea>
                </div>
            @endif
        </div>
    </div>
</div>
