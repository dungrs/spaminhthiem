@php
    $applyData = __('module.applyStatus');
    $applyDataFormatted = [];
    foreach($applyData as $key => $value) {
        $applyDataFormatted[] = [
            'id' => $key,
            'name' => $value,
        ];
    }
@endphp

<div class="card shadow-sm">
    <a href="#add-time-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">03</div>
                    </div>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <h5 class="font-size-16 mb-1">@lang('messages.promotion.aside.time.title')</h5>
                    <p class="text-muted text-truncate mb-0">@lang('messages.promotion.aside.time.description')</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                </div>
            </div>
        </div>
    </a>

    <div id="add-time-collapse" class="collapse show">
        <div class="p-4 border-top">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label fw-semibold">@lang('messages.promotion.aside.time.start_date') <i class="uil uil-exclamation-circle text-danger"></i></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        <input type="text" 
                               class="form-control datepicker-start start_date" 
                               name="start_date" 
                               placeholder="DD/MM/YYYY" 
                               value="{{ formatDateTime($model->start_date ?? '') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">@lang('messages.promotion.aside.time.end_date') <i class="uil uil-exclamation-circle text-danger"></i></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        <input type="text" 
                               class="form-control datepicker-end end_date" 
                               name="end_date" 
                               placeholder="DD/MM/YYYY" 
                               value="{{ formatDateTime($model->end_date ?? '') }}">
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="never_end_date" name="never_end_date" value="accept" role="switch" @checked(old('never_end_date', $model->never_end_date ?? null) == 'accept')>
                        <label class="form-check-label fw-medium" for="never_end_date">@lang('messages.promotion.aside.time.never_end')</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <a href="#add-source-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">04</div>
                    </div>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <h5 class="font-size-16 mb-1">@lang('messages.promotion.aside.source.title')</h5>
                    <p class="text-muted text-truncate mb-0">@lang('messages.promotion.aside.source.description')</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                </div>
            </div>
        </div>
    </a>

    @php
        $sourceStatus = old('source', $model->discount_information['source']['status'] ?? null)
    @endphp

    <div id="add-source-collapse" class="collapse show">
        <div class="p-4 border-top choose-source-container">
            <div class="mb-4">
                <h6 class="fw-semibold mb-3">@lang('messages.promotion.aside.source.scope')</h6>
                <div class="list-group list-group-flush">
                    <label class="list-group-item list-group-item-action rounded p-3 mb-2 border">
                        <div class="form-check d-flex align-items-center mb-0">
                            <input class="form-check-input me-3 chooseSource" type="radio" value="all" id="allSource" name="source" value="all" {{ $sourceStatus === 'all' || !$sourceStatus ? 'checked' : '' }} >
                            <div>
                                <span class="d-block fw-medium">@lang('messages.promotion.aside.source.all_channels')</span>
                                <small class="text-muted">@lang('messages.promotion.aside.source.all_channels_desc')</small>
                            </div>
                        </div>
                    </label>
                    <label class="list-group-item list-group-item-action rounded p-3 border">
                        <div class="form-check d-flex align-items-center mb-0">
                            <input class="form-check-input me-3 chooseSource" type="radio" value="choose" id="chooseSource" name="source" value="choose" {{ $sourceStatus === 'choose' ? 'checked' : '' }} >
                            <div>
                                <span class="d-block fw-medium">@lang('messages.promotion.aside.source.specific_channels')</span>
                                <small class="text-muted">@lang('messages.promotion.aside.source.specific_channels_desc')</small>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
            @if ($sourceStatus === 'choose')
                <div class="mb-3 select-source-wrapper">
                    <label class="form-label fw-semibold">@lang('messages.promotion.aside.source.select_channels')</label>
                    <select name="sourceValue[]" id="sourceSelect" class="form-select choice-multi" multiple>
                        <option value="">@lang('messages.promotion.aside.source.select_channels_placeholder')</option>
                        @foreach ($sources as $source)
                            <option 
                                value="{{ $source->id }}" 
                                {{ in_array($source->id, old('sourceValue', $model->discount_information['source']['data'] ?? [])) ? 'selected' : '' }}
                            >
                                {{ $source->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <a href="#add-object-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">05</div>
                    </div>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <h5 class="font-size-16 mb-1">@lang('messages.promotion.aside.object.title')</h5>
                    <p class="text-muted text-truncate mb-0">@lang('messages.promotion.aside.object.description')</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                </div>
            </div>
        </div>
    </a>

    @php
        $applyStatus = old('apply', $model->discount_information['apply']['status'] ?? null);
        $applyData = __('module.applyStatus');
        $applyDataFormatted = [];
        foreach ($applyData as $key => $value) {
            $applyDataFormatted[] = ['id' => $key, 'name' => $value];
        }
    @endphp

    <div id="add-object-collapse" class="collapse show">
        <div class="p-4 border-top">
            <div class="mb-4">
                <h6 class="fw-semibold mb-3">@lang('messages.promotion.aside.object.scope')</h6>
                <div class="list-group list-group-flush choose-source-container">
                    <label class="list-group-item list-group-item-action rounded p-3 mb-2 border">
                        <div class="form-check d-flex align-items-center mb-0">
                            <input class="form-check-input me-3 chooseApply" id="allApply" type="radio" name="apply" value="all" {{ $applyStatus === 'all' || !$applyStatus ? 'checked' : '' }}>
                            <div>
                                <span class="d-block fw-medium">@lang('messages.promotion.aside.object.all_customers')</span>
                                <small class="text-muted">@lang('messages.promotion.aside.object.all_customers_desc')</small>
                            </div>
                        </div>
                    </label>
                    <label class="list-group-item list-group-item-action rounded p-3 mb-2 border">
                        <div class="form-check d-flex align-items-center mb-0">
                            <input class="form-check-input me-3 chooseApply" id="chooseApply" type="radio" name="apply" value="choose" {{ $applyStatus === 'choose' ? 'checked' : '' }}>
                            <div>
                                <span class="d-block fw-medium">@lang('messages.promotion.aside.object.customer_groups')</span>
                                <small class="text-muted">@lang('messages.promotion.aside.object.customer_groups_desc')</small>
                            </div>
                        </div>
                    </label>
            
                    @if($applyStatus === 'choose')
                        <div class="mt-3 mb-1 select-apply-wrapper">
                            <label for="applyValue[]">@lang('messages.promotion.aside.object.select_groups')</label>
                            <select name="applyValue[]" id="applySelect" class="choice-multi-condition conditionItem" multiple>
                                <option value="">@lang('messages.promotion.aside.object.select_groups_placeholder')</option>
                                @foreach (__('module.applyStatus') as $key => $val)
                                    <option 
                                        value="{{ $key }}" 
                                        {{ in_array($key, old('applyValue', $model->discount_information['apply']['data'] ?? [])) ? 'selected' : '' }}
                                    >{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
            </div>
                    
            <div class="row wrapper-condition">
                <hr>

                @if ($applyStatus === 'choose')
                    @foreach (old('applyValue', $model->discount_information['apply']['data'] ?? []) as $val)
                        <div class="col-md-12 wrapper-condition-item {{ $val }} mb-3" data-value="{{ $val }}">
                            <label class="form-label fw-semibold">{{ $applyData[$val] ?? '' }}</label>
                            <select name="{{ $val }}[]" class="form-select choice-multi" multiple>
                                <option value="">{{ $applyData[$val] ?? '' }}</option>
                                @foreach ($promotionValue[$val] ?? [] as $item)
                                    <option value="{{ $item['id'] }}" {{ in_array($item['id'], old($val, $model->discount_information['apply']['condition'][$val] ?? [])) ? 'selected' : '' }}>
                                        {{ $item['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    let applyData = @json($applyDataFormatted);
</script>