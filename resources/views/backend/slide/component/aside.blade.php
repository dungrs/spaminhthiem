<div class="card shadow-sm border-0 overflow-hidden">
    <!-- Collapsible Header -->
    <a href="#addslide-aside-basic-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">02</div>
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

    <!-- Collapsible Content -->
    <div id="addslide-aside-basic-collapse" class="collapse show">
        <div class="card-body p-4 border-top">
            @include('backend.component.requiredFields')
            <div class="row g-3">
                <!-- Slide Name -->
                <div class="col-12">
                    <label class="form-label fw-medium">
                        @lang('messages.slide.basic_settings.fields.name.label') <i class="uil uil-exclamation-circle text-danger"></i>
                    </label>
                    <input type="text" 
                           class="form-control name" 
                           name="name" 
                           placeholder="@lang('messages.slide.basic_settings.fields.name.placeholder')"
                           value="{{ isset($slide->name) ? $slide->name : null}}"
                           required>
                    <small class="text-muted">@lang('messages.slide.basic_settings.fields.name.help')</small>
                </div>

                <!-- Keyword -->
                <div class="col-12">
                    <label class="form-label fw-medium">
                        @lang('messages.slide.basic_settings.fields.keyword.label') <i class="uil uil-exclamation-circle text-danger"></i>
                    </label>
                    <input type="text" 
                           class="form-control keyword" 
                           name="keyword" 
                           placeholder="@lang('messages.slide.basic_settings.fields.keyword.placeholder')"
                           value="{{ isset($slide->keyword) ? $slide->keyword : null}}"
                           required>
                    <small class="text-muted">@lang('messages.slide.basic_settings.fields.keyword.help')</small>
                </div>

                <!-- Dimensions -->
                <div class="col-12">
                    <div class="border p-3 rounded">
                        <h6 class="fw-semibold mb-3 d-flex align-items-center">
                            <i class="bx bx-ruler me-2"></i>@lang('messages.slide.basic_settings.fields.dimensions.title')
                        </h6>
                        
                        <div class="row g-3">
                            <!-- Width -->
                            <div class="col-md-6">
                                <label class="form-label">@lang('messages.slide.basic_settings.fields.dimensions.width')</label>
                                <div class="input-group">
                                    <input type="text" 
                                           name="setting[width]" 
                                           value="{{ isset($slide->setting['width']) ? $slide->setting['width'] : null}}"
                                           class="form-control int setting-value"
                                           min="0">
                                    <span class="input-group-text">@lang('messages.slide.basic_settings.fields.dimensions.unit')</span>
                                </div>
                            </div>
                            
                            <!-- Height -->
                            <div class="col-md-6">
                                <label class="form-label">@lang('messages.slide.basic_settings.fields.dimensions.height')</label>
                                <div class="input-group">
                                    <input type="text" 
                                           name="setting[height]" 
                                           value="{{ isset($slide->setting['height']) ? $slide->setting['height'] : null}}"
                                           class="form-control int setting-value"
                                           min="0">
                                    <span class="input-group-text">@lang('messages.slide.basic_settings.fields.dimensions.unit')</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Animation -->
                <div class="col-12">
                    <label class="form-label fw-semibold">@lang('messages.slide.basic_settings.fields.animation.label')</label>
                    <select name="setting[animation]" class="form-select choice-single">
                        @foreach (__('module.effect') as $key => $val)
                            <option value="{{ $key }}"
                                @selected(isset($slide->setting['animation']) && $slide->setting['animation'] == $key)>
                                {{ $val }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Navigation Arrows -->
                <div class="col-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="setting[arrow]" value="accept" name="setting[arrow]" role="switch"
                        @checked(isset($slide->setting['arrow']) && $slide->setting['arrow'] == 'accept')>
                        <label class="form-check-label fw-medium" for="setting[arrow]">@lang('messages.slide.basic_settings.fields.navigation.arrows')</label>
                    </div>
                </div>

                <!-- Navigation Type -->
                <div class="col-12">
                    <label class="form-label fw-semibold mb-2">@lang('messages.slide.basic_settings.fields.navigation.type')</label>
                    <div class="d-flex flex-wrap gap-3">
                        @foreach (__('module.navigate') as $key => $val)
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="setting[navigate]" 
                                       id="navigation_{{ $key }}" 
                                       value="{{ $key }}"
                                       @checked((isset($slide->setting['navigate']) ? $slide->setting['navigate'] : 'dot') == $key)>
                                <label class="form-check-label" for="navigation_{{ $key }}">{{ $val }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Advanced Settings Card -->
<div class="card shadow-sm border-0 overflow-hidden">
    <!-- Card Header with Collapse Toggle -->
    <a href="#addslide-aside-advance-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">03</div>
                    </div>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <h5 class="font-size-16 mb-1">@lang('messages.slide.advanced_settings.title')</h5>
                    <p class="text-muted text-truncate mb-0">@lang('messages.slide.advanced_settings.description')</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                </div>
            </div>
        </div>
    </a>

    <!-- Card Body - Collapsible Content -->
    <div id="addslide-aside-advance-collapse" class="collapse show">
        <div class="card-body p-4 border-top">
            <div class="row g-3">
                <!-- Auto Play Toggle -->
                <div class="col-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="setting[autoplay]" id="setting[autoplay]" role="switch" value="accept"
                        @checked(isset($slide->setting['autoplay']) && $slide->setting['autoplay'] == 'accept')>
                        <label class="form-check-label fw-medium" for="setting[autoplay]">@lang('messages.slide.advanced_settings.autoplay.label')</label>
                    </div>
                    <small class="text-muted">@lang('messages.slide.advanced_settings.autoplay.help')</small>
                </div>

                <!-- Pause on Hover Toggle -->
                <div class="col-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="setting[pauseHover]" id="setting[pauseHover]" role="switch" value="accept"
                        @checked(isset($slide->setting['pauseHover']) && $slide->setting['pauseHover'] == 'accept')>
                        <label class="form-check-label fw-medium" for="setting[pauseHover]">@lang('messages.slide.advanced_settings.pause_hover.label')</label>
                    </div>
                    <small class="text-muted">@lang('messages.slide.advanced_settings.pause_hover.help')</small>
                </div>

                <!-- Animation Settings -->
                <div class="col-12">
                    <div class="border p-3 rounded">
                        <h6 class="fw-semibold mb-3 d-flex align-items-center">
                            <i class="bx bx-slider-alt me-2"></i>@lang('messages.slide.advanced_settings.animation.title')
                        </h6>
                        
                        <div class="row g-3">
                            <!-- Animation Delay -->
                            <div class="col-md-6">
                                <label class="form-label">@lang('messages.slide.advanced_settings.animation.delay.label')</label>
                                <div class="input-group">
                                    <input type="text" 
                                           name="setting[animationDelay]" 
                                           class="form-control int setting-value"
                                           value="{{ isset($slide->setting['animationDelay']) ? $slide->setting['animationDelay'] : null}}"
                                           min="0"
                                           placeholder="@lang('messages.slide.advanced_settings.animation.delay.placeholder')">
                                    <span class="input-group-text">@lang('messages.slide.advanced_settings.animation.delay.unit')</span>
                                </div>
                                <small class="text-muted">@lang('messages.slide.advanced_settings.animation.delay.help')</small>
                            </div>
                            
                            <!-- Animation Speed -->
                            <div class="col-md-6">
                                <label class="form-label">@lang('messages.slide.advanced_settings.animation.speed.label')</label>
                                <div class="input-group">
                                    <input type="text" 
                                           name="setting[animationSpeed]" 
                                           class="form-control int setting-value"
                                           value="{{ isset($slide->setting['animationSpeed']) ? $slide->setting['animationSpeed'] : null}}"
                                           min="0"
                                           placeholder="@lang('messages.slide.advanced_settings.animation.speed.placeholder')">
                                    <span class="input-group-text">@lang('messages.slide.advanced_settings.animation.speed.unit')</span>
                                </div>
                                <small class="text-muted">@lang('messages.slide.advanced_settings.animation.speed.help')</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shortcode Card -->
<div class="card shadow-sm border-0 overflow-hidden">
    <a href="#addslide-aside-shortcode-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">04</div>
                    </div>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <h5 class="font-size-16 mb-1">@lang('messages.slide.shortcode.title')</h5>
                    <p class="text-muted text-truncate mb-0">@lang('messages.slide.shortcode.description')</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                </div>
            </div>
        </div>
    </a>

    <div id="addslide-aside-shortcode-collapse" class="collapse show">
        <div class="card-body p-4 border-top">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label fw-medium">@lang('messages.slide.shortcode.label')</label>
                    <textarea class="form-control short_code" 
                              name="short_code" 
                              rows="4"
                              placeholder="@lang('messages.slide.shortcode.placeholder')">{{ isset($slide->short_code) ? $slide->short_code : null}}</textarea>
                    <small class="text-muted">@lang('messages.slide.shortcode.help')</small>
                </div>
            </div>
        </div>
    </div>
</div>