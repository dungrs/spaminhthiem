<?php 
return [
    'user' => [
        'email' => [
            'required' => 'Vui lòng nhập email.',
            'email' => 'Định dạng email không hợp lệ. Ví dụ: abc@gmail.com.',
            'unique' => 'Email này đã được sử dụng. Vui lòng chọn email khác.',
            'string' => 'Email phải là chuỗi ký tự hợp lệ.',
            'max' => 'Email không được vượt quá 250 ký tự.',
        ],
        'name' => [
            'required' => 'Vui lòng nhập họ và tên.',
            'string' => 'Họ và tên phải là chuỗi ký tự hợp lệ.',
        ],
        'user_catalogue_id' => [
            'required' => 'Vui lòng chọn nhóm thành viên.',
            'integer' => 'Nhóm thành viên không hợp lệ.',
            'gt' => 'Vui lòng chọn nhóm thành viên hợp lệ.',
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
];