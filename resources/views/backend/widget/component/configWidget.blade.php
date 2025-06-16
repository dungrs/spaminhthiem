<div class="card shadow-sm">
    <a href="#add-widgetInfo-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">03</div>
                    </div>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <h5 class="font-size-16 mb-1">@lang('messages.widget.content_configuration.title')</h5>
                    <p class="text-muted text-truncate mb-0">@lang('messages.widget.content_configuration.description')</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                </div>
            </div>
        </div>
    </a>

    <div id="add-widgetInfo-collapse" class="collapse show">
        <div class="p-4 border-top">
            <div class="mb-4">
                <h6 class="fw-500 mb-3">@lang('messages.widget.content_configuration.module_section.title')</h6>
                
                <div class="list-group list-group-flush">
                    @foreach (__('module.models') as $key => $val)
                    <label class="list-group-item list-group-item-action rounded p-3 border-0" style="cursor: pointer">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input input-radio" 
                                       type="radio" 
                                       name="model"
                                       data-model="{{ $key }}" 
                                       data-modelParent="{{ $val['modelParent'] }}"
                                       id="module-{{ $key }}"
                                       value="{{ $key }}"
                                       @checked((isset($widget->model) ? $widget->model : null) == $key)>
                                <span class="form-check-label ms-2">
                                    {{ $val['name'] }}
                                </span>
                            </div>
                            @if($val['description'] ?? false)
                            <small class="text-muted text-truncate ms-2" style="max-width: 150px;">
                                {{ $val['description'] }}
                            </small>
                            @endif
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Search Section -->
            <div class="search-section mb-4">
                <select class="form-control rounded choice-single search-model-select">
                    <option value="">@lang('messages.widget.content_configuration.module_section.select_placeholder')</option>
                </select>
            </div>
        
            <!-- Search Results -->
            <div class="search-modal-results">
                <!-- Empty State -->
                <div class="empty-state text-center py-4 notification-model">
                    <i class="bx bx-search-alt fs-4 text-muted mb-2"></i>
                    <p class="text-muted mb-0">@lang('messages.widget.content_configuration.search_section.empty_state.text')</p>
                </div>
            
                @if (isset($widgetItem) && !empty($widgetItem))
                    @foreach ($widgetItem['id'] as $key => $val)
                        <div class="search-result-item card p-3 mb-2 w-100" data-canonical="{{ $widgetItem['canonical'][$key] }}">
                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                <div class="d-flex align-items-center flex-grow-1 min-w-0">
                                    <div class="image-thumbnail me-3 flex-shrink-0">
                                        <img src="{{ $widgetItem['image'][$key] }}" 
                                            class="rounded img-fluid" 
                                            alt="Preview"
                                            style="width: 60px; height: 60px; object-fit: cover;">
                                    </div>
                                    <div class="item-info flex-grow-1 min-w-0">
                                        <h6 class="mb-1 text-truncate">{{ $widgetItem['name'][$key] }}</h6>
                                        <small class="text-muted text-truncate d-block">
                                            @lang('messages.widget.content_configuration.search_section.item_template.path_label'): /{{ $widgetItem['canonical'][$key] }}
                                        </small>
                                    </div>
                                    <div class="hidden-fields d-none">
                                        <input type="hidden" name="modelItem[id][]" value="{{ $widgetItem['id'][$key] }}">
                                        <input type="hidden" name="modelItem[name][]" value="{{ $widgetItem['name'][$key] }}">
                                        <input type="hidden" name="modelItem[image][]" value="{{ $widgetItem['image'][$key] }}">
                                        <input type="hidden" name="modelItem[canonical][]" value="{{ $widgetItem['canonical'][$key] }}">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger delete-model-item ms-3 mt-2 mt-md-0">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>