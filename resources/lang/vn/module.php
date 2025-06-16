<?php

return [
    'models' => [
        'PostCatalogue' => [
            'name' => 'Nhóm bài viết',
            'modelParent' => 'Post',
        ],
        'Post' => [
            'name' => 'Bài viết',
            'modelParent' => 'Post',
        ],
        'ProductCatalogue' => [
            'name' => 'Nhóm sản phẩm',
            'modelParent' => 'Product',
        ],
        'Product' => [
            'name' => 'Sản Phẩm',
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
        'hide' => "Ẩn",
        'dots' => "Dấu chấm",
        'thumbnails' => "Ảnh Thumbnails"
    ],
    'promotion' => [
        'order_amount_range' => 'Giảm giá theo tổng giá trị đơn hàng',
        'product_and_quantity' => 'Giảm giá theo từng sản phẩm và số lượng',
        'product_quantity_range' => 'Giảm giá theo mức số lượng sản phẩm',
        'goods_discount_by_quantity' => 'Mua số lượng sản phẩm – nhận ưu đãi cho sản phẩm khác',
    ],
    'item' => [
        'Product' => 'Phiên bản sản phẩm',
        'ProductCatalogue' => 'Loại sản phẩm',
    ],
    'applyStatus' => [
        'staff_take_care_customer' => 'Nhân Viên Phụ Trách',
        'customer_group' => 'Nhóm Khách Hàng',
        'customer_gender' => 'Giới Tính',
        'customer_birthday' => 'Ngày Sinh',
    ],
    'gender' => [
        [
            'id' => 1,
            'name' => 'Nam'
        ],
        [
            'id' => 2,
            'name' => 'Nữ'
        ]
    ],
    'day' => array_map(function($value) {
        return ['id' => $value - 1, 'name' => $value];
    }, range(1, 31))
];