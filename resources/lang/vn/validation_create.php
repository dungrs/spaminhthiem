<?php 

return [
    'source' => [
        'name' => [
            'required' => 'Bạn chưa nhập tên của nguồn khách',
        ],
        'keyword' => [
            'required' => 'Bạn chưa nhập từ khóa của nguồn khách',
            'unique' => 'Từ khóa đã tồn tại, hãy chọn từ khóa khác',
        ],
    ],
    'user' => [
        'email' => [
            'required' => 'Vui lòng nhập email.',
            'email' => 'Email không hợp lệ. Ví dụ: abc@gmail.com.',
            'unique' => 'Email này đã được sử dụng. Vui lòng chọn email khác.',
            'string' => 'Email phải là chuỗi ký tự hợp lệ.',
            'max' => 'Email không được vượt quá 250 ký tự.',
        ],
        'name' => [
            'required' => 'Vui lòng nhập họ và tên.',
            'string' => 'Họ và tên phải là chuỗi ký tự hợp lệ.',
        ],
        'user_catalogue_id' => [
            'gt' => 'Vui lòng chọn nhóm thành viên hợp lệ.',
            'required' => 'Vui lòng chọn nhóm thành viên hợp lệ.',
        ],
        'birthday' => [
            'required' => 'Vui lòng nhập ngày sinh.',
            'date_format' => 'Ngày sinh không đúng định dạng. Vui lòng nhập theo định dạng dd/mm/yyyy.',
        ],
        'password' => [
            'required' => 'Vui lòng nhập mật khẩu.',
            'min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ],
        're_password' => [
            'required' => 'Vui lòng nhập lại mật khẩu.',
            'same' => 'Mật khẩu nhập lại không khớp.',
        ],
    ],
    'user_catalogue' => [
        'name' => [
            'required' => 'Tên nhóm thành viên không được để trống.',
            'string' => 'Tên nhóm thành viên phải là chuỗi.',
            'max' => 'Tên nhóm thành viên không được vượt quá 255 ký tự.',
        ],
        'email' => [
            'required' => 'Email không được để trống.',
            'email' => 'Email nhập không đúng định dạng.',
            'unique' => 'Email này đã được sử dụng. Vui lòng chọn email khác.',
            'max' => 'Email không được vượt quá 250 ký tự.',
        ],
        'phone' => [
            'required' => 'Số điện thoại không được để trống.',
            'string' => 'Số điện thoại phải là chuỗi.',
            'max' => 'Số điện thoại không được vượt quá 20 ký tự.',
        ],
        'description' => [
            'string' => 'Mô tả phải là chuỗi.',
            'max' => 'Mô tả không được vượt quá 500 ký tự.',
        ],
    ],
    'model_catalogue_model' => [
        'name' => [
            'required' => 'Bạn chưa nhập vào ô tiêu đề.',
        ],
        'canonical' => [
            'required' => 'Bạn chưa nhập vào đường dẫn.',
            'unique' => 'Đường dẫn đã tồn tại, hãy chọn đường dẫn khác.',
        ],
    ],
    'language' => [
        'name' => [
            'required' => 'Bạn chưa nhập tên ngôn ngữ.',
        ],
        'canonical' => [
            'required' => 'Bạn chưa nhập vào từ khóa ngôn ngữ.',
            'unique' => 'Từ khóa đã tồn tại, hãy chọn từ khóa khác.',
        ],
    ],
    'translate' => [
        'name' => [
            'required' => 'Bạn chưa nhập tên tiêu đề.',
        ],
        'canonical' => [
            'required' => 'Bạn chưa nhập vào từ khóa.',
            'unique' => 'Từ khóa đã tồn tại, hãy chọn từ khóa khác.',
        ],
    ],
    'product' => [
        'product_catalogue_id' => [
            'required' => 'Vui lòng chọn danh mục sản phẩm.',
            'not_in' => 'Danh mục sản phẩm không hợp lệ.',
        ],
        'attribute' => [
            'array' => 'Dữ liệu thuộc tính sản phẩm không hợp lệ.',
            'min_empty' => 'Vui lòng chọn ít nhất một thuộc tính sản phẩm.',
            'missing' => 'Vui lòng chọn ít nhất một thuộc tính sản phẩm.',
        ],
    ],
    'post' => [
        'post_catalogue_id' => [
            'required' => 'Vui lòng chọn danh mục bài viết.',
            'not_in' => 'Danh mục bài viết không hợp lệ.',
        ],
    ],
    'attribute' => [
        'attribute_catalogue_id' => [
            'required' => 'Vui lòng chọn danh mục thuộc tính.',
            'not_in' => 'Danh mục thuộc tính không hợp lệ.',
        ],
    ],
    'menu_catalogue' => [
        'name' => [
            'required' => 'Bạn chưa nhập vào tên nhóm menu.',
        ],
        'keyword' => [
            'required' => 'Bạn chưa nhập từ khóa của menu.',
            'unique' => 'Nhóm menu đã tồn tại.',
        ],
    ],
    'menu' => [
        'menu_catalogue_id' => [
            'required' => 'Bạn phải chọn danh mục menu.',
            'integer' => 'ID danh mục menu phải là số nguyên.',
            'min' => 'ID danh mục menu phải lớn hơn hoặc bằng 1.',
        ],
        'name' => [
            'required' => 'Bạn phải nhập ít nhất một tên menu.',
            'array' => 'Danh sách tên menu phải là một mảng.',
            'min' => 'Phải có ít nhất một tên menu.',
        ],
        'name.*' => [
            'required' => 'Tên menu không được để trống.',
            'string' => 'Tên menu phải là chuỗi ký tự.',
            'max' => 'Tên menu không được vượt quá 255 ký tự.',
        ],
        'canonical' => [
            'required' => 'Bạn phải nhập ít nhất một đường dẫn tĩnh.',
            'array' => 'Danh sách đường dẫn tĩnh phải là một mảng.',
            'min' => 'Phải có ít nhất một đường dẫn tĩnh.',
        ],
        'canonical.*' => [
            'required' => 'Đường dẫn tĩnh không được để trống.',
            'string' => 'Đường dẫn tĩnh phải là chuỗi ký tự.',
            'max' => 'Đường dẫn tĩnh không được vượt quá 255 ký tự.',
            'unique' => 'Đường dẫn tĩnh đã tồn tại trong hệ thống.',
        ],
        'order' => [
            'required' => 'Bạn phải nhập ít nhất một thứ tự hiển thị.',
            'array' => 'Danh sách thứ tự phải là một mảng.',
            'min' => 'Phải có ít nhất một giá trị thứ tự.',
        ],
        'order.*' => [
            'required' => 'Bạn phải nhập giá trị thứ tự.',
            'integer' => 'Giá trị thứ tự phải là số nguyên.',
            'min' => 'Giá trị thứ tự phải lớn hơn hoặc bằng 0.',
        ],
        'id' => [
            'array' => 'ID menu phải là một mảng.',
        ],
        'id.*' => [
            'integer' => 'Mỗi ID trong menu phải là số nguyên.',
            'min' => 'ID không hợp lệ, phải lớn hơn hoặc bằng 0.',
        ],
    ],
    'slide' => [
        'name' => [
            'required' => 'Bạn chưa nhập tên của Slide',
        ],
        'keyword' => [
            'required' => 'Bạn chưa nhập từ khóa Slide',
            'unique' => 'Keyword đã tồn tại. Hãy chọn keyword khác',
        ],
        'image' => [
            'required' => 'Bạn chưa chọn hình ảnh nào cho Slide',
        ],
    ],
    'widget' => [
        'name' => [
            'required' => 'Vui lòng nhập tên Widget.',
        ],
        'keyword' => [
            'required' => 'Vui lòng nhập từ khóa cho Widget.',
            'unique' => 'Từ khóa này đã tồn tại, vui lòng chọn từ khóa khác.',
        ],
        'short_code' => [
            'required' => 'Vui lòng nhập Shortcode.',
            'unique' => 'Shortcode này đã tồn tại, vui lòng chọn Shortcode khác.',
        ],
    ],
    'promotion' => [
        'name' => [
            'required' => 'Bạn chưa nhập tên của khuyến mại',
        ],
        'code' => [
            'required' => 'Bạn chưa nhập từ khóa của khuyến mại',
        ],
        'start_date' => [
            'required' => 'Bạn chưa nhập vào ngày bắt đầu khuyến mại',
            'custom_date_format' => 'Ngày bắt đầu khuyến mãi không đúng định dạng',
            'custom_after_now' => 'Ngày bắt đầu khuyến mãi phải lớn hơn hoặc bằng thời gian hiện tại',
        ],
        'method' => [
            'required' => 'Bạn chưa chọn hình thức khuyến mãi',
            'in' => 'Hình thức khuyến mãi không hợp lệ',
        ],
        'end_date' => [
            'required' => 'Bạn chưa chọn ngày kết thúc khuyến mại',
            'custom_date_format' => 'Ngày kết thúc khuyến mãi không đúng định dạng',
            'custom_after' => 'Ngày kết thúc khuyến mãi phải lớn hơn ngày bắt đầu khuyến mãi',
        ],
        'order_amount_range' => [
            'empty_configuration' => 'Bạn phải khởi tạo giá trị cho khoảng khuyến mãi.',
            'invalid_discount_value' => 'Cấu hình giá trị khuyến mại không hợp lệ.',
            'range_conflict' => 'Có xung đột giữa các khoảng giá trị khuyến mại! Hãy kiểm tra lại dữ liệu',
        ],
        'product_and_quantity' => [
            'invalid_configuration' => 'Cấu hình khuyến mãi không hợp lệ.',
            'missing_discount_value' => 'Bạn phải nhập vào giá trị của chiết khấu.',
            'missing_target_object' => 'Bạn chưa chọn đối tượng áp dụng chiết khấu.',
            // Uncomment if you need this validation
            // 'invalid_quantity' => 'Bạn phải nhập số lượng mua tối thiểu để được hưởng chiết khấu.'
        ],
    ],
    'cart' => [
        'fullname' => [
            'required' => 'Bạn chưa nhập vào Họ Tên',
        ],
        'phone' => [
            'required' => 'Bạn chưa nhập vào Số điện thoại',
        ],
        'email' => [
            'required' => 'Bạn chưa nhập vào email',
            'email' => 'Email chưa đúng định dạng. Ví dụ: abc@gmail.com',
        ],
        'address' => [
            'required' => 'Bạn chưa nhập vào địa chỉ',
        ],
    ],
];
