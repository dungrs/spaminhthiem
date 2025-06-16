<?php
return [
    'method' => [
        [
            'name' => 'cod',
            'label' => '착불 결제 (COD)',
            'icon' => 'fas fa-money-bill-wave',
            'badge_class' => 'bg-dark bg-opacity-10 text-dark'
        ],
        [
            'name' => 'zalo',
            'label' => 'ZaloPay 전자지갑',
            'icon' => 'fas fa-comments-dollar',
            'badge_class' => 'bg-info bg-opacity-10 text-info'
        ],
        [
            'name' => 'momo',
            'label' => 'MoMo 전자지갑',
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
            'label' => 'VNPAY 전자지갑',
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
            'label' => '경제 배송',
            'icon' => 'fas fa-shipping-fast',
            'badge_class' => 'bg-secondary bg-opacity-10 text-secondary'
        ],
        [
            'name' => 'ghn',
            'label' => '빠른 배송',
            'icon' => 'fas fa-truck-loading',
            'badge_class' => 'bg-info bg-opacity-10 text-info'
        ],
        [
            'name' => 'vnpost',
            'label' => '베트남 우체국',
            'icon' => 'fas fa-envelope-open-text',
            'badge_class' => 'bg-warning bg-opacity-10 text-warning'
        ],
        [
            'name' => 'viettelpost',
            'label' => '비엣텔 포스트',
            'icon' => 'fas fa-box-open',
            'badge_class' => 'bg-success bg-opacity-10 text-success'
        ],
        [
            'name' => 'grabexpress',
            'label' => '그랩 익스프레스 (당일 배송)',
            'icon' => 'fas fa-motorcycle',
            'badge_class' => 'bg-danger bg-opacity-10 text-danger'
        ]
    ],
    'payment' => [
        [
            'name' => 'paid',
            'label' => '결제 완료',
            'icon' => 'fas fa-check-circle',
            'badge_class' => 'bg-success bg-opacity-10 text-success',
        ],
        [
            'name' => 'unpaid',
            'label' => '미결제',
            'icon' => 'fas fa-times-circle',
            'badge_class' => 'bg-danger bg-opacity-10 text-danger',
        ],
        [
            'name' => 'failed',
            'label' => '환불 완료',
            'icon' => 'fas fa-exchange-alt',
            'badge_class' => 'bg-info bg-opacity-10 text-info',
        ],
    ],
    'delivery' => [
        [
            'name' => 'pending',
            'label' => '대기 중',
            'icon' => 'fas fa-clock',
            'badge_class' => 'bg-secondary bg-opacity-10 text-secondary',
        ],
        [
            'name' => 'processing',
            'label' => '처리 중',
            'icon' => 'fas fa-spinner',
            'badge_class' => 'bg-primary bg-opacity-10 text-primary',
        ],
        [
            'name' => 'shipping',
            'label' => '배송 중',
            'icon' => 'fas fa-truck',
            'badge_class' => 'bg-warning bg-opacity-10 text-warning',
        ],
        [
            'name' => 'success',
            'label' => '배송 완료',
            'icon' => 'fas fa-check-circle',
            'badge_class' => 'bg-success bg-opacity-10 text-success',
        ],
        [
            'name' => 'returned',
            'label' => '반품 완료',
            'icon' => 'fas fa-undo',
            'badge_class' => 'bg-info bg-opacity-10 text-info',
        ],
        [
            'name' => 'cancelled',
            'label' => '취소됨',
            'icon' => 'fas fa-ban',
            'badge_class' => 'bg-danger bg-opacity-10 text-danger',
        ],
    ],
    'confirm' => [
        [
            'name' => 'confirm',
            'label' => '확인 완료',
            'icon' => 'fas fa-check-circle',
            'badge_class' => 'bg-success bg-opacity-10 text-success',
        ],
        [
            'name' => 'pending',
            'label' => '확인 대기 중',
            'icon' => 'fas fa-clock',
            'badge_class' => 'bg-secondary bg-opacity-10 text-secondary',
        ],
        [
            'name' => 'cancel',
            'label' => '취소됨',
            'icon' => 'fas fa-ban',
            'badge_class' => 'bg-danger bg-opacity-10 text-danger',
        ],
    ],
];