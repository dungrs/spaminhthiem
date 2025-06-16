{{-- Start Begin Content --}}
@php
    $method = ($configs['method'] == 'create') ? 'store' : 
    ($configs['method'] == 'children' ? 'saveChildren' : 'update')
@endphp
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form method="post" id="form-store-modal" data-method="{{ $method }}" data-id="{{ $menu->first()->id }}">
                <div class="row">
                    @include('backend.menu.component.list', ['index' => "01"])
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
<script>
    const MenuConfig = {
        messages : {!! json_encode(__('messages.menu.management')) !!},
    };
</script>
{{-- End Begin Content --}}