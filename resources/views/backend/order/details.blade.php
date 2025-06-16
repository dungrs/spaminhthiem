{{-- Start Begin Content --}}
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Customer Summary Cards -->
            <div class="row g-4 mb-4">
                <!-- Order Code -->
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-info bg-opacity-10 text-info p-3 rounded-circle me-3">
                                <i class="fas fa-box fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">@lang('messages.order.details.order_code')</h6>
                                <p class="mb-0 text-dark">#{{ $order->first()->code }}</p>
                                <small class="text-muted">{{ $order->first()->created_at->format(__('messages.order.date_format')) }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Customer Info -->
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow h-100 position-relative">
                        <button type="button" class="btn btn-sm btn-outline-primary border-0 position-absolute top-0 end-0 m-2" data-bs-toggle="modal" data-bs-target="#editCustomerInfo">
                            <i class="fas fa-edit"></i> @lang('messages.order.details.edit')
                        </button>

                        <div class="card-body d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle me-3">
                                <i class="fas fa-user fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">@lang('messages.order.details.customer')</h6>
                                <p class="mb-0 text-dark customer-name">{{ $order->first()->fullname }}</p>
                                <small class="text-muted customer-email">{{ $order->first()->email }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow h-100 position-relative">
                        <button class="btn btn-sm btn-outline-success border-0 position-absolute top-0 end-0 m-2" data-bs-toggle="modal" data-bs-target="#editAddressModal">
                            <i class="fas fa-edit"></i> @lang('messages.order.details.edit')
                        </button>

                        <div class="card-body d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 text-success p-3 rounded-circle me-3">
                                <i class="fas fa-map-marker-alt fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">@lang('messages.order.details.shipping_address')</h6>
                                <p class="mb-0 text-dark customer-address">{{ Str::limit($order->first()->address ?? '', 20) }}</p>
                                <small class="text-muted customer-location">{{ $order->first()->ward_name }}, {{ $order->first()->district_name }}, {{ $order->first()->province_name }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-circle me-3">
                                <i class="fas fa-credit-card fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">@lang('messages.order.details.payment_method')</h6>
                                <p class="mb-0 text-dark">{{ array_column(__('checkout.method'), 'label', 'name')[$order->first()->method] }}</p>
                                <small class="text-muted">xxxx xxxx xxxx 1501</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-8">
                    <!-- Order Items -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-semibold mb-0">@lang('messages.order.details.order_items')</h5>
                                <span class="badge bg-light text-dark">@lang('messages.order.details.products_count', ['count' => $order->count()])</span>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 500px">@lang('messages.order.details.product')</th>
                                            <th class="text-end">@lang('messages.order.details.price')</th>
                                            <th class="text-end">@lang('messages.order.details.quantity')</th>
                                            <th class="text-end">@lang('messages.order.details.total')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->first()->cart['details'] as $item)
                                            <tr>
                                                <td>
                                                    <div>
                                                        <h6 class="mb-1 fw-semibold">{{ $item['name'] }}</h6>
                                                        @foreach ($item['options']['attributes'] as $attribute)
                                                            <small class="text-muted">{{ $attribute['attribute_catalogue_name'] }}: {{ $attribute['attribute_name'] }}</small>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="text-end">{{ convert_price($item['price']) }}</td>
                                                <td class="text-end">{{ $item['qty'] }}</td>
                                                <td class="text-end fw-semibold">{{ convert_price($item['subtotal']) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-semibold mb-3">@lang('messages.order.details.order_summary')</h5>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <td class="border-0 ps-0 py-1">@lang('messages.order.details.subtotal')</td>
                                            <td class="border-0 pe-0 py-1 text-end">{{ convert_price($order->first()->cart['cartTotal']) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0 ps-0 py-1">@lang('messages.order.details.discount')</td>
                                            <td class="border-0 pe-0 py-1 text-end text-success">-{{ convert_price($order->first()->promotion['discount']) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0 ps-0 py-1">@lang('messages.order.details.shipping_fee')</td>
                                            <td class="border-0 pe-0 py-1 text-end">{{ convert_price(0) }}</td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="border-0 ps-0 pt-3 fw-semibold">@lang('messages.order.details.grand_total')</td>
                                            <td class="border-0 pe-0 pt-3 fw-semibold text-end">{{ convert_price($order->first()->cart['cartTotal'] - $order->first()->promotion['discount']) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Order Timeline -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-semibold mb-0">@lang('messages.order.details.order_status')</h5>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editStatusPaymentModal">
                                    <i class="fas fa-download me-1"></i> @lang('messages.order.details.download_invoice')
                                </button>
                            </div>
                    
                            <div class="vstack gap-3">
                                <!-- Confirm Status -->
                                <div class="d-flex">
                                    <div class="me-3">
                                        <div class="icon-invoice-sm rounded-circle bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center">
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-semibold confirm-status">@lang('messages.order.details.confirm_status'): {{ __('cart.confirm.data')[$order->first()->confirm] }}</h6>
                                        <p class="text-muted small mb-0">02 Tháng 11, 2025</p>
                                    </div>
                                </div>
                    
                                <!-- Payment Status -->
                                <div class="d-flex">
                                    <div class="me-3">
                                        <div class="icon-invoice-sm rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-semibold payment-status">@lang('messages.order.details.payment_status'): {{ array_column(__('checkout.payment'), 'label', 'name')[$order->first()->payment] }}</h6>
                                        <p class="text-muted small mb-0">02 Tháng 11, 2025</p>
                                    </div>
                                </div>
                    
                                <!-- Delivery Status -->
                                <div class="d-flex">
                                    <div class="me-3">
                                        <div class="icon-invoice-sm rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center">
                                            <i class="fas fa-truck"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-semibold delivery-status">@lang('messages.order.details.delivery_status'): {{ __('cart.delivery.data')[$order->first()->delivery] }}</h6>
                                        <p class="text-muted small mb-0">09 Tháng 11, 2025</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <!-- Shipping Info -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-semibold mb-0">@lang('messages.order.details.shipping_details')</h5>
                                <a href="#" class="text-primary small">@lang('messages.order.details.track_order')</a>
                            </div>
                            
                            <div class="d-flex align-items-start mb-3">
                                <div class="me-3">
                                    <div class="icon-invoice-sm method-shipping-icon rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center">
                                        <i class="{{ array_column(__('checkout.shipping'), 'icon', 'name')[$order->first()->method_shipping] }}"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold shipping-method">{{ array_column(__('checkout.shipping'), 'label', 'name')[$order->first()->method_shipping] }}</h6>
                                    <p class="text-muted small mb-1">@lang('messages.order.details.shipping_number'): EDTW1400457854</p>
                                    <p class="text-muted small mb-0">@lang('messages.order.details.estimated_delivery'): 11 Tháng 11, 2025</p>
                                </div>
                            </div>
                            
                            <div class="border-top pt-3">
                                <h6 class="fw-semibold small mb-2">@lang('messages.order.details.documents')</h6>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted small">@lang('messages.order.details.invoice_number')</span>
                                    <a href="#" class="small">#TWI154203</a>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted small">@lang('messages.order.details.shipping_number')</span>
                                    <a href="#" class="small">#TWS987102301</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.component.footer')
</div>
@include('backend.order.component.editInfo')
@include('backend.order.component.editAddress')
@include('backend.order.component.editStatus')
{{-- End Begin Content --}}


@php
    $checkout = __('checkout');
@endphp

<script>
    var OrderDetailsMessages = {
        messages: {!! json_encode(__('messages.order.details')) !!}
    }

    const paymentMethods = {
        @foreach($checkout['method'] as $method)
            '{{ $method['name'] }}': {
                label: @json($method['label']),
                icon: @json($method['icon']),
                class: @json($method['badge_class'])
            }{{ !$loop->last ? ',' : '' }}
        @endforeach
    };

    const confirmStatus = {
        @foreach($checkout['confirm'] as $confirm)
            '{{ $confirm['name'] }}': {
                label: @json($confirm['label']),
                icon: @json($confirm['icon']),
                class: @json($confirm['badge_class'])
            }{{ !$loop->last ? ',' : '' }}
        @endforeach
    };

    const shippingMethods = {
        @foreach($checkout['shipping'] as $shipping)
            '{{ $shipping['name'] }}': {
                label: @json($shipping['label']),
                icon: @json($shipping['icon']),
                class: @json($shipping['badge_class'])
            }{{ !$loop->last ? ',' : '' }}
        @endforeach
    };
    
    const paymentStatus = {
        @foreach($checkout['payment'] as $payment)
            '{{ $payment['name'] }}': {
                label: @json($payment['label']),
                class: @json($payment['badge_class']),
                icon: @json($payment['icon'])
            }{{ !$loop->last ? ',' : '' }}
        @endforeach
    };

    const deliveryStatus = {
        @foreach($checkout['delivery'] as $delivery)
            '{{ $delivery['name'] }}': {
                label: @json($delivery['label']),
                class: @json($delivery['badge_class']),
                icon: @json($delivery['icon'])
            }{{ !$loop->last ? ',' : '' }}
        @endforeach
    };
</script>
