{{-- Start Begin Content --}}
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if ($availableLanguages)
                <div class="row">
                    <div class="col-12">
                        <!-- Main Content Area -->
                        <div class="card border-0 shadow-sm overflow-hidden">
                            <div class="card-header bg-light">
                                <div class="d-flex justify-content-between align-items-center py-2">
                                    <div>
                                        <h5 class="card-title mb-0 d-flex align-items-center">
                                            <i class="mdi mdi-menu mdi-20px text-primary me-2"></i>
                                            <span class="fw-semibold">{{ $menuCatalogue->first()->name }}</span>
                                        </h5>
                                    </div>
                                    <div>
                                        <a 
                                            class="btn btn-sm btn-outline-primary me-2" 
                                            href="{{ route('menu.translate', [ 
                                                'id' => $menuCatalogue instanceof \Illuminate\Support\Collection 
                                                    ? ($menuCatalogue->firstWhere('menu_catalogue_id')?->menu_catalogue_id ?? '') 
                                                    : ($menuCatalogue->id ?? ''), 
                                                'language_id' => $languageId 
                                            ]) }}"
                                        >
                                            <i class="mdi mdi-translate me-1"></i> @lang('messages.menu.auto_translate')
                                        </a>

                                        <a href="{{ route('menu.editMenu', $menuCatalogue instanceof \Illuminate\Support\Collection ? ($menuCatalogue->firstWhere('menu_catalogue_id')?->menu_catalogue_id ?? '') : ($menuCatalogue->id ?? '')) }}" class="btn btn-sm btn-primary">
                                            <i class="mdi mdi-plus-circle-outline me-1"></i> @lang('messages.menu.update_level1_menu')
                                        </a>
                                        <button class="btn btn-sm btn-outline-secondary ms-2" data-bs-toggle="collapse" data-bs-target="#menuHelp">
                                            <i class="mdi mdi-help-circle-outline"></i>
                                        </button>
                                    </div>
                                </div>

                                
                                <!-- Help section (collapsible) -->
                                <div class="collapse mt-3" id="menuHelp">
                                    <div class="alert alert-light border-0 bg-soft-primary rounded-3">
                                        <div class="d-flex align-items-start">
                                            <div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="mdi mdi-information-outline text-primary fs-4 mt-1 me-3"></i>
                                                    <h6 class="text-primary fw-semibold mb-0">@lang('messages.menu.quick_guide')</h6>
                                                </div>
                                                <div class="row g-3">
                                                    <!-- Cập nhật menu -->
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-start p-3 bg-white rounded-2 border border-light">
                                                            <i class="mdi mdi-pencil-outline text-primary fs-5 mt-1 me-3"></i>
                                                            <div>
                                                                <h6 class="mb-1 fw-medium">@lang('messages.menu.update_menu')</h6>
                                                                <p class="small text-muted mb-0">@lang('messages.menu.update_menu_description')</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Kéo thả sắp xếp -->
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-start p-3 bg-white rounded-2 border border-light">
                                                            <i class="mdi mdi-swap-horizontal text-info fs-5 mt-1 me-3"></i>
                                                            <div>
                                                                <h6 class="mb-1 fw-medium">@lang('messages.menu.sort_menu')</h6>
                                                                <p class="small text-muted mb-0">@lang('messages.menu.sort_menu_description')</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Thêm menu con -->
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-start p-3 bg-white rounded-2 border border-light">
                                                            <i class="mdi mdi-plus-circle-outline text-success fs-5 mt-1 me-3"></i>
                                                            <div>
                                                                <h6 class="mb-1 fw-medium">@lang('messages.menu.manage_submenu')</h6>
                                                                <p class="small text-muted mb-0">@lang('messages.menu.manage_submenu_description')</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Cấu trúc đa cấp -->
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-start p-3 bg-white rounded-2 border border-light">
                                                            <i class="mdi mdi-file-tree text-warning fs-5 mt-1 me-3"></i>
                                                            <div>
                                                                <h6 class="mb-1 fw-medium">@lang('messages.menu.multi_level_menu')</h6>
                                                                <p class="small text-muted mb-0">@lang('messages.menu.multi_level_menu_description')</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body p-4 border-top">
                                <div class="card border-0 shadow-none">
                                    <div class="card-body p-0">
                                        @if (count($menuList))
                                            <div class="dd" id="nestable2" data-menuCatalogueId="{{ $menuCatalogue instanceof \Illuminate\Support\Collection ? ($menuCatalogue->firstWhere('menu_catalogue_id')?->menu_catalogue_id ?? '') : ($menuCatalogue->id ?? '') }}">
                                                {!! backendRecursiveMenu($menuList, $menuCatalogue) !!}
                                            </div>
                                        @endif
                                        
                                        <textarea id="nestable2-output" class="form-control mt-2 d-none" style="min-height: 150px;"></textarea>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->
            @endif
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @include('backend.component.footer')
</div>