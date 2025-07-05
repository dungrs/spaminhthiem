<?php

return [
    'confirm' => [
        'icon' => 'fas fa-clipboard-check',
        'label' => 'Confirmation Status',
        'data' => [
            'pending' => 'Pending confirmation',
            'confirm' => 'Confirmed',
            'cancel' => 'Cancelled'
        ]
    ],
    'payment' => [
        'icon' => 'fas fa-credit-card',
        'label' => 'Payment Status',
        'data' => [
            'unpaid' => 'Unpaid',
            'paid' => 'Paid',
            'failed' => 'Refunded'
        ]
    ],
    'delivery' => [
        'icon' => 'fas fa-truck',
        'label' => 'Delivery Status',
        'data' => [
            'pending' => 'Not delivered',
            'processing' => 'Delivering',
            'success' => 'Successful'
        ]
    ],
    'method_shipping' => [
        'icon' => 'fas fa-shipping-fast',
        'label' => 'Shipping Method',
        'data' => [
            'ghtk' => 'Economical shipping',
            'ghn' => 'Fast shipping',
            'vnpost' => 'Vietnam Post (VNPost)',
            'viettelpost' => 'Viettel Post',
            'grabexpress' => 'GrabExpress (same-day delivery)'
        ]
    ]
];

