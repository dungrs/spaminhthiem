@php
    $seoTables = $configs['seo']['permission']['table'];
    $seoTableHeaders = $configs['seo']['permission']['table']['table_header'];
@endphp
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route("user.catalogue.updatePermission") }}">
                        <div class="card">
                            @include('backend.user.catalogue.component.cardHeader', ['permission' => true])
                            <div class="card-body">
                                @include('backend.user.catalogue.component.filter', ['permission' => true])
                                <div class="table-responsive">
                                    <table class="table align-middle table-bordered" style="min-width: 1200px;">
                                        <thead class="align-middle">
                                            <tr>
                                                <th class="min-width-300">{{ $seoTableHeaders['name'] }}</th>
                                                @foreach ($userCatalogues as $userCatalogue)
                                                    <th class="text-center min-width-200">{{ $userCatalogue->name }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody class="data-table">
                                            @foreach ($permissions as $permission)
                                                <tr class="align-middle">
                                                    <td class="px-3 py-2">
                                                        <div class="d-flex flex-column gap-1">
                                                            <span class="fw-semibold text-dark">{{ $permission->name }}</span>
                                                            <span class="text-primary rounded">({{ $permission->canonical }})</span>
                                                        </div>
                                                    </td>
                                                    @foreach ($userCatalogues as $userCatalogue)
                                                    <td class="align-middle text-center">
                                                        <div class="form-check d-flex justify-content-center">
                                                            <input 
                                                                class="form-check-input checkbox-permission" 
                                                                type="checkbox" 
                                                                value="{{ $permission->id }}" 
                                                                name="permissions[{{ $userCatalogue->id }}][]" 
                                                                id="permissionCheck-{{ $userCatalogue->id }}-{{ $permission->id }}"
                                                                {{ $userCatalogue->permissions->contains($permission->id) ? 'checked' : '' }}
                                                            >
                                                            <label class="form-check-label" for="permissionCheck-{{ $userCatalogue->id }}-{{ $permission->id }}"></label>
                                                        </div>
                                                    </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col text-end">
                                <button type="submit" class="btn btn-success submitButton">
                                    <i class="bx bx-file me-1"></i> {{ __('messages.save') }}
                                </button>
                            </div> <!-- end col -->
                        </div> <!-- end row-->
                    </form>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @include('backend.component.footer')
</div>