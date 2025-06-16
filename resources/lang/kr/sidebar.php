<?php 

return [
    'module' => [
        [
            'menu_title' => '카테고리'
        ],
        [
            'title' => '대시보드',
            'icon' => 'bx bx-home-circle',
            'name' => ['dashboard'],
        ],

        [
            'menu_title' => '콘텐츠 관리'
        ],
        [
            'title' => '게시글 관리',
            'icon' => 'bx bxs-news',
            'name' => ['post'],
            'subModule' => [
                [
                    'title' => '게시글 그룹 관리',
                    'route' => 'post.catalogue.index'
                ],
                [
                    'title' => '게시글 관리',
                    'route' => 'post.index'
                ],
            ],
        ],
        [
            'title' => '리뷰 관리',
            'icon' => 'bx bxs-comment-dots',
            'name' => ['comment'],
            'subModule' => [
                [
                    'title' => '상품 리뷰 관리',
                    'route' => 'review.index'
                ],
            ],
        ],
        [
            'title' => '상품 관리',
            'icon' => 'bx bxs-box',
            'name' => ['product', 'attribute'],
            'subModule' => [
                [
                    'title' => '상품 그룹 관리',
                    'route' => 'product.catalogue.index'
                ],
                [
                    'title' => '상품 관리',
                    'route' => 'product.index'
                ],
                [
                    'title' => '속성 관리',
                    'route' => 'attribute.index'
                ],
                [
                    'title' => '속성 유형 관리',
                    'route' => 'attribute.catalogue.index'
                ],
            ],
        ],
        [
            'title' => '테마 관리',
            'icon' => 'bx bxs-layout',
            'name' => ['menu', 'slide', 'widget'],
            'subModule' => [
                [
                    'title' => '메뉴 설정',
                    'route' => 'menu.index',
                    'icon' => 'bx bx-menu'
                ],
                [
                    'title' => '배너 및 슬라이드 관리',
                    'route' => 'slide.index',
                    'icon' => 'bx bx-slider-alt'
                ],
                [
                    'title' => '위젯 관리',
                    'route' => 'widget.index', 
                    'icon' => 'bx bx-grid-alt'
                ],
            ],
        ],

        [
            'menu_title' => '회원 관리'
        ],
        [
            'title' => '회원 관리',
            'icon' => 'bx bxs-user',
            'name' => ['user', 'permission'],
            'subModule' => [
                [
                    'title' => '회원 그룹 관리',
                    'route' => 'user.catalogue.index'
                ],
                [
                    'title' => '회원 목록',
                    'route' => 'user.index'
                ],
                [
                    'title' => '권한 관리',
                    'route' => 'permission.index'
                ]
            ]
        ],

        [
            'menu_title' => '고객 관리'
        ],
        [
            'title' => '고객 관리',
            'icon' => 'bx bxs-user-detail',
            'name' => ['customer'],
            'subModule' => [
                [
                    'title' => '고객 그룹 관리',
                    'route' => 'customer.catalogue.index'
                ],
                [
                    'title' => '고객 목록',
                    'route' => 'customer.index'
                ],
            ]
        ],

        [
            'menu_title' => '마케팅 및 판매'
        ],
        [
            'title' => '주문 관리',
            'icon' => 'bx bxs-cart-alt',
            'name' => ['order'],
            'subModule' => [
                [
                    'title' => '주문 목록',
                    'route' => 'order.index'
                ],
            ]
        ],
        [
            'title' => '마케팅 관리',
            'icon' => 'bx bxs-megaphone',
            'name' => ['source', 'promotion'],
            'subModule' => [
                [
                    'title' => '고객 유입 경로 관리',
                    'route' => 'source.index'
                ],
                [
                    'title' => '프로모션 관리',
                    'route' => 'promotion.index'
                ],
            ]
        ],

        [
            'menu_title' => '시스템'
        ],
        [
            'title' => '기본 설정',
            'icon' => 'bx bxs-cog',
            'name' => ['language', 'system'],
            'subModule' => [
                [
                    'title' => '언어 관리',
                    'route' => 'language.index'
                ],
                [
                    'title' => '시스템 설정',
                    'route' => 'system.index'
                ],
            ]
        ],
    ]
];