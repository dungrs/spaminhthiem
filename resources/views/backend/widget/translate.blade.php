<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="" id="form-translate">
                <input type="hidden" name="option[id]" value="{{ $option['id'] }}">
                <input type="hidden" name="option[language_id]" value="{{ $option['languageId'] }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="collapse multi-collapse show" id="language-tabs">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h6 class="mb-0">{{ __('messages.original_language') }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="name">
                                            {{ __('messages.title') }} <i class="uil uil-exclamation-circle text-danger"></i>
                                        </label>
                                        <input id="name" name="name" placeholder="{{ __('messages.enter_title') }}" type="text" class="form-control name" value="{{ $widget->name ?? '' }}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="keyword">
                                            {{ __('messages.keyword') }} <i class="uil uil-exclamation-circle text-danger"></i>
                                        </label>
                                        <input id="keyword" name="keyword" placeholder="{{ __('messages.enter_keyword') }}" type="text" class="form-control keyword" value="{{ $widget->keyword ?? '' }}" disabled>
                                    </div>
                                    @include("backend.component.content", ['model' => $widget ?? null, 'disabled' => 1, 'offContent' => true, 'offTitle' => true, "index" => "01"])
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                    
                    @if ($languageOther)
                    <div class="col-md-6">
                        <div class="collapse multi-collapse show">
                            <div class="card mb-0">
                                <div class="card-body" style="padding-top: 12px;">
                                    <!-- Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist" id="language-tabs">
                                        @foreach ($languageOther as $language)
                                            @php
                                                $hasTranslation = $widgetTranslate->contains('language_id', $language->id);
                                            @endphp
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" data-canonical="{{ $language->canonical }}" href="#{{ $language->canonical }}" role="tab">
                                                    <div class="d-flex gap-1 align-items-center">
                                                        <div class="language-name">{{ $language->name }}</div>
                                                        {!! $hasTranslation 
                                                            ? '<i class="uil uil-check-circle text-success"></i>' 
                                                            : '<i class="uil uil-exclamation-circle text-danger"></i>' !!}
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content" style="padding-top: 19px;" id="language-tabs-content">
                                        @foreach ($availableLanguages as $language)
                                            <div class="tab-pane fade needs-validation" id="{{ $language->canonical }}" role="tabpanel">
                                                @php
                                                    $translation = $widgetTranslate->firstWhere('language_id', $language->id);
                                                @endphp
                                                <input type="hidden" name="language_id" value="{{ $language->id }}">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold" for="name_trans">
                                                        {{ __('messages.title') }} <i class="uil uil-exclamation-circle text-danger"></i>
                                                    </label>
                                                    <input id="name_trans" name="name_trans" placeholder="{{ __('messages.enter_title') }}" type="text" class="form-control name_trans" value="{{ $translation->name ?? '' }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold" for="keyword_trans">
                                                        @lang('messages.keyword') <i class="uil uil-exclamation-circle text-danger"></i>
                                                    </label>
                                                    <input id="keyword_trans" name="keyword_trans" placeholder="@lang('messages.enter_keyword')" type="text" class="form-control keyword_trans" value="{{ $translation->keyword ?? '' }}">
                                                </div>
                                                @include("backend.component.contentTranslate", ['model' => $translation, 'offContent' => true, 'offTitle' => true])
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                    @endif
                </div><!-- end row -->
    
                <div class="row mb-4 mt-4">
                    <div class="col text-end">
                        <button type="submit" class="btn btn-success translateButton">
                            <i class="bx bx-file me-1"></i> {{ __('messages.save') }}
                        </button>
                    </div> <!-- end col -->
                </div> <!-- end row-->
            </form>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @include('backend.component.footer')
</div>

<script>
    const WidgetConfig = {
        messages : {!! json_encode(__('messages.widget.content_configuration.search_section.item_template')) !!},
    };
</script>