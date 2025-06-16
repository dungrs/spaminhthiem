<?php

return [
    'homepage' => [
        'label' => '기본 정보',
        'description' => '회사 이름, 브랜드, 로고, 파비콘 등 웹사이트의 기본 정보를 설정합니다.',
        'value' => [
            'company' => [
                'label' => '회사 이름',
                'placeholder' => '회사 이름을 입력하세요...',
            ],
            'brand' => [
                'label' => '브랜드 이름',
                'placeholder' => '브랜드 이름을 입력하세요...',
            ],
            'slogan' => [
                'label' => '슬로건',
                'placeholder' => '회사의 슬로건을 입력하세요...',
            ],
            'logo' => [
                'label' => '웹사이트 로고',
                'placeholder' => '아래 박스를 클릭하여 웹사이트 로고를 업로드하세요',
            ],
            'favicon' => [
                'label' => '파비콘',
                'placeholder' => '브라우저 탭에 표시될 파비콘을 업로드하려면 아래를 클릭하세요',
            ],
            'short_info' => [
                'label' => '간단한 소개',
                'placeholder' => '회사 또는 웹사이트에 대한 간단한 소개를 입력하세요...',
            ],
        ],
    ],

    'contact' => [
        'label' => '연락처 정보',
        'description' => '회사 주소, 사무실, 전화번호, 이메일, 지도 등 웹사이트의 전체 연락처 정보를 설정합니다.',
        'value' => [
            'office' => [
                'label' => '회사 주소',
                'placeholder' => '회사 본사 주소를 입력하세요...',
            ],
            'address' => [
                'label' => '영업 사무실 주소',
                'placeholder' => '영업 사무실 주소를 입력하세요...',
            ],
            'hotline' => [
                'label' => '대표 전화번호',
                'placeholder' => '대표 전화번호를 입력하세요...',
            ],
            'technical_phone' => [
                'label' => '기술 지원 전화',
                'placeholder' => '기술 지원 전화번호를 입력하세요...',
            ],
            'sell_phone' => [
                'label' => '영업 전화',
                'placeholder' => '영업 상담 전화번호를 입력하세요...',
            ],
            'phone' => [
                'label' => '일반 전화번호',
                'placeholder' => '일반 전화번호를 입력하세요...',
            ],
            'fax' => [
                'label' => '사업자 등록번호',
                'placeholder' => '사업자 등록번호를 입력하세요...',
            ],
            'email' => [
                'label' => '이메일',
                'placeholder' => '연락용 이메일 주소를 입력하세요...',
            ],
            'website' => [
                'label' => '웹사이트',
                'placeholder' => '공식 웹사이트 주소를 입력하세요...',
            ],
            'map' => [
                'label' => '지도',
                'placeholder' => 'Google 지도 iframe 코드를 삽입하세요...',
            ],
            'map_link_text' => '지도 설정 가이드',
        ],
    ],

    'seo' => [
        'label' => '홈페이지 SEO 설정',
        'description' => '홈페이지의 SEO 제목, 키워드, 설명, 미리보기 이미지 등을 설정합니다.',
        'value' => [
            'meta_title' => [
                'label' => 'SEO 제목',
                'placeholder' => '홈페이지의 SEO 제목을 입력하세요...',
            ],
            'meta_keyword' => [
                'label' => 'SEO 키워드',
                'placeholder' => '홈페이지와 관련된 키워드를 입력하세요...',
            ],
            'meta_description' => [
                'label' => 'SEO 설명',
                'placeholder' => '홈페이지 내용을 간단히 설명하세요...',
            ],
            'meta_image' => [
                'label' => '미리보기 이미지',
                'placeholder' => '홈페이지를 공유할 때 표시할 이미지를 선택하세요...',
            ],
        ],
    ],

    'socical' => [
        'label' => '홈페이지 소셜 미디어 설정',
        'description' => '홈페이지에 표시할 Facebook, YouTube, Twitter 등의 소셜 미디어 링크를 설정합니다.',
        'value' => [
            'facebook' => [
                'label' => '페이스북',
                'placeholder' => '페이스북 페이지 URL을 입력하세요...',
            ],
            'youtube' => [
                'label' => '유튜브',
                'placeholder' => '유튜브 채널 URL을 입력하세요...',
            ],
            'twitter' => [
                'label' => '트위터',
                'placeholder' => '트위터 페이지 URL을 입력하세요...',
            ],
            'tiktok' => [
                'label' => '틱톡',
                'placeholder' => '틱톡 계정 URL을 입력하세요...',
            ],
            'instagram' => [
                'label' => '인스타그램',
                'placeholder' => '인스타그램 페이지 URL을 입력하세요...',
            ],
        ],
    ],
];
