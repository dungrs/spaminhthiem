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
                                <label for="keyword">
                                    {{ $configModal['keyword'] }} <i class="uil uil-exclamation-circle text-danger"></i>
                                </label>
                                <input type="text" class="form-control keyword" name="keyword" placeholder="{{ $configModal['keyword_placeholder'] }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description">{{ $configModal['description'] }}</label>
                                <textarea class="form-control description" name="description" placeholder="{{ $configModal['description_placeholder'] }}"></textarea>
                            </div>
                        </div>
                    </div>
                    @include('backend.component.modalFooter')
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div><!-- end card body -->
