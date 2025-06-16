<?php

return [
    'confirm' => [
        'label' => 'Confirmation Status',
        'data' => [
            'none' => 'Select status',
            'pending' => 'Pending confirmation',
            'confirm' => 'Confirmed',
            'cancel' => 'Cancelled'
        ]
    ],
    'payment' => [
        'label' => 'Payment Status',
        'data' => [
            'none' => 'Select payment status',
            'unpaid' => 'Unpaid',
            'paid' => 'Paid',
            'failed' => 'Refunded'
        ]
    ],
    'delivery' => [
        'label' => 'Delivery Status',
        'data' => [
            'none' => 'Select delivery status',
            'pending' => 'Not delivered',
            'processing' => 'Delivering',
            'success' => 'Successful'
        ]
    ],
    'method_shipping' => [
        'label' => 'Shipping Method',
        'data' => [
            'none' => 'Select shipping method',
            'ghtk' => 'Economical shipping',
            'ghn' => 'Fast shipping',
            'vnpost' => 'Vietnam Post (VNPost)',
            'viettelpost' => 'Viettel Post',
            'grabexpress' => 'GrabExpress (same-day delivery)'
        ]
    ]
];

