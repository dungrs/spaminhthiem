<div class="card shadow-sm border-0 overflow-hidden">
    <!-- Card Header -->
    <a href="#addslide-slide-list-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">02</div>
                    </div>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <h5 class="font-size-16 mb-1">@lang('messages.slide.list.title')</h5>
                    <p class="text-muted text-truncate mb-0">@lang('messages.slide.list.description')</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                </div>
            </div>
        </div>
    </a>

    <!-- Card Body -->
    <div id="addslide-slide-list-collapse" class="collapse show">
        <div class="card-body p-4 border-top">
            <!-- Add Slide Button -->
            <div class="d-flex justify-content-end mb-4">
                <a class="btn btn-primary addSlide">
                    <i class="bx bx-plus me-1"></i> @lang('messages.slide.list.add_slide')
                </a>
            </div>

            <!-- Slide Item -->
            <div class="slide-list">
                <!-- Empty state notification -->
                <div class="empty-state text-center py-5 slide-notification {{ isset($slide) ? 'hidden' : '' }}">
                    <div class="empty-state-icon bg-soft-primary rounded-circle p-4 mb-3 d-inline-block">
                        <i class="bx bx-slider-alt text-primary" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="mb-2">@lang('messages.slide.list.empty_state.title')</h5>
                    <p class="text-muted mb-4">@lang('messages.slide.list.empty_state.description')</p>
                </div>

                @if (isset($slideItem) && count($slideItem) > 0)
                    @foreach ($slideItem['image'] as $key => $value)
                        @php
                            $image = $value;
                            $description = $slideItem['description'][$key] ?? '';
                            $name = $slideItem['name'][$key] ?? '';
                            $canonical = $slideItem['canonical'][$key] ?? '';
                            $alt = $slideItem['alt'][$key] ?? '';
                            $window = isset($slideItem['window'][$key])? $slideItem['window'][$key] : '';
                        @endphp

                        <div class="card mb-4 border position-relative slide-item">
                            <div class="row g-0">
                                <!-- Slide Image with Hover Effect -->
                                <div class="col-md-4 position-relative">
                                    <div class="ratio ratio-16x9 h-100">
                                        <img class="img-fluid card-img object-fit-cover slide-image" src="{{ $image }}" alt="Slide preview">
                                        <input type="hidden" name="slide[image][]" value="{{ $image }}">
                                    </div>
                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 start-0 m-2 deleteSlide z-3" style="width: 30px; height: 30px;">
                                        <i class="bx bx-trash" title="@lang('messages.slide.list.buttons.delete')"></i>
                                    </button>
                                </div>
                                
                                <!-- Slide Content -->
                                <div class="col-md-8">
                                    <div class="card-body p-0 h-100 d-flex flex-column">
                                        <!-- Tabs Navigation -->
                                        <ul class="nav nav-tabs nav-tabs-custom px-3 pt-3" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#slide-info-{{ $key }}" role="tab">
                                                    <i class="bx bx-info-circle d-md-none"></i>
                                                    <span class="d-none d-md-inline">@lang('messages.slide.list.tabs.general')</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#slide-seo-{{ $key }}" role="tab">
                                                    <i class="bx bx-search-alt d-md-none"></i>
                                                    <span class="d-none d-md-inline">@lang('messages.slide.list.tabs.seo')</span>
                                                </a>
                                            </li>
                                        </ul>

                                        <!-- Tab Content -->
                                        <div class="tab-content p-3 flex-grow-1">
                                            <!-- General Info Tab -->
                                            <div class="tab-pane fade show active" id="slide-info-{{ $key }}" role="tabpanel">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <label class="form-label fw-medium">@lang('messages.slide.list.fields.description')</label>
                                                        <textarea class="form-control" 
                                                                name="slide[description][]" 
                                                                rows="3"
                                                                placeholder="@lang('messages.slide.list.fields.description_placeholder')"
                                                                required>{{ $description }}</textarea>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <label class="form-label fw-medium">@lang('messages.slide.list.fields.canonical')</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">{{ url('/') }}/</span>
                                                            <input type="text"
                                                                value="{{ $canonical }}"
                                                                name="slide[canonical][]" 
                                                                class="form-control"
                                                                placeholder="slide-1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 d-flex align-items-end">
                                                        <div class="form-check form-switch mb-2">
                                                            <input class="form-check-input" {{ $window == '_blank' ? 'checked' : '' }} type="checkbox" name="slide[window][]" id="window_{{ $key }}" value="_blank" role="switch">
                                                            <label class="form-check-label fw-medium" for="window_{{ $key }}">@lang('messages.slide.list.fields.new_tab')</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- SEO Tab -->
                                            <div class="tab-pane fade" id="slide-seo-{{ $key }}" role="tabpanel">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <label class="form-label fw-medium">@lang('messages.slide.list.fields.alt')</label>
                                                        <input type="text"
                                                            value="{{ $name }}"
                                                            name="slide[name][]" 
                                                            class="form-control"
                                                            placeholder="@lang('messages.slide.list.fields.alt_placeholder')">
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label fw-medium">@lang('messages.slide.list.fields.title')</label>
                                                        <input type="text"
                                                            value="{{ $alt }}"
                                                            name="slide[alt][]" 
                                                            class="form-control"
                                                            placeholder="@lang('messages.slide.list.fields.title_placeholder')">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>