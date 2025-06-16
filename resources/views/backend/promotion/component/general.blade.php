<div id="add-general-accordion" class="custom-accordion">
    <div class="card shadow-sm">
        <a href="#add-general-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true">
            <div class="p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar">
                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">01</div>
                        </div>
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="font-size-16 mb-1">@lang('messages.promotion.general.title')</h5>
                        <p class="text-muted text-truncate mb-0">@lang('messages.promotion.general.description')</p>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                    </div>
                </div>
            </div>
        </a>
        
        <div id="add-general-collapse" class="collapse show">
            <div class="p-4 border-top">
                <div class="row">
                    <div class="col-6 mb-3">
                        <label for="name">@lang('messages.promotion.general.name_label') @lang('messages.promotion.general.required')</label>
                        <input type="text" class="form-control name" name="name" value="{{ $model->name ?? '' }}" placeholder="@lang('messages.promotion.general.name_placeholder')">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="code">@lang('messages.promotion.general.code_label') @lang('messages.promotion.general.required')</label>
                        <input type="text" class="form-control code" name="code" value="{{ $model->code ?? '' }}" placeholder="@lang('messages.promotion.general.code_placeholder')">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-medium">@lang('messages.promotion.general.content_label')</label>
                        <textarea class="form-control description" 
                                  name="description" 
                                  rows="4"
                                  placeholder="@lang('messages.promotion.general.content_placeholder')">{{ $model->description ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>