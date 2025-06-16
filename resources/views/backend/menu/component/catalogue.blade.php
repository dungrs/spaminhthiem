<div class="col-lg-12">
    <div class="card shadow-sm">
        <a href="#menu-position-collapse" class="text-dark d-block" data-bs-toggle="collapse" aria-expanded="true">
            <div class="p-4 border-bottom">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar">
                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">{!! $index !!}</div>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="font-size-16 mb-1">@lang('messages.menu.position.title')</h5>
                        <p class="text-muted mb-0">@lang('messages.menu.position.description')</p>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                    </div>
                </div>
            </div>
        </a>

        <div id="menu-position-collapse" class="collapse show">
            <div class="p-4">
                <div class="mb-3">
                    <div class="menu_catalogue_id">
                        <label class="form-label fw-semibold">
                            @lang('messages.menu.position.label') 
                            <i class="uil uil-exclamation-circle text-danger"></i>
                        </label>
                        <select name="menu_catalogue_id" class="form-control rounded choice-single">
                            <option value="">@lang('messages.menu.position.placeholder')</option>
                            @if (isset($menuCatalogues) && count($menuCatalogues) > 0)
                                @foreach ($menuCatalogues as $menuCatalogue)
                                    <option {{ isset($menu->menu_catalogue_id) && $menuCatalogue->id == $menu->menu_catalogue_id ? 'selected' : '' }} value="{{ $menuCatalogue->id }}">{{ $menuCatalogue->name }}</option>
                                @endforeach                                                
                            @endif
                        </select>
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#menuPositionModal">
                        <i class="mdi mdi-plus me-1"></i> @lang('messages.menu.position.create_button')
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>