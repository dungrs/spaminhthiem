<div class="card shadow-sm">
    <a href="#add-widgetInfo-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">04</div>
                    </div>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <h5 class="font-size-16 mb-1">@lang('messages.slide.basic_settings.title')</h5>
                    <p class="text-muted text-truncate mb-0">@lang('messages.slide.basic_settings.description')</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                </div>
            </div>
        </div>
    </a>

    <div id="add-widgetInfo-collapse" class="collapse show">
        <div class="p-4 border-top">
            <div class="mb-3">
                <label for="name" class="form-label">
                    @lang('messages.widget.fields.name.label') <i class="uil uil-exclamation-circle text-danger"></i>
                </label>
                <input type="text" class="form-control name" value="{{ $widget->name ?? '' }}" name="name" placeholder="@lang('messages.widget.fields.name.placeholder')">
            </div>
            <div class="mb-3">
                <label for="keyword" class="form-label">
                    @lang('messages.widget.fields.keyword.label') <i class="uil uil-exclamation-circle text-danger"></i>
                </label>
                <input type="text" class="form-control keyword" value="{{ $widget->keyword ?? '' }}" name="keyword" id="keyword" placeholder="@lang('messages.widget.fields.keyword.placeholder')">
            </div>
            <div class="mb-3">
                <label class="form-label">@lang('messages.slide.shortcode.label')</label>
                <textarea class="form-control short_code" 
                          name="short_code" 
                          rows="4"
                          placeholder="@lang('messages.slide.shortcode.placeholder')">{{ isset($widget->short_code) ? $widget->short_code : null}}</textarea>
                <small class="text-muted">@lang('messages.slide.shortcode.help')</small>
            </div>
        </div>
    </div>
</div>