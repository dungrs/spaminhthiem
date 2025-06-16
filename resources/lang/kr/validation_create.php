<?php 

return [
    'source' => [
        'name' => [
            'required' => '고객 출처 이름을 입력하지 않았습니다',
        ],
        'keyword' => [
            'required' => '고객 출처 키워드를 입력하지 않았습니다',
            'unique' => '이미 존재하는 키워드입니다. 다른 키워드를 선택해 주세요',
        ],
    ],
    'user' => [
        'email' => [
            'required' => '이메일을 입력하세요.',
            'email' => '올바른 이메일 형식이 아닙니다. 예: abc@gmail.com.',
            'unique' => '이미 사용 중인 이메일입니다. 다른 이메일을 선택하세요.',
            'string' => '이메일은 유효한 문자열이어야 합니다.',
            'max' => '이메일은 250자 이하로 입력하세요.',
        ],
        'name' => [
            'required' => '이름을 입력하세요.',
            'string' => '이름은 유효한 문자열이어야 합니다.',
        ],
        'user_catalogue_id' => [
            'gt' => '올바른 회원 그룹을 선택하세요.',
            'required' => '회원 그룹을 선택하세요.',
        ],
        'birthday' => [
            'required' => '생년월일을 입력하세요.',
            'date_format' => '생년월일 형식이 올바르지 않습니다. (예: dd/mm/yyyy)',
        ],
        'password' => [
            'required' => '비밀번호를 입력하세요.',
            'min' => '비밀번호는 최소 6자 이상이어야 합니다.',
        ],
        're_password' => [
            'required' => '비밀번호를 다시 입력하세요.',
            'same' => '비밀번호가 일치하지 않습니다.',
        ],
    ],
    'user_catalogue' => [
        'name' => [
            'required' => '회원 그룹명을 입력하세요.',
            'string' => '회원 그룹명은 문자열이어야 합니다.',
            'max' => '회원 그룹명은 255자 이하로 입력하세요.',
        ],
        'email' => [
            'required' => '이메일을 입력하세요.',
            'email' => '올바른 이메일 형식이 아닙니다.',
            'unique' => '이미 사용 중인 이메일입니다. 다른 이메일을 선택하세요.',
            'max' => '이메일은 250자 이하로 입력하세요.',
        ],
        'phone' => [
            'required' => '전화번호를 입력하세요.',
            'string' => '전화번호는 문자열이어야 합니다.',
            'max' => '전화번호는 20자 이하로 입력하세요.',
        ],
        'description' => [
            'string' => '설명은 문자열이어야 합니다.',
            'max' => '설명은 500자 이하로 입력하세요.',
        ],
    ],
    'model_catalogue_model' => [
        'name' => [
            'required' => '제목을 입력하지 않았습니다.',
        ],
        'canonical' => [
            'required' => 'URL을 입력하지 않았습니다.',
            'unique' => '이 URL은 이미 존재합니다. 다른 URL을 선택하세요.',
        ],
    ],
    'language' => [
        'name' => [
            'required' => '언어 이름을 입력하지 않았습니다.',
        ],
        'canonical' => [
            'required' => '언어 키워드를 입력하지 않았습니다.',
            'unique' => '키워드가 이미 존재합니다. 다른 키워드를 선택하세요.',
        ],
    ],
    'translate' => [
        'name' => [
            'required' => '제목 이름을 입력하지 않았습니다.',
        ],
        'canonical' => [
            'required' => '키워드를 입력하지 않았습니다.',
            'unique' => '해당 키워드는 이미 존재합니다. 다른 키워드를 선택하세요.',
        ],
    ],
    'product' => [
        'product_catalogue_id' => [
            'required' => '상품 카테고리를 선택해 주세요.',
            'not_in' => '유효하지 않은 상품 카테고리입니다.',
        ],
        'attribute' => [
            'array' => '잘못된 상품 속성 데이터입니다.',
            'min_empty' => '최소한 하나의 상품 속성을 선택해 주세요.',
            'missing' => '최소한 하나의 상품 속성을 선택해 주세요.',
        ],
    ],
    'post' => [
        'post_catalogue_id' => [
            'required' => '게시물 카테고리를 선택해 주세요.',
            'not_in' => '유효하지 않은 게시물 카테고리입니다.',
        ],
    ],
    'attribute' => [
        'attribute_catalogue_id' => [
            'required' => '속성 카테고리를 선택해 주세요.',
            'not_in' => '유효하지 않은 속성 카테고리입니다.',
        ],
    ],
    'menu_catalogue' => [
        'name' => [
            'required' => '메뉴 그룹 이름을 입력하지 않았습니다.',
        ],
        'keyword' => [
            'required' => '메뉴 키워드를 입력하지 않았습니다.',
            'unique' => '메뉴 그룹이 이미 존재합니다.',
        ],
    ],
    'menu' => [
        'menu_catalogue_id' => [
            'required' => '메뉴 카테고리를 선택해야 합니다.',
            'integer' => '메뉴 카테고리 ID는 정수여야 합니다.',
            'min' => '메뉴 카테고리 ID는 1 이상이어야 합니다.',
        ],
        'name' => [
            'required' => '적어도 하나의 메뉴 이름을 입력해야 합니다.',
            'array' => '메뉴 이름 목록은 배열이어야 합니다.',
            'min' => '최소한 하나의 메뉴 이름이 있어야 합니다.',
        ],
        'name.*' => [
            'required' => '메뉴 이름은 비워둘 수 없습니다.',
            'string' => '메뉴 이름은 문자열이어야 합니다.',
            'max' => '메뉴 이름은 255자를 넘을 수 없습니다.',
        ],
        'canonical' => [
            'required' => '적어도 하나의 정적 URL을 입력해야 합니다.',
            'array' => '정적 URL 목록은 배열이어야 합니다.',
            'min' => '최소한 하나의 정적 URL이 있어야 합니다.',
        ],
        'canonical.*' => [
            'required' => '정적 URL은 비워둘 수 없습니다.',
            'string' => '정적 URL은 문자열이어야 합니다.',
            'max' => '정적 URL은 255자를 넘을 수 없습니다.',
            'unique' => '정적 URL이 시스템에 이미 존재합니다.',
        ],
        'order' => [
            'required' => '최소한 하나의 표시 순서를 입력해야 합니다.',
            'array' => '순서 목록은 배열이어야 합니다.',
            'min' => '최소한 하나의 순서 값이 있어야 합니다.',
        ],
        'order.*' => [
            'required' => '순서 값을 입력해야 합니다.',
            'integer' => '순서 값은 정수여야 합니다.',
            'min' => '순서 값은 0 이상이어야 합니다.',
        ],
        'id' => [
            'array' => '메뉴 ID는 배열이어야 합니다.',
        ],
        'id.*' => [
            'integer' => '각 메뉴 ID는 정수여야 합니다.',
            'min' => '유효하지 않은 ID입니다. 0 이상이어야 합니다.',
        ],
    ],
    'slide' => [
        'name' => [
            'required' => '슬라이드 이름을 입력하지 않았습니다',
        ],
        'keyword' => [
            'required' => '슬라이드 키워드를 입력하지 않았습니다',
            'unique' => '이미 존재하는 키워드입니다. 다른 키워드를 선택해 주세요',
        ],
        'image' => [
            'required' => '슬라이드에 대한 이미지를 선택하지 않았습니다',
        ],
    ],
    'widget' => [
        'name' => [
            'required' => '위젯 이름을 입력해 주세요.',
        ],
        'keyword' => [
            'required' => '위젯 키워드를 입력해 주세요.',
            'unique' => '해당 위젯 키워드는 이미 존재합니다.',
        ],
        'short_code' => [
            'required' => '쇼트코드를 입력해 주세요.',
            'unique' => '해당 쇼트코드는 이미 존재합니다.',
        ],
    ],
    'promotion' => [
        'name' => [
            'required' => '프로모션 이름을 입력해주세요.',
        ],
        'code' => [
            'required' => '프로모션 키워드를 입력해주세요.',
        ],
        'start_date' => [
            'required' => '프로모션 시작일을 입력해주세요.',
            'custom_date_format' => '잘못된 프로모션 시작일 형식입니다.',
            'custom_after_now' => '프로모션 시작일은 현재 시간과 같거나 이후여야 합니다.',
        ],
        'method' => [
            'required' => '프로모션 방식을 선택해주세요.',
            'in' => '잘못된 프로모션 방식입니다.',
        ],
        'end_date' => [
            'required' => '프로모션 종료일을 선택해주세요.',
            'custom_date_format' => '잘못된 프로모션 종료일 형식입니다.',
            'custom_after' => '프로모션 종료일은 시작일보다 이후여야 합니다.',
        ],
        'order_amount_range' => [
            'empty_configuration' => '프로모션 금액 범위의 값을 설정해주세요.',
            'invalid_discount_value' => '잘못된 프로모션 값 설정입니다.',
            'range_conflict' => '프로모션 금액 범위가 충돌합니다! 데이터를 확인해주세요.',
        ],
        'product_and_quantity' => [
            'invalid_configuration' => '잘못된 프로모션 설정입니다.',
            'missing_discount_value' => '할인 값을 입력해주세요.',
            'missing_target_object' => '할인을 적용할 대상을 선택해주세요.',
            // 'invalid_quantity' => '할인을 받기 위한 최소 구매 수량을 입력해주세요.'
        ],
    ],
    'cart' => [
        'fullname' => [
            'required' => '성함을 입력해 주세요.',
        ],
        'phone' => [
            'required' => '전화번호를 입력해 주세요.',
        ],
        'email' => [
            'required' => '이메일을 입력해 주세요.',
            'email' => '이메일 형식이 올바르지 않습니다. 예: abc@gmail.com',
        ],
        'address' => [
            'required' => '주소를 입력해 주세요.',
        ],
    ],
];
