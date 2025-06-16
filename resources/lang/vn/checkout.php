<?php
return [
    'method' => [
        [
            'name' => 'cod',
            'label' => 'Thanh toán khi nhận hàng (COD)',
            'icon' => 'fas fa-money-bill-wave',
            'badge_class' => 'bg-dark bg-opacity-10 text-dark'
        ],
        [
            'name' => 'zalo',
            'label' => 'Thanh toán qua ví điện tử ZaloPay',
            'icon' => 'fas fa-comments-dollar',
            'badge_class' => 'bg-info bg-opacity-10 text-info'
        ],
        [
            'name' => 'momo',
            'label' => 'Thanh toán qua ví MoMo',
            'icon' => 'fas fa-wallet',
            'badge_class' => 'bg-warning bg-opacity-10 text-warning'
        ],
        [
            'name' => 'shopee',
            'label' => 'Thanh toán qua Shopee Pay',
            'icon' => 'fas fa-store',
            'badge_class' => 'bg-danger bg-opacity-10 text-danger'
        ],
        [
            'name' => 'vnpay',
            'label' => 'Thanh toán ví điện tử VNPAY',
            'icon' => 'fas fa-credit-card',
            'badge_class' => 'bg-primary bg-opacity-10 text-primary'
        ],
        [
            'name' => 'paypal',
            'label' => 'Thanh toán qua Paypal',
            'icon' => 'fab fa-paypal',
            'badge_class' => 'bg-info bg-opacity-10 text-info'
        ]
    ],
    'shipping' => [
        [
            'name' => 'ghtk',
            'label' => 'Giao hàng tiết kiệm',
            'icon' => 'fas fa-shipping-fast',
            'badge_class' => 'bg-secondary bg-opacity-10 text-secondary'
        ],
        [
            'name' => 'ghn',
            'label' => 'Giao hàng nhanh',
            'icon' => 'fas fa-truck-loading',
            'badge_class' => 'bg-info bg-opacity-10 text-info'
        ],
        [
            'name' => 'vnpost',
            'label' => 'Bưu điện Việt Nam (VNPost)',
            'icon' => 'fas fa-envelope-open-text',
            'badge_class' => 'bg-warning bg-opacity-10 text-warning'
        ],
        [
            'name' => 'viettelpost',
            'label' => 'Viettel Post',
            'icon' => 'fas fa-box-open',
            'badge_class' => 'bg-success bg-opacity-10 text-success'
        ],
        [
            'name' => 'grabexpress',
            'label' => 'GrabExpress (giao trong ngày)',
            'icon' => 'fas fa-motorcycle',
            'badge_class' => 'bg-danger bg-opacity-10 text-danger'
        ]
    ],
    'payment' => [
        [
            'name' => 'paid',
            'label' => 'Đã thanh toán',
            'icon' => 'fas fa-check-circle',
            'badge_class' => 'bg-success bg-opacity-10 text-success',
        ],
        [
            'name' => 'unpaid',
            'label' => 'Chưa thanh toán',
            'icon' => 'fas fa-times-circle',
            'badge_class' => 'bg-danger bg-opacity-10 text-danger',
        ],
        [
            'name' => 'failed',
            'label' => 'Đã hoàn tiền',
            'icon' => 'fas fa-exchange-alt',
            'badge_class' => 'bg-info bg-opacity-10 text-info',
        ],
    ],
    'delivery' => [
        [
            'name' => 'pending',
            'label' => 'Chờ xử lý',
            'icon' => 'fas fa-clock',
            'badge_class' => 'bg-secondary bg-opacity-10 text-secondary',
        ],
        [
            'name' => 'processing',
            'label' => 'Đang xử lý',
            'icon' => 'fas fa-spinner',
            'badge_class' => 'bg-primary bg-opacity-10 text-primary',
        ],
        [
            'name' => 'shipping',
            'label' => 'Đang vận chuyển',
            'icon' => 'fas fa-truck',
            'badge_class' => 'bg-warning bg-opacity-10 text-warning',
        ],
        [
            'name' => 'success',
            'label' => 'Đã giao',
            'icon' => 'fas fa-check-circle',
            'badge_class' => 'bg-success bg-opacity-10 text-success',
        ],
        [
            'name' => 'returned',
            'label' => 'Hoàn trả',
            'icon' => 'fas fa-undo',
            'badge_class' => 'bg-info bg-opacity-10 text-info',
        ],
        [
            'name' => 'cancelled',
            'label' => 'Đã hủy',
            'icon' => 'fas fa-ban',
            'badge_class' => 'bg-danger bg-opacity-10 text-danger',
        ],
    ],
    'confirm' => [
        [
            'name' => 'confirm',
            'label' => 'Đã xác nhận',
            'icon' => 'fas fa-check-circle',
            'badge_class' => 'bg-success bg-opacity-10 text-success',
        ],
        [
            'name' => 'pending',
            'label' => 'Chưa xác nhận',
            'icon' => 'fas fa-clock',
            'badge_class' => 'bg-secondary bg-opacity-10 text-secondary',
        ],
        [
            'name' => 'cancel',
            'label' => 'Đã hủy',
            'icon' => 'fas fa-ban',
            'badge_class' => 'bg-danger bg-opacity-10 text-danger',
        ],
    ],
];