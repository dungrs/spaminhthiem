@php
    $configModal = $configs['seo']['modal']
@endphp
<div class="modal fade bs-example-modal-lg store-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="post" id="form-store-modal">
                @include('backend.component.modalHeader')
                <div class="modal-body">
                    @include('backend.component.requiredFields')
                    <div class="row">
                        <input type="hidden" id="form-mode" name="form_mode" value="">
                        <div class="col-md-12 mb-3">
                            <label for="name">{{ $configModal['name'] }} <i class="uil uil-exclamation-circle text-danger"></i></label>
                            <input type="text" class="form-control name" name="name" placeholder="{{ $configModal['name_placeholder'] }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="email">{{ $configModal['canonical'] }} <i class="uil uil-exclamation-circle text-danger"></i></label>
                            <input type="text" class="form-control canonical" name="canonical" placeholder="{{ $configModal['canonical_placeholder'] }}">
                        </div>
                    </div>
                @include('backend.component.modalFooter')
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->