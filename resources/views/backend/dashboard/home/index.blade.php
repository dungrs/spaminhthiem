<!-- Start content here -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include('backend.dashboard.home.component.chart')
            @include('backend.dashboard.home.component.salesBestProduct')
            @include('backend.dashboard.home.component.recentOrder')
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include('backend.component.footer')
</div>

@php
    $checkout = __('checkout');
@endphp

<script>
    const confirmMethods = {
        @foreach($checkout['confirm'] as $confirm)
            '{{ $confirm['name'] }}': {
                label: @json($confirm['label']),
                icon: @json($confirm['icon']),
                class: @json($confirm['badge_class'])
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
</script>
