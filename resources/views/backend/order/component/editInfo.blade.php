@php
    $configModal = __('messages.customer.modal');
@endphp
<!-- Modal cập nhật thông tin khách hàng -->
<div class="modal fade bs-example-modal-lg store-modal" id="editCustomerInfo" tabindex="-1" role="dialog" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <form method="post" id="form-info-modal" data-id="{{ $order->first()->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">@lang("messages.order.details.modal.update_customer_info")</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> 
                <div class="modal-body">
                    @include('backend.component.requiredFields')
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="fullname">{{ $configModal['name'] }} <i class="uil uil-exclamation-circle text-danger"></i></label>
                            <input type="text" class="form-control fullname" name="fullname" placeholder="{{ $configModal['name_placeholder'] }}" value="{{ $order->first()->fullname }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="email">{{ $configModal['email'] }} <i class="uil uil-exclamation-circle text-danger"></i></label>
                            <input type="text" class="form-control email" name="email" placeholder="{{ $configModal['email_placeholder'] }}" value="{{ $order->first()->email }}">
                        </div>
                    </div>
                </div>
                @include('backend.component.modalFooter')
            </form>
        </div>
    </div>
</div>