{{-- Start Begin Content --}}
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="" id="form-store-modal" data-method="store" data-id="">
                <div class="row">
                    @include('backend.menu.component.catalogue' , ['index' => '01'])
                    @include('backend.menu.component.list' , ['index' => '02'])
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
@include('backend.menu.component.storeCatalogue')
<script>
    const MenuConfig = {
        messages : {!! json_encode(__('messages.menu.management')) !!},
    };
</script>