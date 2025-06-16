{{-- @php
    $configModal = $configs['seo']['modal']
@endphp
<div class="modal fade translate-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <form method="post" id="form-translate-modal">
                @include('backend.component.modalHeader')
                <div class="modal-body">
                    <div class="alert alert-warning alert-right-border alert-dismissible fade show" role="alert">
                        <i class="uil uil-info-circle font-size-16 text-warning me-2"></i>
                        <strong>{{ __('messages.icon_explanation') }}</strong> <br>
                        <i class="uil uil-check-circle text-success"></i> {{ __('messages.translated') }} | 
                        <i class="uil uil-exclamation-circle text-danger"></i> {{ __('messages.not_translated') }} | 
                        <i class="uil uil-info-circle text-primary"></i> {{ __('messages.cannot_be_empty') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="collapse multi-collapse show" id="language-tabs">
                                <div class="card mb-0">
                                    <div class="card-header">
                                        <h6 class="mb-0">{{ __('messages.original_language') }}</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">{{ $configModal['name'] }}</label> 
                                            <input type="text" class="form-control" id="name_original" value="" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{ $configModal['description'] }}</label>
                                            <input class="form-control" id="description_original" value="" readonly >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                        
                        @if ($availableLanguages)
                        <div class="col-md-6">
                            <div class="collapse multi-collapse show">
                                <div class="card mb-0">
                                    <div class="card-body" style="padding-top: 12px; !important">
                                        <ul class="nav nav-tabs nav-tabs-custom" role="tablist" id="language-tabs">
                                            @foreach ($availableLanguages as $key => $language)
                                                @if ($currentLanguage->canonical == $language->canonical)
                                                    @continue
                                                @endif
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" data-canonical="{{ $language->canonical }}" href="#{{ $language->canonical }}" role="tab">
                                                        <div class="d-flex gap-1">
                                                            <div class="language-name">
                                                                {{ $language->name }} 
                                                            </div>
                                                            <i class="uil uil-exclamation-circle text-danger"></i>
                                                        </div>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content" style="padding-top: 19px;" id="language-tabs-content">
                                            @foreach ($availableLanguages as $language)
                                                @if ($currentLanguage->canonical == $language->canonical)
                                                    @continue
                                                @endif
                                                <div class="tab-pane fade needs-validation" id="{{ $language->canonical }}" role="tabpanel">
                                                    <input type="hidden" name="language_id" value="{{ $language->id }}">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            {{ $configModal['name'] }} 
                                                            <i class="uil uil-info-circle text-primary"></i> ({{ $language->name }})
                                                        </label>
                                                        <input type="text" class="form-control name_trans" name="name_trans" placeholder="{{ $configModal['name_placeholder'] }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            {{ $configModal['description'] }} ({{ $language->name }})
                                                        </label>
                                                        <input type="text" class="form-control description_trans" name="description_trans" placeholder="{{ $configModal['description_placeholder'] }}">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                        @endif
                    </div><!-- end row -->
                </div>
                @include('backend.component.modalFooter')
            </form>
        </div>
    </div>
</div> --}}