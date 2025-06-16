<?php 

return [
    'module' => [
        [
            'menu_title' => 'Danh mục'
        ],
        [
            'title' => 'Bảng điều khiển',
            'icon' => 'bx bx-home-circle',
            'name' => ['dashboard'],
        ],
        
        [
            'menu_title' => 'Quản lý nội dung'
        ],
        [
            'title' => 'QL Bài Viết',
            'icon' => 'bx bxs-news',
            'name' => ['post'],
            'subModule' => [
                [
                    'title' => 'QL Nhóm Bài Viết',
                    'route' => 'post.catalogue.index'
                ],
                [
                    'title' => 'QL Bài Viết',
                    'route' => 'post.index'
                ],
            ],
        ],
        [
            'title' => 'QL Bình Luận',
            'icon' => 'bx bxs-comment-dots',
            'name' => ['comment'],
            'subModule' => [
                // [
                //     'title' => 'QL Bình Luận Bài Viết',
                //     'route' => 'comment.post.index'
                // ],
                [
                    'title' => 'QL Bình Luận Sản Phẩm',
                    'route' => 'review.index'
                ],
                // [
                //     'title' => 'QL Bình Luận Khách Hàng',
                //     'route' => 'comment.customer.index'
                // ],
            ],
        ],
        [
            'title' => 'QL Sản Phẩm',
            'icon' => 'bx bxs-box',
            'name' => ['product', 'attribute'],
            'subModule' => [
                [
                    'title' => 'QL Nhóm Sản Phẩm',
                    'route' => 'product.catalogue.index'
                ],
                [
                    'title' => 'QL Sản Phẩm',
                    'route' => 'product.index'
                ],
                [
                    'title' => 'QL Thuộc Tính',
                    'route' => 'attribute.index'
                ],
                [
                    'title' => 'QL Loại Thuộc Tính',
                    'route' => 'attribute.catalogue.index'
                ],
            ],
        ],
        [
            'title' => 'QL Giao diện',
            'icon' => 'bx bxs-layout',
            'name' => ['menu', 'slide', 'widget'],
            'subModule' => [
                [
                    'title' => 'Cài Đặt Menu',
                    'route' => 'menu.index',
                    'icon' => 'bx bx-menu'
                ],
                [
                    'title' => 'QL Banner & Slide',
                    'route' => 'slide.index',
                    'icon' => 'bx bx-slider-alt'
                ],
                [
                    'title' => 'QL Widget',
                    'route' => 'widget.index', 
                    'icon' => 'bx bx-grid-alt'
                ],
            ],
        ],

        [
            'menu_title' => 'Quản lý người dùng'
        ],
        [
            'title' => 'QL Thành Viên',
            'icon' => 'bx bxs-user',
            'name' => ['user', 'permission'],
            'subModule' => [
                [
                    'title' => 'QL Nhóm Thành Viên',
                    'route' => 'user.catalogue.index'
                ],
                [
                    'title' => 'QL Thành Viên',
                    'route' => 'user.index'
                ],
                [
                    'title' => 'QL Quyền',
                    'route' => 'permission.index'
                ]
            ]
        ],
        [
            'menu_title' => 'Quản lý khách hàng'
        ],
        [
            'title' => 'QL Khách Hàng',
            'icon' => 'bx bxs-user-detail',
            'name' => ['customer'],
            'subModule' => [
                [
                    'title' => 'QL Nhóm Khách Hàng',
                    'route' => 'customer.catalogue.index'
                ],
                [
                    'title' => 'QL Khách Hàng',
                    'route' => 'customer.index'
                ],
            ]
        ],

        [
            'menu_title' => 'Marketing & Bán hàng'
        ],
        [
            'title' => 'QL Đơn Hàng',
            'icon' => 'bx bxs-cart-alt',
            'name' => ['order'],
            'subModule' => [
                [
                    'title' => 'QL Đơn Hàng',
                    'route' => 'order.index'
                ],
            ]
        ],
        [
            'title' => 'QL Marketing',
            'icon' => 'bx bxs-megaphone',
            'name' => ['source', 'promotion'],
            'subModule' => [
                [
                    'title' => 'QL Nguồn Khách',
                    'route' => 'source.index'
                ],
                [
                    'title' => 'QL Khuyến Mãi',
                    'route' => 'promotion.index'
                ],
            ]
        ],

        [
            'menu_title' => 'Hệ thống'
        ],
        [
            'title' => 'Cấu Hình Chung',
            'icon' => 'bx bxs-cog',
            'name' => ['language', 'system'],
            'subModule' => [
                [
                    'title' => 'QL Ngôn Ngữ',
                    'route' => 'language.index'
                ],
                [
                    'title' => 'Cấu Hình Hệ Thống',
                    'route' => 'system.index'
                ],
            ]
        ],
    ]
];