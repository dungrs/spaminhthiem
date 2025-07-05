<?php 

return [
    'stats' => [
        'monthly_orders' => 'Đơn Hàng Trong Tháng',
        'total_orders' => 'Tổng Số Đơn Hàng',
        'monthly_revenue' => 'Doanh Thu Trong Tháng',
        'total_customers' => 'Tổng Số Khách Hàng',
        'new_customers' => 'Khách Hàng Mới',
        'conversion_rate' => 'Tỷ Lệ Chuyển Đổi'
    ],
    'dashboard' => [
        'index' => [
            'title' => "Tổng Quan Hệ Thống",
        ],
        'chart' => [
            'revenue_chart' => 'Biểu đồ doanh thu',
            'sort_by' => 'Sắp xếp theo:',
            'sort_options' => [
                'year' => 'Theo năm',
                'month' => 'Theo tháng',
                '30_days' => '30 ngày gần nhất',
                '7_days' => '7 ngày gần nhất'
            ],
            'order_stats' => 'Thống kê đơn hàng',
            'order_status' => [
                'completed' => 'Đơn hàng hoàn thành',
                'processing' => 'Đơn hàng đang xử lý',
                'canceled' => 'Đơn hàng bị hủy'
            ],
            'change_labels' => [
                'increase' => 'Tăng :value%',
                'decrease' => 'Giảm :value%'
            ]
        ],
        'sale_best_product' => [
            'productItem' => [
                'no_reviews' => 'Chưa có đánh giá',
                'reviews_count' => ':count đánh giá',
                'view_details' => 'Xem chi tiết',
                'sold_progress' => 'Đã bán :sold/:total',
                'discount_badge' => '-:value:type'
            ],
            'sales_by_social_source' => [
                'title' => 'Doanh Số Theo Nguồn Mạng Xã Hội',
                'time_periods' => [
                    'monthly' => 'Hàng tháng',
                    'yearly' => 'Hàng năm',
                    'weekly' => 'Hàng tuần',
                    'today' => 'Hôm nay'
                ],
                'platforms' => [
                    'facebook' => [
                        'name' => 'Quảng cáo Facebook',
                        'category' => 'Giày dép',
                        'orders' => 'Đơn hàng',
                        'likes' => 'Lượt thích'
                    ],
                    'twitter' => [
                        'name' => 'Quảng cáo Twitter',
                        'category' => 'Áo thun'
                    ],
                    'linkedin' => [
                        'name' => 'Quảng cáo LinkedIn',
                        'category' => 'Đồng hồ'
                    ],
                    'youtube' => [
                        'name' => 'Quảng cáo YouTube',
                        'category' => 'Ghế'
                    ],
                    'instagram' => [
                        'name' => 'Quảng cáo Instagram',
                        'category' => 'Ghế'
                    ]
                ],
                'metrics' => [
                    'orders' => ':count Đơn hàng',
                    'likes' => ':countk Lượt thích',
                    'revenue' => ':amountđ',
                    'growth' => [
                        'positive' => ':percent% Tăng',
                        'negative' => ':percent% Giảm'
                    ]
                ]
            ],
            'best_selling_products' => [
                'title' => 'Sản Phẩm Bán Chạy Nhất'
            ],
            'navigation' => [
                'next' => 'Tiếp',
                'prev' => 'Trước'
            ]
        ],

        'sales_recent_orders' => [
            'sales_revenue' => [
                'title' => 'Doanh Thu Bán Hàng',
                'year_selection' => [
                    'label' => 'Năm:',
                    'placeholder' => '2022',
                    'options' => [
                        '2019' => '2019',
                        '2020' => '2020', 
                        '2021' => '2021'
                    ]
                ]
            ],
            
            'recent_orders' => [
                'title' => 'Đơn Hàng Gần Đây',
                'table' => [
                    'headers' => [
                        'order_code' => 'Mã đơn hàng',
                        'customer' => 'Khách hàng',
                        'price' => 'Giá tiền',
                        'payment_status' => 'Trạng thái TT',
                        'confirmation' => 'Xác nhận',
                        'actions' => 'Thao tác'
                    ],
                    'customer_col_width' => '210px'
                ]
            ]
        ]
    ],
    'source' => [
        'index' => [
            'title' => "Quản Lý Nguồn Khách Hàng",
            'table' => [
                'title' => "Danh sách các nguồn khách hàng",
                'table_header' => [
                    'name' => 'Tên nguồn',
                    'description' => 'Mô tả',
                    'keyword' => 'Từ khóa',
                ],
                'add_button' => "Thêm nguồn khách hàng",
            ],
        ],
        'modal' => [
            'title' => [
                'create' => 'Thêm nguồn khách hàng mới',
                'edit' => 'Chỉnh sửa nguồn khách hàng'
            ],
            'name' => 'Tên nguồn',
            'keyword' => 'Từ khóa',
            'description' => 'Mô tả ngắn',
            'name_placeholder' => 'Nhập tên nguồn khách hàng...',
            'keyword_placeholder' => 'Nhập từ khóa...',
            'description_placeholder' => 'Nhập mô tả ngắn...',
        ]
    ],
    'user_catalogue' => [
        'index' => [
            'title' => "Quản Lý Nhóm Thành Viên",
            'table' => [
                'title' => "Danh Sách Nhóm Thành Viên",
                'table_header' => [
                    'name' => 'Tên nhóm',
                    'description' => 'Mô tả',
                    'email' => 'Email',
                    'phone' => 'Số điện thoại',
                    'user_count' => 'Số thành viên',
                ],
                'add_button' => "Thêm mới nhóm thành viên",
            ],
        ],
        'permission' => [
            'title' => "Cập nhật quyền",
            'table' => [
                'title' => "Cập nhật quyền",
                'table_header' => [
                    'name' => 'Tên quyền',
                ],
            ],
        ],
        'modal' => [
            'title' => [
                'create' => 'Thêm nhóm thành viên mới',
                'edit' => 'Chỉnh sửa nhóm thành viên',
                'translate' => 'Dịch nhóm thành viên sang ngôn ngữ khác',
            ],
            'name' => 'Tên nhóm thành viên',
            'phone' => 'Số điện thoại',
            'email' => 'Email',
            'description' => 'Mô tả ngắn',
            'language' => 'Chọn ngôn ngữ hiển thị',
            'name_placeholder' => 'Nhập tên nhóm thành viên...',
            'phone_placeholder' => 'Nhập số điện thoại...',
            'email_placeholder' => 'Nhập vào email...',
            'description_placeholder' => 'Nhập mô tả...',
        ],
        'notifications' => [
            'delete_error_users_exist' => "Không thể xóa nhóm thành viên vì có người dùng đang sử dụng nhóm này. Vui lòng xóa thành viên trước khi xóa nhóm!",
        ]
    ],
    'user' => [
        'index' => [
            'title' => "Quản Lý Thành Viên",
            'table' => [
                'title' => "Danh Sách Thành Viên",
                'table_header' => [
                    'name' => 'Họ Tên',
                    'contact' => 'Số điện thoại / Email',
                    'address' => 'Địa chỉ',
                    'group' => 'Nhóm thành viên',
                ],
                'add_button' => "Thêm mới thành viên",
                'filter_user' => "Chọn nhóm thành viên"
            ],
        ],
        'modal' => [
            'title' => [
                'create' => 'Thêm thành viên mới',
                'edit' => 'Chỉnh sửa thành viên',
            ],
            'common_info' => 'Thông tin chung',
            'name' => 'Họ Tên',
            'name_placeholder' => 'Nhập họ và tên đầy đủ...',
            'email' => 'Email',
            'email_placeholder' => 'Nhập email của bạn...',
            'group' => 'Nhóm thành viên',
            'group_placeholder' => 'Chọn nhóm thành viên...',
            'birthday' => 'Ngày sinh',
            'birthday_placeholder' => 'Chọn ngày sinh (dd/mm/yyyy)...',
            'avatar' => 'Ảnh đại diện',
            'avatar_placeholder' => 'Nhập URL hoặc chọn ảnh...',
            'contact_info' => 'Thông tin liên hệ',
            'city' => 'Thành phố',
            'district' => 'Quận/Huyện',
            'ward' => 'Phường/Xã',
            'address' => 'Địa chỉ',
            'address_placeholder' => 'Nhập địa chỉ (nếu có)...',
            'phone' => 'Số điện thoại',
            'phone_placeholder' => 'Nhập số điện thoại liên hệ...',
            'note' => 'Ghi chú',
            'note_placeholder' => 'Nhập ghi chú (nếu có)...',
            'password' => [
                'label' => 'Mật khẩu',
                'placeholder' => 'Nhập mật khẩu...',
                'confirm_label' => 'Nhập lại mật khẩu',
                'confirm_placeholder' => 'Nhập lại mật khẩu...',
            ],
        ]
    ],
    'customer_catalogue' => [
        'index' => [
            'title' => "Quản lý nhóm khách hàng",
            'table' => [
                'title' => "Danh sách nhóm khách hàng",
                'table_header' => [
                    'name' => 'Tên nhóm',
                    'description' => 'Mô tả',
                    'customer_count' => 'Số lượng thành viên',
                ],
                'add_button' => "Thêm nhóm khách hàng mới",
            ],
        ],
        'permission' => [
            'title' => "Phân quyền",
            'table' => [
                'title' => "Danh sách quyền",
                'table_header' => [
                    'name' => 'Tên quyền',
                ],
            ],
        ],
        'modal' => [
            'title' => [
                'create' => 'Thêm nhóm khách hàng mới',
                'edit' => 'Chỉnh sửa nhóm khách hàng',
            ],
            'name' => 'Tên nhóm khách hàng',
            'phone' => 'Số điện thoại',
            'email' => 'Email',
            'description' => 'Mô tả ngắn',
            'language' => 'Chọn ngôn ngữ hiển thị',
            'name_placeholder' => 'Nhập tên nhóm khách hàng...',
            'phone_placeholder' => 'Nhập số điện thoại...',
            'email_placeholder' => 'Nhập địa chỉ email...',
            'description_placeholder' => 'Nhập mô tả...',
        ],
        'notifications' => [
            'delete_error_customers_exist' => "Không thể xóa nhóm khách hàng vì vẫn còn khách hàng thuộc nhóm này. Vui lòng xóa các khách hàng trước khi xóa nhóm!",
        ]
    ],
    'customer' => [
        'index' => [
            'title' => "Quản lý khách hàng",
            'table' => [
                'title' => "Danh sách khách hàng",
                'table_header' => [
                    'name' => 'Họ và tên',
                    'contact' => 'Số điện thoại / Email',
                    'address' => 'Địa chỉ',
                    'group' => 'Nhóm khách hàng',
                ],
                'add_button' => "Thêm khách hàng mới",
                'filter_customer' => "Lọc theo nhóm khách hàng"
            ],
        ],
        'modal' => [
            'title' => [
                'create' => 'Thêm khách hàng mới',
                'edit' => 'Chỉnh sửa thông tin khách hàng',
            ],
            'common_info' => 'Thông tin chung',
            'name' => 'Họ và tên',
            'name_placeholder' => 'Nhập họ và tên đầy đủ...',
            'email' => 'Email',
            'email_placeholder' => 'Nhập địa chỉ email...',
            'group' => 'Nhóm khách hàng',
            'group_placeholder' => 'Chọn nhóm khách hàng...',
            'birthday' => 'Ngày sinh',
            'birthday_placeholder' => 'Chọn ngày sinh (dd/mm/yyyy)...',
            'avatar' => 'Ảnh đại diện',
            'avatar_placeholder' => 'Nhập URL ảnh hoặc chọn ảnh từ thiết bị...',
            'contact_info' => 'Thông tin liên hệ',
            'city' => 'Tỉnh/Thành phố',
            'district' => 'Quận/Huyện',
            'ward' => 'Phường/Xã',
            'address' => 'Địa chỉ',
            'address_placeholder' => 'Nhập địa chỉ (nếu có)...',
            'phone' => 'Số điện thoại',
            'phone_placeholder' => 'Nhập số điện thoại liên hệ...',
            'note' => 'Ghi chú',
            'note_placeholder' => 'Nhập ghi chú (nếu có)...',
            'password' => [
                'label' => 'Mật khẩu',
                'placeholder' => 'Nhập mật khẩu...',
                'confirm_label' => 'Xác nhận mật khẩu',
                'confirm_placeholder' => 'Nhập lại mật khẩu...',
            ],
        ]
    ],
    'permission' => [
        'index' => [
            'title' => "Quản Lý Quyền",
            'table' => [
                'title' => "Danh Sách Quyền",
                'table_header' => [
                    'name' => 'Quyền',
                    'canonical' => 'Định danh (Canonical)'
                ],
                'add_button' => "Thêm mới quyền",
            ],
        ],
        'modal' => [
            'title' => [
                'create' => 'Thêm mới quyền',
                'edit' => 'Chỉnh sửa quyền',
            ],
            'name' => 'Tên quyền',
            'name_placeholder' => 'Nhập tên quyền...',
            'canonical' => 'Định danh (Canonical)',
            'canonical_placeholder' => 'Nhập định danh (canonical)...',
        ]
    ],
    'post_catalogue' => [
        'index' => [
            'title' => "Quản Lý Nhóm Bài Viết",
            'table' => [
                'title' => "Danh Sách Nhóm Bài Viết",
                'add_button' => "Thêm mới nhóm bài viết",
            ],
        ],
        'create' => [
            'title' => "Thêm Mới Nhóm Bài Viết",
        ],
        'edit' => [
            'title' => "Cập Nhật Nhóm Bài Viết",
        ],
        'notifications' => [
            
        ]
    ],
    'post' => [
        'index' => [
            'title' => "Quản Lý Bài Viết",
            'table' => [
                'title' => "Danh Sách Bài Viết",
                'add_button' => "Thêm mới bài viết",
            ],
        ],
        'create' => [
            'title' => "Thêm Mới Bài Viết",
        ],
        'edit' => [
            'title' => "Cập Nhật Bài Viết",
        ],
        'notifications' => [
            
        ]
    ],
    'product_catalogue' => [
        'index' => [
            'title' => "Quản Lý Nhóm Sản Phẩm",
            'table' => [
                'title' => "Danh Sách Nhóm Sản Phẩm",
                'add_button' => "Thêm mới nhóm Sản Phẩm",
            ],
        ],
        'create' => [
            'title' => "Thêm Mới Nhóm Sản Phẩm",
        ],
        'edit' => [
            'title' => "Cập Nhật Nhóm Sản Phẩm",
        ],
        'notifications' => [
            
        ]
    ],
    'product' => [
        'index' => [
            'title' => "Quản Lý Sản Phẩm",
            'table' => [
                'title' => "Danh Sách Sản Phẩm",
                'add_button' => "Thêm mới sản phẩm",
            ],
        ],
        'create' => [
            'title' => "Thêm Mới Sản Phẩm",
        ],
        'edit' => [
            'title' => "Cập Nhật Sản Phẩm",
        ],
        'notifications' => [
            
        ],
        'step_4_title' => 'Sản phẩm có nhiều phiên bản',
        'step_4_description' => 'Cấu hình các biến thể cho sản phẩm',
        'step_5_title' => 'Danh sách biến thể',
        'step_5_description' => 'Thiết lập các phiên bản sản phẩm',
        'has_variant_label' => 'Sản phẩm này có nhiều biến thể, ví dụ như màu sắc, kích thước khác nhau.',
        'choose_attribute_group' => 'Chọn nhóm thuộc tính',
        'choose_attribute_value' => 'Chọn giá trị của thuộc tính (Nhập từ khóa để tìm kiếm)',
        'add_variant_button' => 'Thêm phiên bản mới',
        'product_variant_required' => 'Bạn phải nhập vào Giá và Mã sản phẩm để sử dụng chức năng này!',
        'input_attribute_value' => 'Nhập giá trị thuộc tính',

        'update_variant_info' => 'Cập nhật thông tin phiên bản sản phẩm',
        'stock_info' => 'Thông tin tồn kho',
        'quantity' => 'Số lượng tồn kho',
        'enter_quantity' => 'Nhập số lượng...',
        'sku' => 'Mã SKU',
        'enter_sku' => 'Nhập mã SKU...',
        'price' => 'Giá bán',
        'enter_price' => 'Nhập giá bán...',
        'barcode' => 'Mã vạch (Barcode)',
        'enter_barcode' => 'Nhập mã vạch...',
    
        'file_management' => 'Quản lý tệp',
        'file_name' => 'Tên tệp',
        'enter_file_name' => 'Nhập tên tệp...',
        'file_url' => 'Đường dẫn tệp',
        'enter_file_url' => 'Nhập đường dẫn tệp...',
        'aside' => [
            'card' => [
                'title' => 'Thông tin sản phẩm',
                'description' => 'Nhập thông tin sản phẩm bên dưới.',
            ],
            'form' => [
                'code' => [
                    'label' => 'Mã sản phẩm',
                    'placeholder' => 'Nhập mã sản phẩm',
                ],
                'made_in' => [
                    'label' => 'Xuất xứ',
                    'placeholder' => 'Nhập xuất xứ sản phẩm',
                ],
                'price' => [
                    'label' => 'Giá bán',
                    'placeholder' => 'Nhập giá bán sản phẩm',
                ],
            ],
        ]
    ],
    'attribute_catalogue' => [
        'index' => [
            'title' => "Quản Lý Loại Thuộc Tính",
            'table' => [
                'title' => "Danh Sách Loại Thuộc Tính",
                'add_button' => "Thêm mới loại thuộc tính",
            ],
        ],
        'create' => [
            'title' => "Thêm Mới Loại Thuộc Tính",
        ],
        'edit' => [
            'title' => "Cập Nhật Loại Thuộc Tính",
        ],
        'notifications' => [
            
        ]
    ],
    'attribute' => [
        'index' => [
            'title' => "Quản Lý Thuộc Tính",
            'table' => [
                'title' => "Danh Sách Thuộc Tính",
                'add_button' => "Thêm mới thuộc tính",
            ],
        ],
        'create' => [
            'title' => "Thêm Mới Thuộc Tính",
        ],
        'edit' => [
            'title' => "Cập Nhật Thuộc Tính",
        ],
        'notifications' => [
            
        ]
    ],
    'menu' => [
        'index' => [
            'title' => "Quản lý Menu",
            'table' => [
                'title' => "Danh sách các menu hiện có",
                'table_header' => [
                    'name' => 'Tên của Menu',
                    'canonical' => 'Đường dẫn tĩnh (Canonical)',
                ],
                'add_button' => "Thêm Menu mới",
            ],
        ],
        'create' => [
            'title' => "Tạo Menu mới",
        ],
        'children' => [
            'title' => "Chỉnh sửa Menu con",
        ],
        'translate' => [
            'title' => "Thêm bản dịch cho Menu",
            'original_language' => 'Ngôn ngữ gốc',
            'save' => 'Lưu',
            'name' => 'Tên menu',
            'name_placeholder' => 'Nhập tên menu',
            'name_helper' => 'Tên hiển thị trên giao diện',
            'link' => 'Đường dẫn',
            'link_placeholder' => 'Nhập đường dẫn',
            'link_helper' => 'URL tĩnh cho menu',
            'item' => 'Menu #:number',
        ],
        'edit' => [
            'title' => "Chỉnh sửa Menu",
        ],
        'setup' => [
            'title' => 'Thiết lập các danh mục',
            'description' => 'Lựa chọn khu vực mà bạn muốn menu xuất hiện trên website.',
        ],
        'custom_link' => [
            'title' => 'Liên kết tự tạo',
            'tips' => [
                'title' => 'Cài đặt Menu mà bạn muốn hiển thị.',
                'items' => [
                    'path_working' => 'Khi khởi tạo menu, hãy chắc chắn rằng đường dẫn có hoạt động.',
                    'path_modules' => 'Đường dẫn được tạo ở các module như: Bài viết, Sản phẩm, Dự án,...',
                    'required_fields' => '<strong>Tiêu đề</strong> và <strong>đường dẫn</strong> không được để trống.',
                    'max_levels' => 'Hệ thống hỗ trợ tối đa <strong>5 cấp menu</strong>.'
                ]
            ],
            'add_button' => 'Thêm đường dẫn',
        ],
        'management' => [
            'title' => 'Quản lý Menu',
            'columns' => [
                'name' => 'Tên Menu',
                'path' => 'Đường dẫn',
                'position' => 'Vị trí',
                'actions' => 'Thao tác',
            ],
            'empty_state' => [
                'title' => 'Chưa có menu nào được tạo',
                'description' => 'Vui lòng thêm các liên kết menu từ sidebar bên trái'
            ],
            'name_placeholder' => 'Tên menu (VD: Trang chủ)',
            'canonical_placeholder' => 'Đường dẫn (VD: trang-chu)',
            'order_placeholder' => 'Thứ tự hiển thị (VD: 1)',
        ],
        'module' => [
            'search_placeholder' => 'Nhập kí tự để tìm kiếm...',
            'loading' => 'Đang tải dữ liệu...',
            'buttons' => [
                'refresh' => 'Làm mới',
                'apply' => 'Áp dụng',
            ],
        ],
        'errors' => [
            'general' => 'Đã xảy ra lỗi!',
            'validation' => 'Có :count lỗi cần sửa:',
        ],
        'position' => [
            'title' => 'Chọn vị trí hiển thị Menu',
            'description' => 'Lựa chọn khu vực mà bạn muốn menu xuất hiện trên website.',
            'label' => 'Vị trí hiển thị',
            'placeholder' => '-- Chọn vị trí hiển thị --',
            'create_button' => 'Tạo vị trí hiển thị',
        ],
        'modal' => [
            'title' => 'Thêm mới vị trí hiển thị menu',
            'fields' => [
                'required_note' => 'Các trường có dấu <span class="text-danger">(*)</span> là bắt buộc.',
                'position_name' => [
                    'label' => 'Tên vị trí hiển thị',
                    'placeholder' => 'Ví dụ: Menu chính, Menu footer...',
                ],
                'keyword' => [
                    'label' => 'Từ khóa',
                    'placeholder' => 'Ví dụ: main-menu, footer-menu...',
                ],
            ],
            'buttons' => [
                'close' => 'Hủy bỏ',
                'submit' => 'Lưu lại',
            ],
            'icons' => [
                'close' => 'Đóng',
                'save' => 'Lưu',
                'required' => 'Trường bắt buộc',
            ],
        ],
        'menu_management' => 'Quản lý Menu',
        'quick_guide' => 'Hướng dẫn nhanh',
        'update_menu' => 'Cập nhật menu',
        'update_menu_description' => 'Sử dụng nút "Cập nhật menu" để chỉnh sửa các menu cấp 1',
        'sort_menu' => 'Sắp xếp menu',
        'sort_menu_description' => 'Kéo thả để thay đổi thứ tự hiển thị menu',
        'manage_submenu' => 'Quản lý menu con',
        'manage_submenu_description' => 'Nhấn "Quản lý menu con" để thêm các danh mục con',
        'multi_level_menu' => 'Đa cấp menu',
        'multi_level_menu_description' => 'Hệ thống hỗ trợ menu đa cấp đến 5 cấp',
        'auto_translate' => 'Dịch tự động',
        'update_level1_menu' => 'Cập nhật Menu cấp 1',
        'help' => 'Trợ giúp',
    ],
    'slide' => [
        'index' => [
            'title' => "Quản Lý Banner & Slide",
            'table' => [
                'title' => "Danh Sách Banner & Slide",
                'add_button' => "Thêm mới Banner & Slide",
                'name' => 'Tên Slide',
                'keyword' => 'Từ Khóa'
            ],
        ],
        'create' => [
            'title' => "Thêm Mới Banner & Slide",
        ],
        'edit' => [
            'title' => "Cập Nhật Banner & Slide",
        ],
        'basic_settings' => [
            'title' => 'Thiết lập cơ bản',
            'description' => 'Cấu hình các thông số cơ bản',
            'fields' => [
                'name' => [
                    'label' => 'Tên slide',
                    'placeholder' => 'Nhập tên slide',
                    'help' => 'Tên hiển thị của slide',
                ],
                'keyword' => [
                    'label' => 'Từ khóa',
                    'placeholder' => 'Nhập từ khóa định danh',
                    'help' => 'Từ khóa duy nhất để nhận diện slide',
                ],
                'dimensions' => [
                    'title' => 'Thông số kích thước',
                    'width' => 'Chiều rộng',
                    'height' => 'Chiều cao',
                    'unit' => 'px',
                ],
                'animation' => [
                    'label' => 'Hiệu ứng chuyển tiếp',
                ],
                'navigation' => [
                    'arrows' => 'Hiển thị nút điều hướng',
                    'type' => 'Kiểu điều hướng',
                ],
            ],
        ],
        'advanced_settings' => [
            'title' => 'Thiết lập nâng cao',
            'description' => 'Cấu hình các thông số nâng cao',
            'autoplay' => [
                'label' => 'Tự động chạy',
                'help' => 'Slide sẽ tự động chuyển ảnh khi bật',
            ],
            'pause_hover' => [
                'label' => 'Dừng khi di chuột',
                'help' => 'Tạm dừng chuyển ảnh khi người dùng di chuột vào',
            ],
            'animation' => [
                'title' => 'Hiệu ứng',
                'delay' => [
                    'label' => 'Thời gian chờ',
                    'help' => 'Thời gian chờ giữa các lần chuyển ảnh',
                    'placeholder' => '3000',
                    'unit' => 'ms',
                ],
                'speed' => [
                    'label' => 'Tốc độ chuyển',
                    'help' => 'Thời gian hoàn thành hiệu ứng chuyển ảnh',
                    'placeholder' => '500',
                    'unit' => 'ms',
                ],
            ],
        ],
        'shortcode' => [
            'title' => 'Mã Nhúng',
            'description' => 'Cấu hình mã nhúng tùy chỉnh',
            'label' => 'Mã nhúng tùy chỉnh',
            'placeholder' => 'Dán mã HTML/JavaScript tại đây...',
            'help' => 'Sử dụng để nhúng mã tùy chỉnh vào slide',
        ],
        'list' => [
            'title' => 'Danh sách Slides',
            'description' => 'Cấu hình các thông số cơ bản cho từng Slide',
            'add_slide' => 'Thêm Slide',
            'empty_state' => [
                'icon' => 'bx-slider-alt',
                'title' => 'Chưa có slide nào được tạo',
                'description' => 'Bấm vào nút "Thêm Slide" để bắt đầu tạo slide mới',
            ],
            'tabs' => [
                'general' => 'Thông tin chung',
                'seo' => 'SEO',
            ],
            'fields' => [
                'description' => 'Mô tả slide',
                'description_placeholder' => 'Nhập mô tả cho slide...',
                'canonical' => 'Đường dẫn tĩnh',
                'new_tab' => 'Mở tab mới',
                'alt' => 'Tiêu đề ảnh (ALT)',
                'alt_placeholder' => 'Nhập tiêu đề SEO...',
                'title' => 'Mô tả ảnh (Title)',
                'title_placeholder' => 'Nhập mô tả SEO...',
            ],
            'buttons' => [
                'delete' => 'Xóa',
            ],
        ],
    ],
    'order' => [
        'index' => [
            'title' => "Quản Lý Đơn Hàng",
            'table' => [
                'title' => "Danh Sách Đơn Hàng",
                'add_button' => "Thêm mới đơn hàng",
                'order_code' => 'Mã đơn',
                'order_date' => 'Ngày đặt',
                'customer' => 'Khách hàng',
                'payment_method' => 'Hình thức TT',
                'shipping_method' => 'Hình thức VC',
                'total_price' => 'Tổng tiền',
                'payment_status' => 'Trạng thái TT',
                'delivery_status' => 'Trạng thái GH',
                'confirmation' => 'Xác nhận',
                'actions' => 'Thao tác',
            ],
        ],
        'details' => [
            'title' => 'Chi tiết đơn hàng',
            'order_code' => 'Mã đơn hàng',
            'customer' => 'Khách hàng',
            'shipping_address' => 'Địa chỉ giao hàng',
            'payment_method' => 'Phương thức thanh toán',
            'order_items' => 'Chi tiết hóa đơn',
            'products_count' => ':count sản phẩm',
            'product' => 'Sản phẩm',
            'price' => 'Giá',
            'quantity' => 'Số lượng',
            'total' => 'Tổng tiền',
            'order_summary' => 'Tóm tắt đơn hàng',
            'subtotal' => 'Tạm tính',
            'discount' => 'Giảm giá',
            'shipping_fee' => 'Phí vận chuyển',
            'grand_total' => 'Tổng cộng',
            'order_status' => 'Tình trạng đơn hàng',
            'invoice' => 'Hóa đơn',
            'download_invoice' => 'Tải hóa đơn',
            'confirm_status' => 'Tình trạng xác nhận',
            'payment_status' => 'Tình trạng thanh toán',
            'delivery_status' => 'Tình trạng giao hàng',
            'shipping_details' => 'Chi tiết vận chuyển',
            'track_order' => 'Theo dõi đơn hàng',
            'documents' => 'Tài liệu',
            'invoice_number' => 'Số hóa đơn',
            'shipping_number' => 'Số vận đơn',
            'edit' => 'Sửa',
            'estimated_delivery' => 'Dự kiến giao',
            'modal' => [
                'update_customer_info' => 'Cập nhật thông tin khách hàng',
                'update_customer_address' => 'Cập nhật địa chỉ khách hàng',
                'update_invoice_status' => 'Cập nhật tình trạng hóa đơn',
            ],
        ],

        'date_format' => 'd/m/Y H:i',
    ],
    'widget' => [
        'index' => [
            'title' => "Quản Lý Widget",
            'table' => [
                'title' => "Danh Sách Widget",
                'add_button' => "Thêm mới Widget",
            ],
        ],
        'create' => [
            'title' => "Thêm Mới Widget",
        ],
        'edit' => [
            'title' => "Cập Nhật Widget",
        ],
        'translate' => [
            'title' => 'Dịch nội dung'
        ],
        'notifications' => [
            
        ],
        'content_configuration' => [
            'title' => 'Cấu hình nội dung widget',
            'description' => 'Thiết lập cho các nội dung widget',
            'module_section' => [
                'title' => 'Module',
                'select_placeholder' => 'Chọn các danh mục theo module đã chọn',
            ],
            'search_section' => [
                'empty_state' => [
                    'icon' => 'bx bx-search-alt',
                    'text' => 'Nhập từ khóa để tìm kiếm sản phẩm'
                ],
                'item_template' => [
                    'path_label' => 'Đường dẫn:',
                    'name_validate' => 'Vui lòng nhập tiêu đề.',
                    'keyword_validate' => 'Vui lòng nhập từ khóa.',
                    'module_validate' => 'Vui lòng chọn ít nhất một mục để thêm vào widget.'
                ]
            ]
        ],
        'fields' => [
            'name' => [
                'label' => 'Tên Widget',
                'placeholder' => 'Nhập tên widget',
            ],
            'keyword' => [
                'label' => 'Từ khóa Widget',
                'placeholder' => 'Nhập từ khóa Widget',
            ],
        ]
    ],
    'language' => [
        'index' => [
            'title' => "Quản Lý Ngôn Ngữ",
            'table' => [
                'title' => "Danh sách ngôn ngữ",
                'table_header' => [
                    'image' => 'Ảnh đại diện',
                    'name' => 'Tên ngôn ngữ',
                    'description' => 'Mô tả',
                    'canonical' => 'Đường dẫn chuẩn (Canonical)',
                ],
                'add_button' => "Thêm ngôn ngữ mới",
            ],
        ],
        'translate' => [
            'title' => "Dịch nội dung",
        ],
        'modal' => [
            'title' => [
                'create' => 'Thêm ngôn ngữ mới',
                'edit' => 'Chỉnh sửa ngôn ngữ'
            ],
            'name' => 'Tên ngôn ngữ',
            'canonical' => 'Đường dẫn chuẩn (Canonical)',
            'description' => 'Mô tả ngắn',
            'image' => 'Ảnh đại diện',
            'name_placeholder' => 'Nhập tên ngôn ngữ...',
            'canonical_placeholder' => 'Nhập đường dẫn chuẩn...',
            'description_placeholder' => 'Nhập mô tả ngắn...',
            'image_placeholder' => 'Chọn ảnh đại diện...',
        ]
    ],
    'system' => [
        'index' => [
            'title' => "Cấu hình hệ thống",
        ],
    ],
    'review' => [
        'index' => [
            'title' => "Quản Lý Bình Luận",
            'table' => [
                'title' => "Danh Sách Bình Luận",
                'table_header' => [
                    'name' => 'Họ Tên',
                    'email' => 'Email',
                    'phone' => "Số điện thoại",
                    'description' => "Nội dung",
                    'score' => "Đánh giá",
                    'like_count' => "Lượt thích",
                    'review_type' => "Loại đánh giá"
                ],
            ],
        ],
    ],
    'promotion' => [
        'index' => [
            'title' => "Quản Lý Khuyến Mại",
            'table' => [
                'title' => "Danh Sách Khuyến Mại",
                'add_button' => "Thêm mới khuyến mại",
                'tableHeader' => [
                    'program_name' => 'Tên chương trình',
                    'discount' => 'Chiết khấu',
                    'information' => 'Thông tin',
                    'start_date' => 'Ngày bắt đầu',
                    'end_date' => 'Ngày kết thúc',
                    'status' => 'Trạng thái',
                    'actions' => 'Hành động',
                ]
            ],
        ],
        'create' => [
            'title' => "Thêm Mới Khuyến Mại",
        ],
        'edit' => [
            'title' => "Cập Nhật Khuyến Mại",
        ],
        'notifications' => [
            
        ],
        'aside' => [
            'time' => [
                'title' => 'Thời gian áp dụng chương trình',
                'description' => 'Thiết lập thời gian áp dụng chương trình',
                'start_date' => 'Ngày bắt đầu',
                'end_date' => 'Ngày kết thúc',
                'never_end' => 'Không có ngày kết thúc',
            ],
            
            'source' => [
                'title' => 'Nguồn khách áp dụng',
                'description' => 'Thiết lập các áp dụng bên dưới',
                'scope' => 'Phạm vi áp dụng',
                'all_channels' => 'Toàn bộ kênh',
                'all_channels_desc' => 'Áp dụng cho mọi nguồn khách hàng',
                'specific_channels' => 'Kênh cụ thể',
                'specific_channels_desc' => 'Chọn nguồn khách hàng được ưu đãi',
                'select_channels' => 'Chọn kênh',
                'select_channels_placeholder' => 'Chọn kênh tương ứng',
            ],
            
            'object' => [
                'title' => 'Đối tượng áp dụng',
                'description' => 'Thiết lập phạm vi đối tượng bên dưới',
                'scope' => 'Phạm vi đối tượng',
                'all_customers' => 'Tất cả khách hàng',
                'all_customers_desc' => 'Áp dụng cho mọi đối tượng',
                'customer_groups' => 'Nhóm khách hàng',
                'customer_groups_desc' => 'Chỉ áp dụng cho nhóm được chọn',
                'select_groups' => 'Chọn đối tượng khách hàng',
                'select_groups_placeholder' => 'Chọn đối tượng khách hàng',
            ],
        ],
        'general' => [
            'title' => 'Thông tin cơ bản',
            'description' => 'Cấu hình thông tin chính của chương trình',
            'name_label' => 'Tên chương trình khuyến mãi',
            'name_placeholder' => 'Nhập tên chương trình khuyến mãi',
            'code_label' => 'Mã ưu đãi',
            'code_placeholder' => 'Nhập mã ưu đãi',
            'content_label' => 'Nội dung khuyến mãi',
            'content_placeholder' => 'Mô tả chi tiết chương trình khuyến mãi',
            'required' => '<i class="uil uil-exclamation-circle text-danger"></i>',
        ],
        'details' => [
            'title' => 'Cài đặt thông tin chi tiết khuyến mại',
            'description' => 'Cấu hình các thông tin bên dưới',
            'method_label' => 'Chọn hình thức khuyến mãi',
            'method_placeholder' => 'Chọn hình thức',
            'order_amount' => [
                'from' => 'Giá trị từ',
                'to' => 'Giá trị đến',
                'discount' => 'Chiết khấu',
                'order_from' => 'Giá trị đơn hàng từ',
                'order_to' => 'Đến giá trị',
                'discount_level' => 'Mức chiết khấu',
                'from_placeholder' => 'Nhập giá trị bắt đầu',
                'to_placeholder' => 'Nhập giá trị kết thúc',
                'discount_placeholder' => 'Nhập số tiền chiết khấu',
                'currency' => 'đ',
                'percent' => '%',
                'add_condition' => 'Thêm điều kiện',
                'invalid_value' => 'Giá trị đến không hợp lệ!',
                'value_compare' => 'Giá trị "đến" phải lớn hơn hoặc bằng "từ"!',
                'range_conflict' => 'Phạm vi này đã tồn tại hoặc bị chồng lấn!'
            ],
            'product_quantity' => [
                'title' => 'Sản phẩm áp dụng',
                'select_option' => 'Chọn hình thức',
                'table' => [
                    'product' => 'Sản phẩm',
                    'discount_limit' => 'Giới hạn chiết khấu',
                    'discount_amount' => 'Mức chiết khấu',
                    'select_product_placeholder' => 'Nhấn vào đây để chọn sản phẩm',
                    'max_discount_placeholder' => 'Nhập mức giới hạn chiết khấu',
                    'discount_value_placeholder' => 'Nhập giá trị chiết khấu',
                    'currency_symbol' => 'đ',
                    'percent_symbol' => '%',
                ],
                'product_row' => [
                    'product_name' => 'Tên sản phẩm',
                    'product_details' => 'Thông tin chi tiết',
                    'no_name' => '(Chưa có tên)',
                    'sku' => 'Mã SP:',
                    'inventory' => 'Tồn kho:',
                    'could_sell' => 'Có thể bán:',
                ],
                'product_catalogue_row' => [
                    'product_catalogue_name' => 'Tên loại sản phẩm',
                ],
            ],
            'select_product_prompt' => 'Nhấn vào đây để chọn sản phẩm....',
            'select_product_warning' => 'Vui lòng chọn sản phẩm áp dụng!',
            'select_at_least_one_product' => 'Vui lòng chọn ít nhất một sản phẩm!',
            'customer_select' => [
                'label' => 'Chọn đối tượng khách hàng',
                'placeholder' => 'Chọn đối tượng khách hàng'
            ],
            'promotion_table_details' => [
                'view_details' => 'Xem chi tiết',
                'max_discount' => 'Tối đa:',
                'no_expiry' => 'Không hết hạn',
                'expired' => 'Hết hạn',
                'discount_types' => [
                    'percent' => ':value%',
                    'cash' => ':amountđ'
                ],
                'date_format' => 'd/m/Y H:i'
            ],
        ],
    ],
    'notifications' => [
        'create_success' => "Tạo mới thành công!",
        'create_error' => "Có lỗi xảy ra khi tạo mới dữ liệu!",
        'update_success' => "Cập nhật thông tin thành công!",
        'update_error' => "Có lỗi xảy ra khi cập nhật dữ liệu!",
        'delete_success' => "Xóa dữ liệu thành công!",
        'delete_error' => "Có lỗi xảy ra khi xóa dữ liệu!",
        'not_found' => "Không tìm thấy dữ liệu yêu cầu.",
        'no_changes' => "Không có thay đổi nào được thực hiện.",
        'translation_saved_successfully' => 'Lưu bản dịch thành công.',
        'error_saving_translation' => 'Đã xảy ra lỗi khi lưu bản dịch.',
    ],
    'publish' => [
        '' => 'Chọn tình trạng',
        '2' => 'Xuất bản',
        '1' => 'Không xuất bản',
    ],
    'perpage' => 'bản ghi',
    'keyword_placeholder' => 'Tìm kiếm...',
    'status' => 'Tình trạng',
    'actions' => [
        'title' => 'Thao tác',
        'edit' => 'Chỉnh sửa',
        'translate' => 'Dịch',
        'delete' => "Xóa",
        'cancel' => 'Hủy bỏ',
        'save' => 'Lưu lại',
    ],
    'confirmJs' => [
        'title' => "Bạn có chắc chắn?",
        'text' => "Bạn sẽ không thể hoàn tác hành động này!",
        'confirmButton' => "Có, xóa nó!",
        'cancelButton' => "Hủy bỏ",
        'successTitle' => "Đã xóa!",
        'errorTitle' => "Lỗi!",
        'deleteSuccess' => "Xóa thành công.",
        'deleteError' => "Đã xảy ra lỗi khi xóa!",
        'generalError' => "Đã có lỗi xảy ra xin vui lòng thử lại!"
    ],
    "modal" => [
        'close' => 'Đóng',
        'confirm' => 'Xác nhận',
    ],
    'icon_explanation' => 'Giải thích biểu tượng:',
    'translated' => 'Đã dịch',
    'not_translated' => 'Chưa dịch',
    'cannot_be_empty' => 'Thông tin không được bỏ trống',
    'original_language' => 'Ngôn ngữ gốc',
    'required_fields' => 'Các trường có biểu tượng :icon là bắt buộc nhập.',
    'configuration' => 'Cấu hình SEO',
    'setup_title_description_keywords' => 'Thiết lập tiêu đề, mô tả, từ khóa SEO',
    'seo_default' => [
        'no_seo_title' => 'Bạn chưa có tiêu đề SEO',
        'default_canonical' => url('/') . '/' . 'duong-dan-cua-ban' . config('apps.general.suffix'),
        'no_seo_description' => 'Bạn chưa có mô tả SEO',
    ],
    'seo_title' => 'Tiêu đề SEO',
    'enter_seo_title' => 'Nhập tiêu đề SEO',
    'seo_keywords' => 'Từ khóa SEO',
    'enter_seo_keywords' => 'Nhập từ khóa SEO',
    'seo_description' => 'Mô tả SEO',
    'enter_seo_description' => 'Nhập mô tả SEO',
    'keyword' => 'Từ khóa',
    'enter_keyword' => 'Nhập từ khóa',
    'general_information' => 'Thông tin chung',
    'enter_title_description_content' => 'Nhập tiêu đề, mô tả và nội dung',
    'title' => 'Tiêu đề',
    'enter_title' => 'Nhập tiêu đề',
    'short_description' => 'Mô tả ngắn',
    'enter_short_description' => 'Nhập mô tả ngắn',
    'content' => 'Nội dung',
    'enter_content' => 'Nhập nội dung chi tiết',
    'upload_image' => 'Upload hình ảnh',
    'advanced_settings' => 'Cấu hình nâng cao',
    'configure_category_status_navigation' => 'Thiết lập danh mục, tình trạng và điều hướng',
    'parent_category' => 'Danh mục cha',
    'select_root_if_no_parent' => 'Chọn <strong>Root</strong> nếu không có danh mục cha.',
    'navigation' => 'Điều hướng',
    'featured_image' => 'Ảnh đại diện',
    'select_representative_image' => 'Chọn ảnh minh họa chung',
    'preview_image' => 'Ảnh xem trước',
    'save' => 'Lưu lại',
    'translations' => [
        'supported_languages' => "Ngôn ngữ hỗ trợ:",
        'no_languages' => "Chưa có ngôn ngữ hỗ trợ",
    ],
    'cannot_delete_category' => 'Không thể xóa danh mục này vì vẫn còn danh mục con.',
    'assign_permission' => 'Phân quyền',
    'album' => [
        'album_title' => 'Album Ảnh',
        'album_description' => 'Chọn và tải lên ảnh cho sản phẩm',
        'upload_placeholder' => 'Kéo và thả tệp vào đây hoặc nhấn để tải lên.',
    ],
    'day' => 'Ngày',
    'month' => 'Tháng',
    'quantity_title' => 'Số lượng',
];
