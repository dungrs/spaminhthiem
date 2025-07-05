<?php

return [
    'confirm' => [
        'icon' => 'fas fa-clipboard-check',
        'label' => '확인 상태',
        'data' => [
            'pending' => '확인 대기 중',
            'confirm' => '확인됨',
            'cancel' => '취소됨'
        ]
    ],
    'payment' => [
        'icon' => 'fas fa-credit-card',
        'label' => '결제 상태',
        'data' => [
            'unpaid' => '미결제',
            'paid' => '결제 완료',
            'failed' => '환불됨'
        ]
    ],
    'delivery' => [
        'icon' => 'fas fa-truck',
        'label' => '배송 상태',
        'data' => [
            'pending' => '미배송',
            'processing' => '배송 중',
            'success' => '성공'
        ]
    ],
    'method_shipping' => [
        'icon' => 'fas fa-shipping-fast',
        'label' => '배송 방법',
        'data' => [
            'ghtk' => '경제 배송',
            'ghn' => '빠른 배송',
            'vnpost' => '베트남 우체국 (VNPost)',
            'viettelpost' => 'Viettel 우편',
            'grabexpress' => 'GrabExpress (당일 배송)'
        ]
    ]
];
