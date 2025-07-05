<section class="bread-crumb mb-3">
	<span class="crumb-border"></span>
	<div class="container ">
		<div class="row">
			<div class="col-12 a-left">
				<ul class="breadcrumb m-0 px-0">					
					<li class="home">
						<a href="{{ url('/') }}" class="link"><span>Trang chủ</span></a>						
						<span class="mr_lr">&nbsp;/&nbsp;</span>
					</li>
					<li><strong><span>Đơn hàng </span></strong></li>
				</ul>
			</div>
		</div>
	</div>
</section>

<section class="signup page_customer_account section">
    <div class="container card p-3 shadow-none">
        <div class="row">
            @include("frontend.customer.component.aside", ['active' => 'don-hang'])
            <div class="col-xs-12 col-sm-12 col-lg-9 col-right-ac">
                <h1 class="title-head ms-4">Đơn Hàng Của Bạn</h1>
                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding ms-4">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Mã đơn</th>
                                    <th>Ngày đặt</th>
                                    <th>Địa chỉ</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái TT</th>
                                    <th>Trạng thái GH</th>
                                    <th>Xác nhận</th>
                                </tr>
                            </thead>

                            <tbody class="data-table">
                                
                            </tbody>
                        </table>
                        <ul class="pagination pagination-rounded justify-content-end mb-2">
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@php
    $checkout = __('checkout');
@endphp

<script>
    const customerId = {{ $customer->id }};
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