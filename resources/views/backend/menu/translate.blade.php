<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="" id="form-translate">
                <div class="row">
                    <div class="col-md-6">
                        <div class="collapse multi-collapse show" id="language-tabs">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h6 class="mb-0">@lang('messages.original_language')</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($menuBuildItem as $menu)
                                        <div class="col-md-12 mb-4">
                                            <div class="card pt-2 shadow-sm">
                                                <div class="card-header bg-light py-2">
                                                    <h6 class="mb-0 fw-semibold">
                                                        <i class="mdi mdi-menu me-2 text-primary"></i>
                                                        @lang('messages.menu.translate.item', ['number' => $loop->iteration])
                                                    </h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        <!-- Tên menu -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="" class="form-label fw-medium">
                                                                    <i class="mdi mdi-form-textbox me-1 text-muted"></i>
                                                                    @lang('messages.menu.translate.name')
                                                                </label>
                                                                <input type="text" 
                                                                       id="" 
                                                                       value="{{ $menu->name }}" 
                                                                       class="form-control" 
                                                                       placeholder="@lang('messages.menu.translate.name_placeholder')" disabled>
                                                                <small class="text-muted">@lang('messages.menu.translate.name_helper')</small>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Đường dẫn -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="" class="form-label fw-medium">
                                                                    <i class="mdi mdi-link me-1 text-muted"></i>
                                                                    @lang('messages.menu.translate.link')
                                                                </label>
                                                                <input type="text" 
                                                                       id="" 
                                                                       value="{{ $menu->canonical }}" 
                                                                       class="form-control" 
                                                                       placeholder="@lang('messages.menu.translate.link_placeholder')" disabled>
                                                                <small class="text-muted">@lang('messages.menu.translate.link_helper')</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <!-- Phần còn lại của code giữ nguyên -->
                    <div class="col-md-6">
                        <div class="collapse multi-collapse show">
                            <div class="card mb-0">
                                <div class="card-body" style="padding-top: 12px;">
                                    <!-- Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist" id="language-tabs">
                                        @foreach ($availableLanguages as $language)
                                            @if ($menuBuildItem[0]->language_id == $language->id)
                                                @continue
                                            @endif
                                            <li class="nav-item">
                                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" 
                                                data-bs-toggle="tab" 
                                                href="#lang-{{ $language->id }}" 
                                                role="tab">
                                                    <div class="d-flex gap-1 align-items-center">
                                                        <div class="language-name">{{ $language->name }}</div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content" style="padding-top: 20px;" id="language-tabs-content">
                                        @php
                                            $groupedTranslations = groupTranslationsByLanguage($menuBuildItem, $availableLanguages);
                                        @endphp
                                        
                                        @foreach ($groupedTranslations as $languageId => $translations)
                                            @if ($languageId == $menuBuildItem[0]->language_id)
                                                @continue
                                            @endif
                                            
                                            @php
                                                $currentLanguage = $availableLanguages->firstWhere('id', $languageId);
                                            @endphp
                                            
                                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="lang-{{ $languageId }}" role="tabpanel">
                                                <div class="row">
                                                    @foreach ($translations as $menu)
                                                    <div class="col-md-12 mb-4">
                                                        <div class="card pt-2 shadow-sm">
                                                            <div class="card-header bg-light py-2">
                                                                <h6 class="mb-0 fw-semibold">
                                                                    <i class="mdi mdi-menu me-2 text-primary"></i>
                                                                    @lang('messages.menu.translate.item', ['number' => $loop->iteration])
                                                                </h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row g-3">
                                                                    <input type="hidden" name="translate[{{ $languageId }}][{{ $menu['menu_id'] }}][language_id]" value="{{ $languageId }}">
                                                                    <input type="hidden" name="translate[{{ $languageId }}][{{ $menu['menu_id'] }}][menu_id]" value="{{ $menu['menu_id'] }}">
                                                                    
                                                                    <!-- Tên menu -->
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label fw-medium">
                                                                                <i class="mdi mdi-form-textbox me-1 text-muted"></i>
                                                                                @lang('messages.menu.translate.name')
                                                                            </label>
                                                                            <input type="text" 
                                                                                class="form-control" 
                                                                                name="translate[{{ $languageId }}][{{ $menu['menu_id'] }}][name]"
                                                                                value="{{ $menu['name'] ?? '' }}"
                                                                                placeholder="@lang('messages.menu.translate.name_placeholder')">
                                                                            <small class="text-muted">@lang('messages.menu.translate.name_helper')</small>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <!-- Đường dẫn -->
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label fw-medium">
                                                                                <i class="mdi mdi-link me-1 text-muted"></i>
                                                                                @lang('messages.menu.translate.link')
                                                                            </label>
                                                                            <input type="text" 
                                                                                class="form-control" 
                                                                                name="translate[{{ $languageId }}][{{ $menu['menu_id'] }}][canonical]"
                                                                                value="{{ $menu['canonical'] ?? '' }}"
                                                                                placeholder="@lang('messages.menu.translate.link_placeholder')">
                                                                            <small class="text-muted">@lang('messages.menu.translate.link_helper')</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
    
                <div class="row mb-4 mt-4">
                    <div class="col text-end">
                        <button type="submit" class="btn btn-success save-translations">
                            <i class="bx bx-file me-1"></i> @lang('messages.save')
                        </button>
                    </div> <!-- end col -->
                </div> <!-- end row-->
            </form>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @include('backend.component.footer')
</div>