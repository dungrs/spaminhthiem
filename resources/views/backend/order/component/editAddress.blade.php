@php
    $configModal = __('messages.customer.modal')
@endphp
<div class="modal fade bs-example-modal-lg store-modal" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <form method="post" id="form-address-modal" data-id="{{ $order->first()->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">@lang("messages.order.details.modal.update_customer_address")</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> 
                <div class="modal-body">
                    @include('backend.component.requiredFields')
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="province">{{ $configModal['city'] }}</label>
                            <select class="form-control rounded location provinces choice-single-location" data-value="{{ $order->first()->province_id }}" data-target="districts" name="province_id">
                                <option value="">{{ $configModal['city'] }}</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->code }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="district">{{ $configModal['district'] }}</label>
                            <select class="form-control rounded location districts choice-single-location" data-value="{{ $order->first()->district_id }}" data-target="wards" name="district_id">
                                <option value="">{{ $configModal['district'] }}</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="ward">{{ $configModal['ward'] }}</label>
                            <select class="form-control rounded wards choice-single-location" data-value="{{ $order->first()->ward_id }}" name="ward_id">
                                <option value="">{{ $configModal['ward'] }}</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="address">{{ $configModal['address'] }} <i class="uil uil-exclamation-circle text-danger"></i></label>
                            <input type="text" class="form-control address" id="address" name="address" placeholder="{{ $configModal['address_placeholder'] }}" value="{{ $order->first()->address }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="description">{{ $configModal['note'] }}</label>
                            <input type="text" class="form-control description" id="description" name="description" placeholder="{{ $configModal['note_placeholder'] }}" value="{{ $order->first()->description }}">
                        </div>
                    </div>
                </div>
                @include('backend.component.modalFooter')
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->