<section class="bread-crumb mb-3">
	<span class="crumb-border"></span>
	<div class="container ">
		<div class="row">
            <div class="col-12 a-left">
                <ul class="breadcrumb m-0 px-0">
                    <li class="home">
                        <a  href="/" class='link' ><span>@lang('frontend.home')</span></a>						
                        <span class="mr_lr">&nbsp;/&nbsp;</span>
                    </li>

                    <li class="home">
                        <a  href="{{ writeUrl('don-hang-cua-toi', true, true) }}" class='link' ><span>Đơn hàng</span></a>						
                        <span class="mr_lr">&nbsp;/&nbsp;</span>
                    </li>

                    <li><strong ><span>Chi tiết đơn hàng</span></strong></li>
                </ul>
            </div>
		</div>
	</div>
</section>
<div class="container" style="max-width: 1000px;">
    <div class="bg-white rounded shadow-sm p-4">
        <h4 class="text-center mb-4">Tra Cứu Đơn Hàng</h4>
        
        <form action="{{ route('getOrder') }}" method="GET">
            <div class="mb-3">
                <label class="form-label">Mã Đơn Hàng</label>
                <input type="text" name="code" value="{{ $data['code'] ?? '' }}" class="form-control px-3" placeholder="Nhập mã đơn hàng của bạn">
                <input type="hidden" name="customer_id" value="{{ $customer->id }}">
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 rounded-2 lookup-btn">
                <i class="fas fa-search me-2"></i>Tra Cứu Ngay
            </button>
        </form>
    </div>

    @if (!empty($data['order']))
        <div class="container py-2">
            <!-- Invoice Card -->
            <div class="invoice-container">
                <!-- Header -->
                <div class="invoice-header text-center">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="mb-0"><i class="fas fa-receipt me-2"></i>HÓA ĐƠN</h1>
                        @if ($data['order']->payment === 'paid')
                            @if ($data['order']->method !== 'cod')
                                <div class="payment-status">
                                    <span class="badge bg-white text-tokyo-red border border-tokyo-red rounded-pill px-3 py-2 shadow-sm">
                                        <i class="fas fa-check-circle me-1 text-tokyo-red"></i> ĐÃ THANH TOÁN
                                    </span>
                                </div>
                            @endif
                        @else
                            @if ($data['order']->method !== 'cod')
                                <div class="payment-status">
                                    <span class="badge bg-tokyo-red bg-opacity-10 text-white border border-tokyo-red rounded-pill px-3 py-2">
                                        <i class="fas fa-exclamation-circle me-1"></i> THANH TOÁN KHÔNG THÀNH CÔNG
                                    </span>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="row text-start">
                        <div class="col-md-6">
                            <h5 class="fw-bold mb-3">Thông tin đơn hàng</h5>
                            <p class="mb-1"><strong>Mã đơn hàng:</strong> #DH{{ $data['order']->code }}</p>
                            <p class="mb-1"><strong>Ngày đặt:</strong> {{ $data['order']->created_at->format('d/m/Y') }}</p>
                            <p class="mb-1"><strong>Phương thức:</strong> {{ array_column(__('checkout.method'), 'label', 'name')[$data['order']->method] }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="fw-bold mb-3">Thông tin khách hàng</h5>
                            <p class="mb-1"><strong>Họ tên:</strong> {{ $data['order']->fullname }}</p>
                            <p class="mb-1"><strong>SĐT:</strong> {{ $data['order']->address }}</p>
                            <p class="mb-1"><strong>Địa chỉ:</strong> {{ $data['order']->phone }}</p>
                        </div>
                    </div>
                </div>
    
                <!-- Body -->
                <div class="invoice-body">
                    <!-- Order Items -->
                    <h5 class="fw-bold mb-4">Chi tiết đơn hàng</h5>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Sản phẩm</th>
                                    <th class="text-end">Đơn giá</th>
                                    <th class="text-center">SL</th>
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $firstOrder = $data['order'];
                                    $cart = is_string($firstOrder->cart) ? json_decode($firstOrder->cart, true) : $firstOrder->cart;
                                @endphp
    
                                @foreach ($cart['details'] as $index => $cartItem)
                                    @php
                                        $attributeText = collect($cartItem['options']['attributes'])->map(function ($attr) {
                                            return "{$attr['attribute_catalogue_name']}: {$attr['attribute_name']}";
                                        })->implode(', ');
                                    @endphp
    
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h6 class="mb-1">{{ $cartItem['name'] }}</h6>
                                                    <p class="text-muted small mb-0">{{ $attributeText }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">{{ number_format($cartItem['price'], 0, ',', '.') }}đ</td>
                                        <td class="text-center">{{ $cartItem['qty'] }}</td>
                                        <td class="text-end fw-bold">{{ number_format($cartItem['subtotal'], 0, ',', '.') }}đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
    
                    <div class="divider"></div>
    
                    <!-- Payment Summary -->
                    <div class="row justify-content-end">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tạm tính:</span>
                                <span>{{ convert_price($data['order']->cart['cartTotal']) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Giảm giá:</span>
                                <span class="text-success">-{{ convert_price($data['order']->promotion['discount']) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Phí vận chuyển:</span>
                                <span>{{ convert_price(0) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mt-3 pt-2 border-top">
                                <h5 class="fw-bold">Tổng cộng:</h5>
                                <h4 class="fw-bold text-danger">{{ convert_price($data['order']->cart['cartTotal'] - $data['order']->promotion['discount']) }}</h4>
                            </div>
                        </div>
                    </div>
    
                    <div class="divider"></div>
    
                    <!-- Thank You & Next Steps -->
                    <div class="thank-you mb-4">
                        <h5 class="fw-bold text-primary mb-3"><i class="fas fa-heart me-2"></i>Cảm ơn bạn đã mua hàng!</h5>
                        <p class="mb-2">Đơn hàng của bạn đã được xác nhận và sẽ được giao trong 2-3 ngày tới.</p>
                        <p>Bạn có thể theo dõi đơn hàng trong <a href="#" class="text-primary">Trạng thái đơn hàng</a> hoặc xem <a href="#" class="text-primary">Lịch sử mua hàng</a>.</p>
                    </div>
    
                    <!-- Actions -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('home.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Tiếp tục mua sắm
                        </a>
                        <button class="btn print-btn" onclick="window.print()">
                            <i class="fas fa-print me-2"></i>In hóa đơn
                        </button>
                    </div>
                </div>
            </div>
    
            <!-- Order Tracking -->
            <div class="invoice-container mt-4 p-4">
                <h5 class="fw-bold mb-4"><i class="fas fa-truck me-2"></i>Theo dõi đơn hàng</h5>
                <div class="row">
                    <div class="col-md-8">
                        <div class="timeline">
                            <!-- Payment Status -->
                            <div class="timeline-step {{ $data['order']->payment === 'paid' ? 'completed' : ($data['order']->payment === 'unpaid' ? 'active' : '') }}">
                                <div class="timeline-icon {{ $data['order']->payment === 'paid' ? 'bg-success' : ($data['order']->payment === 'unpaid' ? 'bg-primary' : 'bg-warning') }} text-white">
                                    <i class="fas {{ $data['order']->payment === 'paid' ? 'fa-check-circle' : 'fa-money-bill-wave' }}"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="fw-bold">{{ __('cart.payment.data')[$data['order']->payment] }}</h6>
                                    <p class="small text-muted">
                                        @if($data['order']->payment === 'paid')
                                            {{ $data['order']->updated_at->format('d/m/Y H:i') }}
                                        @elseif($data['order']->payment === 'failed')
                                            Thanh toán không thành công
                                        @else
                                            Chưa thanh toán
                                        @endif
                                    </p>
                                </div>
                            </div>
                                
                            <!-- Confirmation Status -->
                            <div class="timeline-step 
                                    @if($data['order']->confirm === 'confirm') completed
                                    @elseif($data['order']->confirm === 'cancel') cancelled
                                    @else active @endif">
                                
                                <div class="timeline-icon 
                                        @if($data['order']->confirm === 'confirm') bg-success
                                        @elseif($data['order']->confirm === 'cancel') bg-secondary
                                        @else bg-primary @endif text-white">
                                    <i class="fas 
                                        @if($data['order']->confirm === 'confirm') fa-check
                                        @elseif($data['order']->confirm === 'cancel') fa-times
                                        @else fa-clock @endif"></i>
                                </div>
                                
                                <div class="timeline-content">
                                    <h6 class="fw-bold">
                                        {{ __('cart.confirm.data')[$data['order']->confirm] ?? 'Trạng thái không xác định' }}
                                    </h6>
                                    <p class="small text-muted">
                                        @if($data['order']->confirm === 'confirm')
                                            {{ $data['order']->updated_at->format('d/m/Y H:i') }}
                                        @elseif($data['order']->confirm === 'cancel')
                                            Đã hủy vào {{ $data['order']->updated_at->format('d/m/Y H:i') }}
                                        @else
                                            Chờ xác nhận từ cửa hàng
                                        @endif
                                    </p>
                                    
                                    @if($data['order']->confirm === 'cancel' && $data['order']->cancel_reason)
                                        <div class="alert alert-light border mt-2 p-2 small">
                                            <strong>Lý do hủy:</strong> {{ $data['order']->cancel_reason }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Processing Status -->
                            <div class="timeline-step {{ $data['order']->delivery !== 'pending' ? 'completed' : ($data['order']->delivery === 'delivery' ? 'active' : '') }}">
                                <div class="timeline-icon {{ $data['order']->delivery !== 'pending' ? 'bg-success' : ($data['order']->delivery === 'delivery' ? 'bg-primary' : '') }} text-white">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="fw-bold">
                                        @if($data['order']->delivery === 'pending')
                                            Đang chuẩn bị hàng
                                        @else
                                            {{ __('cart.delivery.data')[$data['order']->delivery] }}
                                        @endif
                                    </h6>
                                    <p class="small text-muted">
                                        @if($data['order']->delivery === 'processing')
                                            Đang đóng gói và vận chuyển
                                        @elseif($data['order']->delivery === 'success')
                                            {{ $data['order']->updated_at->format('d/m/Y H:i') }}
                                        @else
                                            Dự kiến hoàn thành: {{ $data['order']->created_at->addDays(3)->format('d/m/Y') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Delivery Status -->
                            <div class="timeline-step {{ $data['order']->delivery === 'success' ? 'completed' : '' }}">
                                <div class="timeline-icon {{ $data['order']->delivery === 'success' ? 'bg-success' : '' }} text-white">
                                    <i class="fas {{ $data['order']->delivery === 'success' ? 'fa-check' : 'fa-shipping-fast' }}"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="fw-bold">
                                        @if($data['order']->delivery === 'success')
                                            Đã giao hàng thành công
                                        @else
                                            Đang vận chuyển
                                        @endif
                                    </h6>
                                    <p class="small text-muted">
                                        @if($data['order']->delivery === 'success')
                                            {{ $data['order']->updated_at->format('d/m/Y H:i') }}
                                        @else
                                            @if($data['order']->delivery === 'processing')
                                                Đang trên đường giao
                                            @else
                                                Chưa cập nhật
                                            @endif
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center d-flex flex-column justify-content-center">
                                <img src="https://cdn-icons-png.flaticon.com/512/1048/1048948.png" 
                                    class="img-fluid mb-3" alt="Giao hàng">
                                <h6 class="fw-bold">{{ __('cart.method_shipping.data')[$data['order']->method_shipping] }}</h6>
                                <p class="small text-muted">Mã vận đơn: {{ $data['order']->shipping_code ?? 'Đang cập nhật' }}</p>
                                <button class="btn btn-sm btn-outline-primary align-self-center">Xem chi tiết</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Nếu KHÔNG tìm thấy đơn hàng -->
        <div class="bg-white rounded shadow-sm p-4 mt-4 text-center">
            <i class="fas fa-box-open fa-2x text-muted mb-3"></i>
            <h5 class="fw-semibold mb-2">Không tìm thấy đơn hàng</h5>
            <p class="text-muted">Rất tiếc, chúng tôi không tìm thấy đơn hàng nào với mã bạn đã nhập.</p>
        </div>
    @endif
</div>