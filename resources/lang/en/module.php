<?php

return [
    'models' => [
        'PostCatalogue' => [
            'name' => 'Post Group',
            'modelParent' => 'Post',
        ],
        'Post' => [
            'name' => 'Post',
            'modelParent' => 'Post',
        ],
        'ProductCatalogue' => [
            'name' => 'Product Group',
            'modelParent' => 'Product',
        ],
    ],
    'type' => [
        'dropdown_menu' => 'Drop Menu',
        'mega_menu' => 'Mega Menu'
    ],
    'effect' => [
        'fade' => 'Fade',
        'cube' => 'Cube', 
        'coverFlow' => 'CoverFlow',
        'flip' => 'Flip',
        'cards' => 'Cards',
        'creative' => 'Creative'
    ],
    'navigate' => [
        'hide' => "Hide",
        'dots' => "Dots",
        'thumbnails' => "Thumbnails"
    ],
    'promotion' => [
        'order_amount_range' => 'Discount by total order value',
        'product_and_quantity' => 'Discount by product and quantity',
        'product_quantity_range' => 'Discount by product quantity tier',
        'goods_discount_by_quantity' => 'Buy quantity - get discount for other products',
    ],
    'item' => [
        'Product' => 'Product variant',
        'ProductCatalogue' => 'Product category',
    ],
    'applyStatus' => [
        'staff_take_care_customer' => 'Assigned Staff',
        'customer_group' => 'Customer Group',
        'customer_gender' => 'Gender',
        'customer_birthday' => 'Birthday',
    ],
    'gender' => [
        [
            'id' => 1,
            'name' => 'Male'
        ],
        [
            'id' => 2,
            'name' => 'Female'
        ]
    ],
    'day' => array_map(function($value) {
        return ['id' => $value - 1, 'name' => $value];
    }, range(1, 31))
];
