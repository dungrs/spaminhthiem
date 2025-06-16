<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Đơn Hàng</title>
    <style>
        /* Reset CSS cho email */
        body, table, td, p, a, li, blockquote {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        
        table {
            border-spacing: 0;
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        
        table td {
            border-collapse: collapse;
        }
        
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }
        
        /* Styles chính */
        .container {
            max-width: 720px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        
        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333333;
        }
        
        .info-row {
            margin-bottom: 5px;
        }
        
        .info-label {
            font-weight: bold;
            color: #555555;
        }
        
        .items-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .items-table th {
            background-color: #f8f9fa;
            padding: 10px;
            text-align: left;
            font-size: 14px;
            color: #555555;
            border-bottom: 2px solid #eeeeee;
        }
        
        .items-table tr:first-child th:first-child {
            border-top-left-radius: 8px;
        }
        
        .items-table tr:first-child th:last-child {
            border-top-right-radius: 8px;
        }
        
        .items-table tr:last-child td:first-child {
            border-bottom-left-radius: 8px;
        }
        
        .items-table tr:last-child td:last-child {
            border-bottom-right-radius: 8px;
        }
        
        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #eeeeee;
            font-size: 14px;
        }
        
        .items-table .text-right {
            text-align: right;
        }
        
        .items-table .text-center {
            text-align: center;
        }
        
        .product-name {
            font-weight: bold;
            color: #333333;
        }
        
        .product-option {
            font-size: 12px;
            color: #777777;
        }
        
        .summary {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            margin: 0 20px;
        }
        
        .summary-table {
            width: 100%;
        }
        
        .summary-table td {
            padding: 5px 0;
        }
        
        .summary-table .text-right {
            text-align: right;
        }
        
        .total-row {
            font-weight: bold;
            font-size: 16px;
            color: #dc3545;
            border-top: 2px solid #eeeeee;
            padding-top: 10px !important;
        }
        
        .thank-you {
            padding: 20px;
            background-color: #f8f9fa;
            border-left: 4px solid #dc3545;
            margin: 20px;
            border-radius: 8px;
        }
        
        .thank-you-title {
            color: #dc3545;
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 10px;
        }
        
        .footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #777777;
            background-color: #f5f5f5;
            border-radius: 0 0 8px 8px;
        }
        
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #dc3545;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
        
        .payment-badge {
            display: inline-block;
            color: #ffffff;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .payment-success {
            background-color: #28a745;
        }
        
        .payment-pending {
            background-color: #ffc107;
            color: #333;
        }
        
        .payment-cod {
            background-color: #17a2b8;
        }
        
        .payment-failed {
            background-color: #dc3545;
        }
        
        .content-section {
            background-color: #ffffff;
            border-radius: 8px;
            margin: 0 20px 20px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            border-bottom: 2px solid #f2f2f2;
        }
        
        .separator-line {
            height: 2px;
            background-color: #eeeeee;
            margin: 15px 0;
            border-radius: 1px;
        }

        .d-none {
            display: none;
        }
        
        @media only screen and (max-width: 720px) {
            .container {
                width: 100% !important;
            }
            
            .items-table th, .items-table td {
                padding: 5px;
                font-size: 12px;
            }
            
            .content-section, .summary, .thank-you {
                margin: 0 10px 10px;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f5f5f5">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table class="container" width="720" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="border-radius: 8px; box-shadow: 0 0 15px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <tr>
                        <td class="header" style="border-radius: 8px 8px 0 0;">
                            <h1>XÁC NHẬN ĐƠN HÀNG</h1>
                            <p style="margin: 10px 0 0 0;">Cảm ơn bạn đã đặt hàng tại cửa hàng chúng tôi</p>
                        </td>
                    </tr>
                    
                    <!-- Paid status - Đã được chỉnh sửa -->
                    <tr>
                        <td align="center" style="padding: 15px 0 0 0;">
                            @if ($data['order']->first()->method === 'cod')
                                <span class="payment-badge payment-cod" style="border-radius: 20px; padding: 6px 15px;">
                                    THANH TOÁN KHI NHẬN HÀNG
                                </span>
                            @elseif ($data['order']->first()->payment === 'paid')
                                <span class="payment-badge payment-success" style="border-radius: 20px; padding: 6px 15px;">
                                    THANH TOÁN THÀNH CÔNG
                                </span>
                            @else
                                <span class="payment-badge payment-failed" style="border-radius: 20px; padding: 6px 15px;">
                                    THANH TOÁN KHÔNG THÀNH CÔNG
                                </span>
                            @endif
                        </td>
                    </tr>
                    
                    <!-- Order info -->
                    <tr>
                        <td>
                            <div class="content-section" style="margin-top: 20px;">
                                <h2 class="section-title">Thông tin đơn hàng</h2>
                                <p class="info-row">
                                    <span class="info-label">Mã đơn hàng:</span> #DH{{ $data['order']->first()->code }}
                                </p>
                                <p class="info-row">
                                    <span class="info-label">Ngày đặt:</span> {{ $data['order']->first()->created_at->format('d/m/Y') }}
                                </p>
                                <p class="info-row">
                                    <span class="info-label">Phương thức:</span> {{ array_column(__('checkout.method'), 'label', 'name')[$data['order']->first()->method] }}
                                </p>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Customer info -->
                    <tr>
                        <td>
                            <div class="content-section">
                                <h2 class="section-title">Thông tin khách hàng</h2>
                                <p class="info-row">
                                    <span class="info-label">Họ tên:</span> {{ $data['order']->first()->fullname }}
                                </p>
                                <p class="info-row">
                                    <span class="info-label">SĐT:</span> {{ $data['order']->first()->phone }}
                                </p>
                                <p class="info-row">
                                    <span class="info-label">Địa chỉ:</span> {{ $data['order']->first()->address }}
                                </p>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Order items -->
                    <tr>
                        <td>
                            <div class="content-section">
                                <h2 class="section-title">Chi tiết đơn hàng</h2>
                                <table class="items-table" width="100%" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #eeeeee; border-radius: 8px;">
                                    <thead>
                                        <tr>
                                            <th width="10%" style="border-top-left-radius: 8px;">STT</th>
                                            <th width="40%">Sản phẩm</th>
                                            <th width="20%" class="text-right">Đơn giá</th>
                                            <th width="10%" class="text-center">SL</th>
                                            <th width="20%" class="text-right" style="border-top-right-radius: 8px;">Thành tiền</th>
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
                                                    <div class="product-name">{{ $cartItem['name'] }}</div>
                                                    <div class="product-option">{{ $attributeText }}</div>
                                                </td>
                                                <td class="text-right">{{ number_format($cartItem['price'], 0, ',', '.') }}đ</td>
                                                <td class="text-center">{{ $cartItem['qty'] }}</td>
                                                <td class="text-right">{{ number_format($cartItem['subtotal'], 0, ',', '.') }}đ</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Order summary -->
                    <tr>
                        <td>
                            <div class="summary">
                                <table class="summary-table" width="100%" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>Tạm tính:</td>
                                        <td class="text-right">{{ convert_price($data['order']->first()->cart['cartTotal']) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Giảm giá:</td>
                                        <td class="text-right" style="color: #28a745;">-{{ convert_price($data['order']->first()->promotion['discount']) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phí vận chuyển:</td>
                                        <td class="text-right">{{ convert_price(0) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="total-row">Tổng cộng:</td>
                                        <td class="total-row text-right">{{ convert_price($data['order']->first()->cart['cartTotal'] - $data['order']->first()->promotion['discount']) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Thank you note -->
                    <tr>
                        <td>
                            <div class="thank-you">
                                <h3 class="thank-you-title">Cảm ơn bạn đã mua hàng!</h3>
                                <p>Đơn hàng của bạn đã được xác nhận và sẽ được giao trong 2-3 ngày tới.</p>
                                <p>Mọi thắc mắc xin vui lòng liên hệ với chúng tôi qua số điện thoại hoặc email hỗ trợ.</p>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Call to action -->
                    <tr>
                        <td align="center" style="padding: 0 20px 20px 20px;">
                            <a href="{{ route('home.index') }}" class="button">Tiếp tục mua sắm</a>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td class="footer" style="border-radius: 0 0 8px 8px;">
                            <p>&copy; 2025 Cửa hàng của bạn. Tất cả các quyền được bảo lưu.</p>
                            <p>Địa chỉ: 123 Đường ABC, Quận XYZ, Thành phố HCM</p>
                            <p>Email: support@example.com | Số điện thoại: 0123 456 789</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>