<div class="modal fade bs-example-modal-lg store-modal" id="editStatusPaymentModal" tabindex="-1" role="dialog" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <form method="post" id="form-status-modal" data-id="{{ $order->first()->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">@lang("messages.order.details.modal.update_invoice_status")</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> 
                <div class="modal-body">
                    <div class="row">
                        @foreach (__('cart') as $key => $val)
                            <div class="mb-3 col-md-12">
                                <label for="{{ $key }}" class="d-flex align-items-center gap-2">
                                    <i class="{{ $val['icon'] }}"></i>
                                    <span>{{ $val['label'] }}</span>
                                </label>
                                <select name="{{ $key }}" class="form-control rounded choice-single" id="{{ $key }}">
                                    @foreach ($val['data'] as $index => $item)
                                        <option value="{{ $index }}" {{ $order->first()->{$key} === $index || $index === 'none' ? 'selected' : '' }}>
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                </select> 
                            </div>
                        @endforeach
                        @foreach ($quantityByRowId as $rowId => $quantity)
                            <input type="hidden" name="quantity_rowId[{{ $rowId }}]" value="{{ $quantity }}">
                        @endforeach
                        <input type="hidden" name="order_id" value="{{ $order->first()->id }}">
                    </div>
                </div>
                @include('backend.component.modalFooter')
            </form>
        </div>
    </div>
</div>