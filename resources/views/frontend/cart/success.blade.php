<main>
    <div class="checkout-progress py-4 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="step completed">
                            <div class="step-icon">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <div class="step-label mt-2">Giỏ Hàng</div>
                        </div>
                        
                        <div class="step-connector"></div>
                        
                        <div class="step completed">
                            <div class="step-icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                            <div class="step-label mt-2">Đặt Hàng</div>
                        </div>
                        
                        <div class="step-connector active"></div>
                        
                        <div class="step active">
                            <div class="step-icon bg-primary text-white">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="step-label mt-2">Hoàn Thành</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-2">
        <!-- Invoice Card -->
        <div class="invoice-container">
            <!-- Header -->
            <div class="invoice-header text-center">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="mb-0"><i class="fas fa-receipt me-2"></i>HÓA ĐƠN</h1>
                    @if ($data['order']->first()->payment === 'paid')
                        @if ($data['order']->first()->method !== 'cod')
                            <div class="payment-status">
                                <span class="badge bg-white text-tokyo-red border border-tokyo-red rounded-pill px-3 py-2 shadow-sm">
                                    <i class="fas fa-check-circle me-1 text-tokyo-red"></i> ĐÃ THANH TOÁN
                                </span>
                            </div>
                        @endif
                    @else
                        @if ($data['order']->first()->method !== 'cod')
                            <div class="payment-status">
                                <span class="badge bg-tokyo-red bg-opacity-10 text-white border border-tokyo-red rounded-pill px-3 py-2">
                                    <i class="fas fa-exclamation-circle me-1"></i> THANH TOÁN KHÔNG THÀNH CÔNG
                                    <small class="d-block mt-1">Vui lòng thử lại</small>
                                </span>
                            </div>
                        @endif
                    @endif
                </div>
                <div class="row text-start">
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3">Thông tin đơn hàng</h5>
                        <p class="mb-1"><strong>Mã đơn hàng:</strong> #DH{{ $data['order']->first()->code }}</p>
                        <p class="mb-1"><strong>Ngày đặt:</strong> {{ $data['order']->first()->created_at->format('d/m/Y') }}</p>
                        <p class="mb-1"><strong>Phương thức:</strong> {{ array_column(__('checkout.method'), 'label', 'name')[$data['order']->first()->method] }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3">Thông tin khách hàng</h5>
                        <p class="mb-1"><strong>Họ tên:</strong> {{ $data['order']->first()->fullname }}</p>
                        <p class="mb-1"><strong>SĐT:</strong> {{ $data['order']->first()->address }}</p>
                        <p class="mb-1"><strong>Địa chỉ:</strong> {{ $data['order']->first()->phone }}</p>
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
                                $firstOrder = $data['order']->first();
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
                            <span>{{ convert_price($data['order']->first()->cart['cartTotal']) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Giảm giá:</span>
                            <span class="text-primary">-{{ convert_price($data['order']->first()->promotion['discount']) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Phí vận chuyển:</span>
                            <span>{{ convert_price(0) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mt-3 pt-2 border-top">
                            <h5 class="fw-bold">Tổng cộng:</h5>
                            <h4 class="fw-bold text-danger">{{ convert_price($data['order']->first()->cart['cartTotal'] - $data['order']->first()->promotion['discount']) }}</h4>
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
                        <i class="fas fa-arrow-left me-2 mt-2"></i>
                        <span>Tiếp tục mua sắm</span>
                    </a>
                    <button class="btn print-btn" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>In hóa đơn
                    </button>
                </div>
            </div>
        </div>

        <!-- Order Tracking -->
        <!-- Order Tracking -->
    <div class="invoice-container mt-4 p-4">
        <h5 class="fw-bold mb-4"><i class="fas fa-truck me-2"></i>Theo dõi đơn hàng</h5>
        <div class="row">
            <div class="col-md-8">
                <div class="timeline">
                    <!-- Payment Status -->
                    <div class="timeline-step {{ $data['order']->first()->payment === 'paid' ? 'completed' : ($data['order']->first()->payment === 'unpaid' ? 'active' : '') }}">
                        <div class="timeline-icon {{ $data['order']->first()->payment === 'paid' ? 'bg-success' : ($data['order']->first()->payment === 'unpaid' ? 'bg-danger' : 'bg-warning') }} text-white">
                            <i class="fas {{ $data['order']->first()->payment === 'paid' ? 'fa-check-circle' : 'fa-money-bill-wave' }}"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="fw-bold">{{ __('cart.payment.data')[$data['order']->first()->payment] }}</h6>
                            <p class="small text-muted">
                                @if($data['order']->first()->payment === 'paid')
                                    {{ $data['order']->first()->updated_at->format('d/m/Y H:i') }}
                                @elseif($data['order']->first()->payment === 'failed')
                                    Thanh toán không thành công
                                @else
                                    Chưa thanh toán
                                @endif
                            </p>
                        </div>
                    </div>
                        
                    <!-- Confirmation Status -->
                    <div class="timeline-step 
                            @if($data['order']->first()->confirm === 'confirm') completed
                            @elseif($data['order']->first()->confirm === 'cancel') cancelled
                            @else active @endif">
                        
                        <div class="timeline-icon 
                                @if($data['order']->first()->confirm === 'confirm') bg-success
                                @elseif($data['order']->first()->confirm === 'cancel') bg-secondary
                                @else bg-danger @endif text-white">
                            <i class="fas 
                                @if($data['order']->first()->confirm === 'confirm') fa-check
                                @elseif($data['order']->first()->confirm === 'cancel') fa-times
                                @else fa-clock @endif"></i>
                        </div>
                        
                        <div class="timeline-content">
                            <h6 class="fw-bold">
                                {{ __('cart.confirm.data')[$data['order']->first()->confirm] ?? 'Trạng thái không xác định' }}
                            </h6>
                            <p class="small text-muted">
                                @if($data['order']->first()->confirm === 'confirm')
                                    {{ $data['order']->first()->updated_at->format('d/m/Y H:i') }}
                                @elseif($data['order']->first()->confirm === 'cancel')
                                    Đã hủy vào {{ $data['order']->first()->updated_at->format('d/m/Y H:i') }}
                                @else
                                    Chờ xác nhận từ cửa hàng
                                @endif
                            </p>
                            
                            @if($data['order']->first()->confirm === 'cancel' && $data['order']->first()->cancel_reason)
                                <div class="alert alert-light border mt-2 p-2 small">
                                    <strong>Lý do hủy:</strong> {{ $data['order']->first()->cancel_reason }}
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Processing Status -->
                    <div class="timeline-step {{ $data['order']->first()->delivery !== 'pending' ? 'completed' : ($data['order']->first()->delivery === 'delivery' ? 'active' : '') }}">
                        <div class="timeline-icon {{ $data['order']->first()->delivery !== 'pending' ? 'bg-success' : ($data['order']->first()->delivery === 'delivery' ? 'bg-danger' : '') }} text-white">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="fw-bold">
                                @if($data['order']->first()->delivery === 'pending')
                                    Đang chuẩn bị hàng
                                @else
                                    {{ __('cart.delivery.data')[$data['order']->first()->delivery] }}
                                @endif
                            </h6>
                            <p class="small text-muted">
                                @if($data['order']->first()->delivery === 'processing')
                                    Đang đóng gói và vận chuyển
                                @elseif($data['order']->first()->delivery === 'success')
                                    {{ $data['order']->first()->updated_at->format('d/m/Y H:i') }}
                                @else
                                    Dự kiến hoàn thành: {{ $data['order']->first()->created_at->addDays(3)->format('d/m/Y') }}
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <!-- Delivery Status -->
                    <div class="timeline-step {{ $data['order']->first()->delivery === 'success' ? 'completed' : '' }}">
                        <div class="timeline-icon {{ $data['order']->first()->delivery === 'success' ? 'bg-success' : '' }} text-white">
                            <i class="fas {{ $data['order']->first()->delivery === 'success' ? 'fa-check' : 'fa-shipping-fast' }}"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="fw-bold">
                                @if($data['order']->first()->delivery === 'success')
                                    Đã giao hàng thành công
                                @else
                                    Đang vận chuyển
                                @endif
                            </h6>
                            <p class="small text-muted">
                                @if($data['order']->first()->delivery === 'success')
                                    {{ $data['order']->first()->updated_at->format('d/m/Y H:i') }}
                                @else
                                    @if($data['order']->first()->delivery === 'processing')
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
                        <h6 class="fw-bold">{{ __('cart.method_shipping.data')[$data['order']->first()->method_shipping] }}</h6>
                        <p class="small text-muted">Mã vận đơn: {{ $data['order']->first()->shipping_code ?? 'Đang cập nhật' }}</p>
                        <button class="btn btn-outline-primary align-self-center">Xem chi tiết</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>