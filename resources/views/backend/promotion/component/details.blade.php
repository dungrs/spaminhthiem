<div id="add-details-accordion" class="custom-accordion">
    <div class="card shadow-sm">
        <a href="#add-details-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true">
            <div class="p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar">
                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">02</div>
                        </div>
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="font-size-16 mb-1">@lang('messages.promotion.details.title')</h5>
                        <p class="text-muted text-truncate mb-0">@lang('messages.promotion.details.description')</p>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                    </div>
                </div>
            </div>
        </a>

        @php
            $promotionMethod = $promotion->method ?? null;
        @endphp
    
        <div id="add-details-collapse" class="collapse show">
            <div class="p-4 border-top">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="method" class="form-label fw-semibold">@lang('messages.promotion.details.method_label')</label>
                        <select name="method" class="form-control rounded choice-single promotionMethod">
                            <option value="">@lang('messages.promotion.details.method_placeholder')</option>
                            @foreach (__('module.promotion') as $key => $val)
                                <option 
                                value="{{ $key }}"
                                {{ $promotionMethod === $key ? 'selected' : '' }} 
                                >{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mb-3 promotion-container">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>