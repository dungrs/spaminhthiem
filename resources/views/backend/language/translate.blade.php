<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="" id="form-translate">
                <input type="hidden" name="option[id]" value="{{ $option['id'] }}">
                <input type="hidden" name="option[language_id]" value="{{ $option['languageId'] }}">
                <input type="hidden" name="option[model]" value="{{ $option['model'] }}">
                <input type="hidden" name="option[modelParent]" value="{{ $option['modelParent'] }}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="collapse multi-collapse show" id="language-tabs">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h6 class="mb-0">{{ __('messages.original_language') }}</h6>
                                </div>
                                <div class="card-body">
                                    @include("backend.component.content", ['model' => $object ?? null, 'disabled' => 1, "index" => "01"])
                                    @include("backend.component.seo", ['model' => $object ?? null, 'disabled' => 1, "index" => "02"])
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
                                                $hasTranslation = $objectTranslate->contains('language_id', $language->id);
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
                                                    $translation = $objectTranslate->firstWhere('language_id', $language->id);
                                                @endphp
                                                <input type="hidden" name="language_id" value="{{ $language->id }}">
                                                @include("backend.component.contentTranslate", ['model' => $translation])
                                                @include("backend.component.seoTranslate", ['model' => $translation])
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
                        <button type="submit" class="btn btn-success submitButton">
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