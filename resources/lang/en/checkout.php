<?php
return [
    'method' => [
        [
            'name' => 'cod',
            'label' => 'Cash on Delivery (COD)',
            'icon' => 'fas fa-money-bill-wave',
            'badge_class' => 'bg-dark bg-opacity-10 text-dark'
        ],
        [
            'name' => 'zalo',
            'label' => 'ZaloPay E-Wallet',
            'icon' => 'fas fa-comments-dollar',
            'badge_class' => 'bg-info bg-opacity-10 text-info'
        ],
        [
            'name' => 'momo',
            'label' => 'MoMo E-Wallet',
            'icon' => 'fas fa-wallet',
            'badge_class' => 'bg-warning bg-opacity-10 text-warning'
        ],
        [
            'name' => 'shopee',
            'label' => 'Shopee Pay',
            'icon' => 'fas fa-store',
            'badge_class' => 'bg-danger bg-opacity-10 text-danger'
        ],
        [
            'name' => 'vnpay',
            'label' => 'VNPAY E-Wallet',
            'icon' => 'fas fa-credit-card',
            'badge_class' => 'bg-primary bg-opacity-10 text-primary'
        ],
        [
            'name' => 'paypal',
            'label' => 'Paypal',
            'icon' => 'fab fa-paypal',
            'badge_class' => 'bg-info bg-opacity-10 text-info'
        ]
    ],
    'shipping' => [
        [
            'name' => 'ghtk',
            'label' => 'Economy Shipping',
            'icon' => 'fas fa-shipping-fast',
            'badge_class' => 'bg-secondary bg-opacity-10 text-secondary'
        ],
        [
            'name' => 'ghn',
            'label' => 'Express Shipping',
            'icon' => 'fas fa-truck-loading',
            'badge_class' => 'bg-info bg-opacity-10 text-info'
        ],
        [
            'name' => 'vnpost',
            'label' => 'Vietnam Post',
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
            'label' => 'GrabExpress (Same Day Delivery)',
            'icon' => 'fas fa-motorcycle',
            'badge_class' => 'bg-danger bg-opacity-10 text-danger'
        ]
    ],
    'payment' => [
        [
            'name' => 'paid',
            'label' => 'Paid',
            'icon' => 'fas fa-check-circle',
            'badge_class' => 'bg-success bg-opacity-10 text-success',
        ],
        [
            'name' => 'unpaid',
            'label' => 'Unpaid',
            'icon' => 'fas fa-times-circle',
            'badge_class' => 'bg-danger bg-opacity-10 text-danger',
        ],
        [
            'name' => 'failed',
            'label' => 'Refunded',
            'icon' => 'fas fa-exchange-alt',
            'badge_class' => 'bg-info bg-opacity-10 text-info',
        ],
    ],
    'delivery' => [
        [
            'name' => 'pending',
            'label' => 'Pending',
            'icon' => 'fas fa-clock',
            'badge_class' => 'bg-secondary bg-opacity-10 text-secondary',
        ],
        [
            'name' => 'processing',
            'label' => 'Processing',
            'icon' => 'fas fa-spinner',
            'badge_class' => 'bg-primary bg-opacity-10 text-primary',
        ],
        [
            'name' => 'shipping',
            'label' => 'Shipping',
            'icon' => 'fas fa-truck',
            'badge_class' => 'bg-warning bg-opacity-10 text-warning',
        ],
        [
            'name' => 'success',
            'label' => 'Delivered',
            'icon' => 'fas fa-check-circle',
            'badge_class' => 'bg-success bg-opacity-10 text-success',
        ],
        [
            'name' => 'returned',
            'label' => 'Returned',
            'icon' => 'fas fa-undo',
            'badge_class' => 'bg-info bg-opacity-10 text-info',
        ],
        [
            'name' => 'cancelled',
            'label' => 'Cancelled',
            'icon' => 'fas fa-ban',
            'badge_class' => 'bg-danger bg-opacity-10 text-danger',
        ],
    ],
    'confirm' => [
        [
            'name' => 'confirm',
            'label' => 'Confirmed',
            'icon' => 'fas fa-check-circle',
            'badge_class' => 'bg-success bg-opacity-10 text-success',
        ],
        [
            'name' => 'pending',
            'label' => 'Pending Confirmation',
            'icon' => 'fas fa-clock',
            'badge_class' => 'bg-secondary bg-opacity-10 text-secondary',
        ],
        [
            'name' => 'cancel',
            'label' => 'Cancelled',
            'icon' => 'fas fa-ban',
            'badge_class' => 'bg-danger bg-opacity-10 text-danger',
        ],
    ],
];