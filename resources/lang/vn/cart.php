<?php
return [
    'confirm' => [
        'icon' => 'fas fa-clipboard-check',
        'label' => 'Tình trạng xác nhận',
        'data' => [
            'none' => 'Chọn tình trạng',
            'pending' => 'Chờ xác nhận',
            'confirm' => 'Đã xác nhận',
            'cancel' => 'Đã hủy'
        ]
    ],
    'payment' => [
        'icon' => 'fas fa-credit-card',
        'label' => 'Tình trạng thanh toán',
        'data' => [
            'none' => 'Chọn tình trạng thanh toán',
            'unpaid' => 'Chưa thanh toán',
            'paid' => 'Đã thanh toán',
            'failed' => 'Đã hoàn tiền'
        ]
    ],
    'delivery' => [
        'icon' => 'fas fa-truck',
        'label' => 'Tình trạng giao hàng',
        'data' => [
            'none' => 'Chọn tình trạng giao hàng',
            'pending' => 'Chưa giao',
            'processing' => 'Đang giao',
            'success' => 'Thành công'
        ]
    ],
    'method_shipping' => [
        'icon' => 'fas fa-shipping-fast',
        'label' => 'Phương thức giao hàng',
        'data' => [
            'none' => 'Chọn phương thức giao hàng',
            'ghtk' => 'Giao hàng tiết kiệm',
            'ghn' => 'Giao hàng nhanh',
            'vnpost' => 'Bưu điện Việt Nam (VNPost)',
            'viettelpost' => 'Viettel Post',
            'grabexpress' => 'GrabExpress (giao trong ngày)'
        ]
    ]
];