@php
    $configModal = $configs['seo']['modal']
@endphp
<div class="card-body">
    <div class="modal fade bs-example-modal-center modal store-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" class="needs-validation" id="form-store-modal">
                    @include('backend.component.modalHeader')
                    <div class="modal-body">
                        @include('backend.component.requiredFields')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name">
                                    {{ $configModal['name'] }} <i class="uil uil-exclamation-circle text-danger"></i>
                                </label>
                                <input type="text" class="form-control name" name="name" placeholder="{{ $configModal['name_placeholder'] }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="phone">
                                    {{ $configModal['phone'] }} <i class="uil uil-exclamation-circle text-danger"></i>
                                </label>
                                <input type="text" class="form-control phone" name="phone" placeholder="{{ $configModal['phone_placeholder'] }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="email">
                                    {{ $configModal['email'] }} <i class="uil uil-exclamation-circle text-danger"></i>
                                </label>
                                <input type="text" class="form-control email" name="email" placeholder="{{ $configModal['email_placeholder'] }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description">{{ $configModal['description'] }}</label>
                                <input type="text" class="form-control description" name="description" placeholder="{{ $configModal['description_placeholder'] }}">
                            </div>
                            <div class="col-md-12 mb-3">
                        </div>
                    </div>
                    @include('backend.component.modalFooter')
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div><!-- end card body -->
