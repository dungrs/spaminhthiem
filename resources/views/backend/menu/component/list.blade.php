<div class="col-lg-12">
    <div class="card shadow-sm">
        <a href="#menu-setup-collapse" class="text-dark d-block" data-bs-toggle="collapse" aria-expanded="true">
            <div class="p-4 border-bottom">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar">
                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">{!! $index !!}</div>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="font-size-16 mb-1">@lang('messages.menu.setup.title')</h5>
                        <p class="text-muted mb-0">@lang('messages.menu.setup.description')</p>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                    </div>
                </div>
            </div>
        </a>

        <div id="menu-setup-collapse" class="collapse show">
            <div class="p-4">
                <div id="menuErrorAlert" class="alert alert-danger alert-dismissible fade show mb-4 d-none" role="alert">
                    <i class="mdi mdi-alert-circle-outline me-2"></i>
                    <span id="menuErrorMessage">@lang('messages.menu.errors.general')</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="accordion" id="accordionCustomLink">
                            <div class="accordion-item mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingCustomLink">
                                    <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCustomLink" aria-expanded="true" aria-controls="collapseCustomLink">
                                        @lang('messages.menu.custom_link.title')
                                    </button>
                                </h2>
                                <div id="collapseCustomLink" class="accordion-collapse collapse show" aria-labelledby="headingCustomLink" data-bs-parent="#accordionCustomLink">
                                    <div class="accordion-body">
                                        <div class="alert alert-light bg-light border border-light mb-3">
                                            <p class="mb-2">@lang('messages.menu.custom_link.tips.title')</p>
                                            <ul class="list-unstyled small mb-0">
                                                <li class="mb-1"><i class="mdi mdi-alert-circle-outline text-warning me-1"></i> @lang('messages.menu.custom_link.tips.items.path_working')</li>
                                                <li class="mb-1"><i class="mdi mdi-alert-circle-outline text-warning me-1"></i> @lang('messages.menu.custom_link.tips.items.path_modules')</li>
                                                <li class="mb-1"><i class="mdi mdi-alert-circle-outline text-danger me-1"></i> @lang('messages.menu.custom_link.tips.items.required_fields')</li>
                                                <li><i class="mdi mdi-alert-circle-outline text-info me-1"></i> @lang('messages.menu.custom_link.tips.items.max_levels')</li>
                                            </ul>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-sm add-menu">
                                                <i class="mdi mdi-plus-circle-outline me-1"></i> @lang('messages.menu.custom_link.add_button')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        @foreach (__('module.models') as $key => $value)
                            @php
                                $accordionId = 'menuAccordion';
                                $headingId = 'heading_' . $key;
                                $collapseId = 'collapse_' . $key;
                            @endphp

                            <div class="accordion-item mb-3 shadow-sm">
                                <h2 class="accordion-header" id="{{ $headingId }}">
                                    <button class="accordion-button fw-medium menu-module collapsed" 
                                            data-model="{{ $key }}" 
                                            data-modelParent="{{ $value['modelParent'] }}"
                                            type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#{{ $collapseId }}" 
                                            aria-expanded="false" 
                                            aria-controls="{{ $collapseId }}">
                                        <i class="mdi mdi-folder-outline text-primary me-2"></i>
                                        {{ $value['name'] }}
                                    </button>
                                </h2>
                                <div id="{{ $collapseId }}" 
                                    class="accordion-collapse collapse" 
                                    aria-labelledby="{{ $headingId }}" 
                                    data-bs-parent="#{{ $accordionId }}">
                                    <div class="accordion-body p-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-white">
                                                <i class="mdi mdi-magnify text-muted"></i>
                                            </span>
                                            <input type="text" class="form-control search-menu" placeholder="@lang('messages.menu.module.search_placeholder')">
                                        </div>

                                        <div class="border rounded" style="max-height: 250px; overflow-y: auto;">
                                            <div class="p-2 menu-list">
                                                <div class="text-center py-4 text-muted">
                                                    <i class="mdi mdi-loading mdi-spin fs-4"></i>
                                                    <p class="mt-2 mb-0">@lang('messages.menu.module.loading')</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between mt-3">
                                            <button type="button" class="btn btn-sm btn-outline-secondary btn-reset-menu">
                                                <i class="mdi mdi-refresh me-1"></i> @lang('messages.menu.module.buttons.refresh')
                                            </button>
                                            <button type="button" class="btn btn-sm btn-primary btn-apply-menu">
                                                <i class="mdi mdi-check-all me-1"></i> @lang('messages.menu.module.buttons.apply')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="col-lg-8">
                        <div class="card shadow-sm h-100 mb-0 menu-wrapper">
                            <div class="card-header bg-light p-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-menu text-primary me-2 fs-5"></i>
                                    <h5 class="mb-0 fw-semibold">@lang('messages.menu.management.title')</h5>
                                </div>
                            </div>
                            
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="30%">@lang('messages.menu.management.columns.name')</th>
                                                <th width="40%">@lang('messages.menu.management.columns.path')</th>
                                                <th width="20%">@lang('messages.menu.management.columns.position')</th>
                                                <th width="10%" class="text-end">@lang('messages.menu.management.columns.actions')</th>
                                            </tr>
                                        </thead>
                                        <tbody id="menu-table-body">
                                            @php
                                                $menus = $menuList ?? [];
                                            @endphp
                                            @if (!empty($menus))
                                                @foreach ($menus['name'] ?? [] as $key => $val)
                                                    <tr class="menu-item {{ $menus['canonical'][$key] ?? ''}}">
                                                        <td>
                                                            <input type="text" 
                                                                   class="form-control form-control-sm name" 
                                                                   name="menu[name][{{ $key }}]" 
                                                                   value="{{ $menus['name'][$key] ?? '' }}" 
                                                                   placeholder="@lang('messages.menu.management.name_placeholder')" 
                                                                   required>
                                                            <div class="error-container"></div>
                                                        </td>
                                                        <td>
                                                            <input type="text" 
                                                                   class="form-control form-control-sm canonical" 
                                                                   name="menu[canonical][{{ $key }}]" 
                                                                   value="{{ $menus['canonical'][$key] ?? '' }}"
                                                                   placeholder="@lang('messages.menu.management.canonical_placeholder')" 
                                                                   required>
                                                            <div class="error-container"></div>
                                                        </td>
                                                        <td>
                                                            <input type="text" 
                                                                   class="form-control form-control-sm order" 
                                                                   name="menu[order][{{ $key }}]" 
                                                                   placeholder="@lang('messages.menu.management.order_placeholder')" 
                                                                   value="{{ $menus['order'][$key] ?? 0 }}" 
                                                                   required>
                                                            <div class="error-container"></div>
                                                        </td>
                                                        <td class="text-end">
                                                            <button type="button" class="btn btn-sm btn-outline-danger delete-menu-row">
                                                                <i class="mdi mdi-trash-can-outline"></i>
                                                            </button>
                                                        </td>
                                                        <input type="hidden" name="menu[id][{{ $key }}]" value="{{ $menus['id'][$key] ?? 0 }}">
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div id="menu-empty-state" class="text-center py-5 notification {{ isset($menuList) ? 'hidden' : '' }}">
                                    <div class="avatar-md mx-auto mb-3">
                                        <div class="avatar-title bg-light text-primary rounded-circle fs-2">
                                            <i class="mdi mdi-menu"></i>
                                        </div>
                                    </div>
                                    <h5>@lang('messages.menu.management.empty_state.title')</h5>
                                    <p class="text-muted">@lang('messages.menu.management.empty_state.description')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>