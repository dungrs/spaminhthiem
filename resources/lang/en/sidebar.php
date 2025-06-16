<?php 

return [
    'module' => [
        [
            'menu_title' => 'Categories'
        ],
        [
            'title' => 'Dashboard',
            'icon' => 'bx bx-home-circle',
            'name' => ['dashboard'],
        ],

        [
            'menu_title' => 'Content Management'
        ],
        [
            'title' => 'Manage Posts',
            'icon' => 'bx bxs-news',
            'name' => ['post'],
            'subModule' => [
                [
                    'title' => 'Post Categories',
                    'route' => 'post.catalogue.index'
                ],
                [
                    'title' => 'Posts',
                    'route' => 'post.index'
                ],
            ],
        ],
        [
            'title' => 'Manage Reviews',
            'icon' => 'bx bxs-comment-dots',
            'name' => ['comment'],
            'subModule' => [
                [
                    'title' => 'Product Reviews',
                    'route' => 'review.index'
                ],
            ],
        ],
        [
            'title' => 'Manage Products',
            'icon' => 'bx bxs-box',
            'name' => ['product', 'attribute'],
            'subModule' => [
                [
                    'title' => 'Product Categories',
                    'route' => 'product.catalogue.index'
                ],
                [
                    'title' => 'Products',
                    'route' => 'product.index'
                ],
                [
                    'title' => 'Attributes',
                    'route' => 'attribute.index'
                ],
                [
                    'title' => 'Attribute Types',
                    'route' => 'attribute.catalogue.index'
                ],
            ],
        ],
        [
            'title' => 'Theme Management',
            'icon' => 'bx bxs-layout',
            'name' => ['menu', 'slide', 'widget'],
            'subModule' => [
                [
                    'title' => 'Menu Settings',
                    'route' => 'menu.index',
                    'icon' => 'bx bx-menu'
                ],
                [
                    'title' => 'Banners & Slides',
                    'route' => 'slide.index',
                    'icon' => 'bx bx-slider-alt'
                ],
                [
                    'title' => 'Widgets',
                    'route' => 'widget.index', 
                    'icon' => 'bx bx-grid-alt'
                ],
            ],
        ],

        [
            'menu_title' => 'User Management'
        ],
        [
            'title' => 'Manage Users',
            'icon' => 'bx bxs-user',
            'name' => ['user', 'permission'],
            'subModule' => [
                [
                    'title' => 'User Groups',
                    'route' => 'user.catalogue.index'
                ],
                [
                    'title' => 'Users',
                    'route' => 'user.index'
                ],
                [
                    'title' => 'Permissions',
                    'route' => 'permission.index'
                ]
            ]
        ],

        [
            'menu_title' => 'Customer Management'
        ],
        [
            'title' => 'Manage Customers',
            'icon' => 'bx bxs-user-detail',
            'name' => ['customer'],
            'subModule' => [
                [
                    'title' => 'Customer Groups',
                    'route' => 'customer.catalogue.index'
                ],
                [
                    'title' => 'Customers',
                    'route' => 'customer.index'
                ],
            ]
        ],

        [
            'menu_title' => 'Marketing & Sales'
        ],
        [
            'title' => 'Manage Orders',
            'icon' => 'bx bxs-cart-alt',
            'name' => ['order'],
            'subModule' => [
                [
                    'title' => 'Orders',
                    'route' => 'order.index'
                ],
            ]
        ],
        [
            'title' => 'Marketing Management',
            'icon' => 'bx bxs-megaphone',
            'name' => ['source', 'promotion'],
            'subModule' => [
                [
                    'title' => 'Lead Sources',
                    'route' => 'source.index'
                ],
                [
                    'title' => 'Promotions',
                    'route' => 'promotion.index'
                ],
            ]
        ],

        [
            'menu_title' => 'System'
        ],
        [
            'title' => 'General Settings',
            'icon' => 'bx bxs-cog',
            'name' => ['language', 'system'],
            'subModule' => [
                [
                    'title' => 'Languages',
                    'route' => 'language.index'
                ],
                [
                    'title' => 'System Settings',
                    'route' => 'system.index'
                ],
            ]
        ],
    ]
];