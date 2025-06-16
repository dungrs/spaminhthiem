<?php

return [
    'models' => [
        'PostCatalogue' => [
            'name' => '게시글 그룹',
            'modelParent' => 'Post',
        ],
        'Post' => [
            'name' => '게시글',
            'modelParent' => 'Post',
        ],
        'ProductCatalogue' => [
            'name' => '상품 그룹',
            'modelParent' => 'Product',
        ],
    ],
    'type' => [
        'dropdown_menu' => '드롭다운 메뉴',
        'mega_menu' => '메가 메뉴'
    ],
    'effect' => [
        'fade' => '페이드',
        'cube' => '큐브',
        'coverFlow' => '커버플로우',
        'flip' => '플립',
        'cards' => '카드',
        'creative' => '크리에이티브'
    ],
    'navigate' => [
        'hide' => "숨기기",
        'dots' => "점 표시",
        'thumbnails' => "썸네일"
    ],
    'promotion' => [
        'order_amount_range' => '총 주문 금액별 할인',
        'product_and_quantity' => '상품 및 수량별 할인',
        'product_quantity_range' => '상품 수량 구간별 할인',
        'goods_discount_by_quantity' => '수량 구매 - 다른 상품 할인 제공',
    ],
    'item' => [
        'Product' => '상품 변형',
        'ProductCatalogue' => '상품 카테고리',
    ],
    'applyStatus' => [
        'staff_take_care_customer' => '담당 직원',
        'customer_group' => '고객 그룹',
        'customer_gender' => '성별',
        'customer_birthday' => '생일',
    ],
    'gender' => [
        [
            'id' => 1,
            'name' => '남성'
        ],
        [
            'id' => 2,
            'name' => '여성'
        ]
    ],
    'day' => array_map(function($value) {
        return ['id' => $value - 1, 'name' => $value];
    }, range(1, 31))
];