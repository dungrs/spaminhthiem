{{-- Start Begin Content --}}
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="" id="form-store-modal" data-language-id="{{ isset($attributeCatalogue) ? $attributeCatalogue->language_id : '' }}" data-id="{{ isset($attributeCatalogue) ? $attributeCatalogue->id : '' }}">
                <div class="row">
                    <div class="col-lg-9">
                        <div id="addattribute-accordion" class="custom-accordion">
                            @include("backend.component.content", ['model' => $attributeCatalogue ?? null, 'index' => "01"])
                            @include("backend.component.seo", ['model' => $attributeCatalogue ?? null, 'index' => "02"])
                        </div>
                    </div>
                    <div class="col-lg-3">
                        @include("backend.attribute.catalogue.component.aside", ['model' => $attributeCatalogue ?? null])
                    </div>
                </div>
                <!-- end row -->
    
                <div class="row mb-4">
                    <div class="col text-end">
                        <button type="submit" class="btn btn-success submitButton">
                            <i class="bx bx-file me-1"></i> {{ __('messages.save') }}
                        </button>
                    </div> <!-- end col -->
                </div> <!-- end row-->
                <!-- end row -->
            </form>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @include('backend.component.footer')
</div>
{{-- End Begin Content --}}