<?php 
return [
    'user' => [
        'email' => [
            'required' => '이메일을 입력하세요.',
            'email' => '유효하지 않은 이메일 형식입니다. 예: abc@gmail.com.',
            'unique' => '이 이메일은 이미 사용 중입니다. 다른 이메일을 선택하세요.',
            'string' => '이메일은 문자열이어야 합니다.',
            'max' => '이메일은 250자 이하로 입력하세요.',
        ],
        'name' => [
            'required' => '이름을 입력하세요.',
            'string' => '이름은 문자열이어야 합니다.',
        ],
        'user_catalogue_id' => [
            'required' => '회원 그룹을 선택하세요.',
            'integer' => '유효하지 않은 회원 그룹입니다.',
            'gt' => '올바른 회원 그룹을 선택하세요.',
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
            'email' => '유효하지 않은 이메일 형식입니다.',
            'unique' => '이 이메일은 이미 사용 중입니다. 다른 이메일을 선택하세요.',
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
];