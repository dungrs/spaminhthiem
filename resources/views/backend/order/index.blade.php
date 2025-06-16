@php
    $seoTables = $configs['seo']['index']['table'];
@endphp
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @include('backend.order.component.cardHeader')
                        <div class="card-body">
                            @include('backend.order.component.filter')
                            @include('backend.order.component.table')
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include('backend.component.footer')
</div>

@php
    $checkout = __('checkout');
@endphp

<script>
    const paymentMethods = {
        @foreach($checkout['method'] as $method)
            '{{ $method['name'] }}': {
                label: @json($method['label']),
                icon: @json($method['icon']),
                class: @json($method['badge_class'])
            }{{ !$loop->last ? ',' : '' }}
        @endforeach
    };

    const confirmMethods = {
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
