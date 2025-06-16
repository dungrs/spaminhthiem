<?php 

return [
    'stats' => [
        'monthly_orders' => '월별 주문',
        'total_orders' => '총 주문 수',
        'monthly_revenue' => '월별 매출',
        'total_customers' => '총 고객 수',
        'new_customers' => '신규 고객',
        'conversion_rate' => '전환율'
    ],
    'dashboard' => [
        'index' => [
            'title' => "시스템 개요",
        ],
        'chart' => [
            'revenue_chart' => '수익 차트',
            'sort_by' => '정렬 기준:',
            'sort_options' => [
                'year' => '연도별',
                'month' => '월별',
                '30_days' => '최근 30일',
                '7_days' => '최근 7일'
            ],
            'order_stats' => '주문 통계',
            'order_status' => [
                'completed' => '완료된 주문',
                'processing' => '처리 중인 주문',
                'canceled' => '취소된 주문'
            ],
            'change_labels' => [
                'increase' => '증가 :value%',
                'decrease' => '감소 :value%'
            ]
        ],
        'sale_best_product' => [
            'productItem' => [
                'no_reviews' => '리뷰 없음',
                'reviews_count' => ':count 리뷰',
                'view_details' => '자세히 보기',
                'sold_progress' => ':sold/:total 판매',
                'discount_badge' => '-:value:type'
            ],
            'sales_by_social_source' => [
                'title' => '소셜 소스별 판매',
                'time_periods' => [
                    'monthly' => '월간',
                    'yearly' => '연간',
                    'weekly' => '주간',
                    'today' => '오늘'
                ],
                'platforms' => [
                    'facebook' => [
                        'name' => '페이스북 광고',
                        'category' => '신발',
                        'orders' => '주문',
                        'likes' => '좋아요'
                    ],
                    'twitter' => [
                        'name' => '트위터 광고',
                        'category' => '티셔츠'
                    ],
                    'linkedin' => [
                        'name' => '링크드인 광고',
                        'category' => '시계'
                    ],
                    'youtube' => [
                        'name' => '유튜브 광고',
                        'category' => '의자'
                    ],
                    'instagram' => [
                        'name' => '인스타그램 광고',
                        'category' => '의자'
                    ]
                ],
                'metrics' => [
                    'orders' => ':count 주문',
                    'likes' => ':countk 좋아요',
                    'revenue' => ':amountđ',
                    'growth' => [
                        'positive' => ':percent% 증가',
                        'negative' => ':percent% 감소'
                    ]
                ]
            ],
            'best_selling_products' => [
                'title' => '베스트 셀러 제품'
            ],
            'navigation' => [
                'next' => '다음',
                'prev' => '이전'
            ]
        ],

        'sales_recent_orders' => [
            'sales_revenue' => [
                'title' => '판매 수익',
                'year_selection' => [
                    'label' => '연도:',
                    'placeholder' => '2022',
                    'options' => [
                        '2019' => '2019',
                        '2020' => '2020',
                        '2021' => '2021'
                    ]
                ]
            ],
            
            'recent_orders' => [
                'title' => '최근 주문',
                'table' => [
                    'headers' => [
                        'order_code' => '주문 코드',
                        'customer' => '고객',
                        'price' => '가격',
                        'payment_status' => '결제 상태',
                        'confirmation' => '확인',
                        'actions' => '작업'
                    ],
                    'customer_col_width' => '210px'
                ]
            ]
        ]
    ],
    'source' => [
        'index' => [
            'title' => "고객 출처 관리",
            'table' => [
                'title' => "고객 출처 목록",
                'table_header' => [
                    'name' => '출처 이름',
                    'description' => '설명',
                    'keyword' => '키워드',
                ],
                'add_button' => "고객 출처 추가",
            ],
        ],
        'modal' => [
            'title' => [
                'create' => '새 고객 출처 추가',
                'edit' => '고객 출처 편집'
            ],
            'name' => '출처 이름',
            'keyword' => '키워드',
            'description' => '간단한 설명',
            'name_placeholder' => '고객 출처 이름을 입력하세요...',
            'keyword_placeholder' => '키워드를 입력하세요...',
            'description_placeholder' => '간단한 설명을 입력하세요...',
        ]
    ],
    'user_catalogue' => [
        'index' => [
            'title' => "회원 그룹 관리",
            'table' => [
                'title' => "그룹 이름",
                'table_header' => [
                    'name' => '이름',
                    'description' => '설명',
                    'email' => '이메일',
                    'phone' => '전화번호',
                    'user_count' => '회원 수',
                ],
                'add_button' => "새 그룹 추가",
            ],
        ],
        'modal' => [
            'title' => [
                'create' => '새 회원 그룹 추가',
                'edit' => '회원 그룹 수정',
                'translate' => '회원 그룹을 다른 언어로 번역'
            ],
            'name' => '회원 그룹 이름',
            'phone' => '전화번호',
            'email' => '이메일',
            'description' => '간단한 설명',
            'language' => '표시 언어 선택',
            'name_placeholder' => '회원 그룹 이름 입력...',
            'phone_placeholder' => '전화번호 입력...',
            'email_placeholder' => '이메일 입력...',
            'description_placeholder' => '설명 입력...',
        ],
        'notifications' => [
            'delete_error_users_exist' => "사용자가 이 그룹을 사용 중이므로 그룹을 삭제할 수 없습니다. 회원을 먼저 삭제해주세요!",
        ]
    ],
    'user' => [
        'index' => [
            'title' => "회원 관리",
            'table' => [
                'title' => "회원 목록",
                'table_header' => [
                    'name' => '이름',
                    'contact' => '전화번호 / 이메일',
                    'address' => '주소',
                    'group' => '회원 그룹',
                ],
                'add_button' => "새 회원 추가",
                'filter_user' => "회원 그룹 선택"
            ],
        ],
        'modal' => [
            'title' => [
                'create' => '새 회원 추가',
                'edit' => '회원 수정',
            ],
            'common_info' => '일반 정보',
            'name' => '이름',
            'name_placeholder' => '전체 이름을 입력하세요...',
            'email' => '이메일',
            'email_placeholder' => '이메일을 입력하세요...',
            'group' => '회원 그룹',
            'group_placeholder' => '회원 그룹 선택...',
            'birthday' => '생일',
            'birthday_placeholder' => '생일 선택 (dd/mm/yyyy)...',
            'avatar' => '프로필 사진',
            'avatar_placeholder' => 'URL 입력 또는 사진 선택...',
            'contact_info' => '연락처 정보',
            'city' => '도시',
            'district' => '구/군',
            'ward' => '동/읍',
            'address' => '주소',
            'address_placeholder' => '주소 입력 (있다면)...',
            'phone' => '전화번호',
            'phone_placeholder' => '연락처 전화번호 입력...',
            'note' => '메모',
            'note_placeholder' => '메모 입력 (있다면)...',
            'password' => [
                'label' => '비밀번호',
                'placeholder' => '비밀번호 입력...',
                'confirm_label' => '비밀번호 확인',
                'confirm_placeholder' => '비밀번호 다시 입력...',
            ],
        ]
    ],
    'customer_catalogue' => [
        'index' => [
            'title' => "고객 그룹 관리",
            'table' => [
                'title' => "고객 그룹 목록",
                'table_header' => [
                    'name' => '그룹 이름',
                    'description' => '설명',
                    'customer_count' => '회원 수',
                ],
                'add_button' => "새 고객 그룹 추가",
            ],
        ],
        'permission' => [
            'title' => "권한 관리",
            'table' => [
                'title' => "권한 목록",
                'table_header' => [
                    'name' => '권한 이름',
                ],
            ],
        ],
        'modal' => [
            'title' => [
                'create' => '새 고객 그룹 추가',
                'edit' => '고객 그룹 수정',
            ],
            'name' => '고객 그룹 이름',
            'phone' => '전화번호',
            'email' => '이메일',
            'description' => '간단한 설명',
            'language' => '표시 언어 선택',
            'name_placeholder' => '고객 그룹 이름 입력...',
            'phone_placeholder' => '전화번호 입력...',
            'email_placeholder' => '이메일 주소 입력...',
            'description_placeholder' => '설명 입력...',
        ],
        'notifications' => [
            'delete_error_customers_exist' => "해당 그룹에 고객이 존재하여 삭제할 수 없습니다. 먼저 고객을 삭제해 주세요!",
        ]
    ],
    'customer' => [
        'index' => [
            'title' => "고객 관리",
            'table' => [
                'title' => "고객 목록",
                'table_header' => [
                    'name' => '성명',
                    'contact' => '연락처/이메일',
                    'address' => '주소',
                    'group' => '고객 그룹',
                ],
                'add_button' => "새 고객 추가",
                'filter_customer' => "고객 그룹별 필터"
            ],
        ],
        'modal' => [
            'title' => [
                'create' => '새 고객 추가',
                'edit' => '고객 정보 수정',
            ],
            'common_info' => '기본 정보',
            'name' => '성명',
            'name_placeholder' => '전체 이름 입력...',
            'email' => '이메일',
            'email_placeholder' => '이메일 주소 입력...',
            'group' => '고객 그룹',
            'group_placeholder' => '고객 그룹 선택...',
            'birthday' => '생년월일',
            'birthday_placeholder' => '생일 선택 (일/월/년)...',
            'avatar' => '프로필 이미지',
            'avatar_placeholder' => '이미지 URL 입력 또는 선택...',
            'contact_info' => '연락처 정보',
            'city' => '시/도',
            'district' => '구/군',
            'ward' => '동/읍/면',
            'address' => '주소',
            'address_placeholder' => '주소 입력 (있는 경우)...',
            'phone' => '전화번호',
            'phone_placeholder' => '연락처 번호 입력...',
            'note' => '비고',
            'note_placeholder' => '메모 입력 (있는 경우)...',
            'password' => [
                'label' => '비밀번호',
                'placeholder' => '비밀번호 입력...',
                'confirm_label' => '비밀번호 확인',
                'confirm_placeholder' => '비밀번호 재입력...',
            ],
        ]
    ],
    'permission' => [
        'index' => [
            'title' => "권한 관리",
            'table' => [
                'title' => "권한 목록",
                'table_header' => [
                    'name' => '권한',
                    'canonical' => '정식 식별자 (Canonical)'
                ],
                'add_button' => "새로운 권한 추가",
            ],
        ],
        'modal' => [
            'title' => [
                'create' => '새로운 권한 추가',
                'edit' => '권한 수정',
            ],
            'name' => '권한 이름',
            'name_placeholder' => '권한 이름을 입력하세요...',
            'canonical' => '정식 식별자 (Canonical)',
            'canonical_placeholder' => '정식 식별자를 입력하세요...',
        ]
    ],
    'post_catalogue' => [
        'index' => [
            'title' => "게시글 그룹 관리",
            'table' => [
                'title' => "게시글 그룹 목록",
                'add_button' => "새 제품 그룹 추가",
            ],
        ],
        'create' => [
            'title' => "새 게시글 그룹 추가",
        ],
        'edit' => [
            'title' => "게시글 그룹 수정",
        ],
        'notifications' => [

        ]
    ],
    'post' => [
        'index' => [
            'title' => "게시물 관리",
            'table' => [
                'title' => "게시물 목록",
                'add_button' => "새 게시물 추가",
            ],
        ],
        'create' => [
            'title' => "새 게시물 생성",
        ],
        'edit' => [
            'title' => "게시물 업데이트",
        ],
        'notifications' => [
            
        ]
    ],
    'product_catalogue' => [
        'index' => [
            'title' => "제품 그룹 관리",
            'table' => [
                'title' => "제품 그룹 목록",
                'add_button' => "새 제품 그룹 추가",
            ],
        ],
        'create' => [
            'title' => "새 제품 그룹 추가",
        ],
        'edit' => [
            'title' => "제품 그룹 수정",
        ],
        'notifications' => [
            // ...
        ]
    ],
    'product' => [
        'index' => [
            'title' => "제품 관리",
            'table' => [
                'title' => "제품 목록",
                'add_button' => "새 제품 추가",
            ],
        ],
        'create' => [
            'title' => "새 제품 추가",
        ],
        'edit' => [
            'title' => "제품 수정",
        ],
        'notifications' => [
            // ...
        ],
        'step_4_title' => '여러 버전이 있는 상품',
        'step_4_description' => '상품의 변형을 구성하세요',
        'step_5_title' => '변형 목록',
        'step_5_description' => '상품의 버전을 설정하세요',
        'has_variant_label' => '이 상품은 색상, 사이즈 등 다양한 버전이 있습니다.',
        'choose_attribute_group' => '속성 그룹 선택',
        'choose_attribute_value' => '속성 값을 선택하세요 (키워드 입력 후 검색)',
        'add_variant_button' => '새 버전 추가',
        'product_variant_required' => '이 기능을 사용하려면 가격과 상품 코드를 입력해야 합니다!',
        'input_attribute_value' => '속성 값을 입력하세요',

        'stock_info' => '재고 정보',
        'quantity' => '재고 수량',
        'enter_quantity' => '수량을 입력하세요...',
        'sku' => 'SKU 코드',
        'enter_sku' => 'SKU 코드를 입력하세요...',
        'price' => '판매 가격',
        'enter_price' => '판매 가격을 입력하세요...',
        'barcode' => '바코드',
        'enter_barcode' => '바코드를 입력하세요...',

        'file_management' => '파일 관리',
        'file_name' => '파일 이름',
        'enter_file_name' => '파일 이름을 입력하세요...',
        'file_url' => '파일 URL',
        'enter_file_url' => '파일 URL을 입력하세요...',
        'aside' => [
            'card' => [
                'title' => '제품 정보',
                'description' => '아래에 제품 정보를 입력하세요.',
            ],
            'form' => [
                'code' => [
                    'label' => '제품 코드',
                    'placeholder' => '제품 코드를 입력하세요',
                ],
                'made_in' => [
                    'label' => '원산지',
                    'placeholder' => '제품 원산지를 입력하세요',
                ],
                'price' => [
                    'label' => '판매 가격',
                    'placeholder' => '제품 가격을 입력하세요',
                ],
            ],
        ],
    ],
    'attribute_catalogue' => [
        'index' => [
            'title' => "속성 유형 관리",
            'table' => [
                'title' => "속성 유형 목록",
                'add_button' => "새 속성 유형 추가",
            ],
        ],
        'create' => [
            'title' => "새 속성 유형 추가",
        ],
        'edit' => [
            'title' => "속성 유형 수정",
        ],
        'notifications' => [

        ]
    ],
    'attribute' => [
        'index' => [
            'title' => "속성 관리",
            'table' => [
                'title' => "속성 목록",
                'add_button' => "새 속성 추가",
            ],
        ],
        'create' => [
            'title' => "새 속성 추가",
        ],
        'edit' => [
            'title' => "속성 수정",
        ],
        'notifications' => [

        ]
    ],
    'menu' => [
        'index' => [
            'title' => "메뉴 관리",
            'table' => [
                'title' => "현재 메뉴 목록",
                'table_header' => [
                    'name' => '메뉴 이름',
                    'canonical' => '고정 링크 (Canonical)',
                ],
                'add_button' => "새 메뉴 추가",
            ],
        ],
        'create' => [
            'title' => "새 메뉴 생성",
        ],
        'children' => [
            'title' => "하위 메뉴 편집",
        ],
        'translate' => [
            'title' => "메뉴 번역 추가",
            'original_language' => '원본 언어',
            'save' => '저장',
            'name' => '메뉴 이름',
            'name_placeholder' => '메뉴 이름 입력',
            'name_helper' => '화면에 표시될 이름',
            'link' => '링크',
            'link_placeholder' => '링크 입력',
            'link_helper' => '메뉴의 고정 URL',
            'item' => '메뉴 #:number',
        ],
        'edit' => [
            'title' => "메뉴 편집",
        ],
        'setup' => [
            'title' => '카테고리 설정',
            'description' => '웹사이트에서 메뉴가 표시될 영역을 선택하세요.',
        ],
        'custom_link' => [
            'title' => '사용자 정의 링크',
            'tips' => [
                'title' => '표시할 메뉴를 설정하세요.',
                'items' => [
                    'path_working' => '메뉴 생성 시 링크가 작동하는지 확인하세요.',
                    'path_modules' => '게시물, 제품, 프로젝트 등의 모듈에서 생성된 링크',
                    'required_fields' => '<strong>제목</strong>과 <strong>링크</strong>는 필수 항목입니다.',
                    'max_levels' => '시스템은 최대 <strong>5단계 메뉴</strong>를 지원합니다.'
                ]
            ],
            'add_button' => '링크 추가',
        ],
        'management' => [
            'title' => '메뉴 관리',
            'columns' => [
                'name' => '메뉴 이름',
                'path' => '링크',
                'position' => '위치',
                'actions' => '작업',
            ],
            'empty_state' => [
                'title' => '생성된 메뉴가 없습니다',
                'description' => '왼쪽 사이드바에서 메뉴 링크를 추가해 주세요'
            ],
            'name_placeholder' => '메뉴 이름 (예: 홈페이지)',
            'canonical_placeholder' => '링크 (예: home)',
            'order_placeholder' => '표시 순서 (예: 1)',
        ],
        'module' => [
            'search_placeholder' => '검색어를 입력하세요...',
            'loading' => '데이터 로드 중...',
            'buttons' => [
                'refresh' => '새로 고침',
                'apply' => '적용',
            ],
        ],
        'errors' => [
            'general' => '오류가 발생했습니다!',
            'validation' => ':count개의 오류가 있습니다:',
        ],
        'position' => [
            'title' => '메뉴 표시 위치 선택',
            'description' => '웹사이트에서 메뉴가 표시될 영역을 선택하세요.',
            'label' => '표시 위치',
            'placeholder' => '-- 표시 위치 선택 --',
            'create_button' => '표시 위치 생성',
        ],
        'modal' => [
            'title' => '새 메뉴 표시 위치 추가',
            'fields' => [
                'required_note' => '<span class="text-danger">(*)</span> 표시된 항목은 필수 입력 사항입니다.',
                'position_name' => [
                    'label' => '표시 위치 이름',
                    'placeholder' => '예: 메인 메뉴, 푸터 메뉴...',
                ],
                'keyword' => [
                    'label' => '키워드',
                    'placeholder' => '예: main-menu, footer-menu...',
                ],
            ],
            'buttons' => [
                'close' => '취소',
                'submit' => '저장',
            ],
            'icons' => [
                'close' => '닫기',
                'save' => '저장',
                'required' => '필수 항목',
            ],
        ],
        'menu_management' => '메뉴 관리',
        'quick_guide' => '빠른 가이드',
        'update_menu' => '메뉴 업데이트',
        'update_menu_description' => '"메뉴 업데이트" 버튼을 사용하여 1단계 메뉴를 편집하세요',
        'sort_menu' => '메뉴 정렬',
        'sort_menu_description' => '드래그 앤 드롭으로 메뉴 표시 순서 변경',
        'manage_submenu' => '하위 메뉴 관리',
        'manage_submenu_description' => '"하위 메뉴 관리"를 클릭하여 하위 카테고리 추가',
        'multi_level_menu' => '다단계 메뉴',
        'multi_level_menu_description' => '시스템은 최대 5단계 메뉴를 지원합니다',
        'auto_translate' => '자동 번역',
        'update_level1_menu' => '1단계 메뉴 업데이트',
        'help' => '도움말',
    ],
    'language' => [
        'index' => [
            'title' => "언어 관리",
            'table' => [
                'title' => "언어 목록",
                'table_header' => [
                    'image' => '이미지',
                    'name' => '언어 이름',
                    'description' => '설명',
                    'canonical' => '표준 경로 (Canonical)',
                ],
                'add_button' => "새 언어 추가",
            ],
        ],
        'translate' => [
            'title' => "콘텐츠 번역",
        ],
        'modal' => [
            'title' => [
                'create' => '새 언어 추가',
                'edit' => '새 언어 추가',
            ],
            'name' => '언어 이름',
            'canonical' => '표준 경로 (Canonical)',
            'description' => '간단한 설명',
            'image' => '이미지',
            'name_placeholder' => '언어 이름 입력...',
            'canonical_placeholder' => '표준 경로 입력...',
            'description_placeholder' => '간단한 설명 입력...',
            'image_placeholder' => '대표 이미지 선택...',
        ]
    ],
    'system' => [
        'index' => [
            'title' => "시스템 설정",
        ],
    ],
    'review' => [
        'index' => [
            'title' => "리뷰 관리",
            'table' => [
                'title' => "리뷰 목록",
                'table_header' => [
                    'name' => '이름',
                    'email' => '이메일',
                    'phone' => "전화번호",
                    'description' => "내용",
                    'score' => "평점",
                ],
            ],
        ],
    ],
    'slide' => [
        'index' => [
            'title' => "배너 & 슬라이드 관리",
            'table' => [
                'title' => "배너 & 슬라이드 목록",
                'add_button' => "새 배너 & 슬라이드 추가",
                'name' => '슬라이드 이름',
                'keyword' => '키워드'
            ],
        ],
        'create' => [
            'title' => "새 배너 & 슬라이드 생성",
        ],
        'edit' => [
            'title' => "배너 & 슬라이드 수정",
        ],
        'basic_settings' => [
            'title' => '기본 설정',
            'description' => '기본 매개변수 구성',
            'fields' => [
                'name' => [
                    'label' => '슬라이드 이름',
                    'placeholder' => '슬라이드 이름 입력',
                    'help' => '슬라이드 표시 이름',
                ],
                'keyword' => [
                    'label' => '키워드',
                    'placeholder' => '고유 식별자 입력',
                    'help' => '슬라이드를 식별하는 고유 키워드',
                ],
                'dimensions' => [
                    'title' => '크기 사양',
                    'width' => '너비',
                    'height' => '높이',
                    'unit' => '픽셀',
                ],
                'animation' => [
                    'label' => '전환 효과',
                ],
                'navigation' => [
                    'arrows' => '탐색 버튼 표시',
                    'type' => '탐색 유형',
                ],
            ],
        ],
        'advanced_settings' => [
            'title' => '고급 설정',
            'description' => '고급 매개변수 구성',
            'autoplay' => [
                'label' => '자동 재생',
                'help' => '활성화 시 슬라이드가 자동으로 전환됩니다',
            ],
            'pause_hover' => [
                'label' => '호버 시 일시 정지',
                'help' => '사용자가 호버할 때 전환 일시 정지',
            ],
            'animation' => [
                'title' => '애니메이션',
                'delay' => [
                    'label' => '지연 시간',
                    'help' => '슬라이드 전환 간 지연 시간',
                    'placeholder' => '3000',
                    'unit' => '밀리초',
                ],
                'speed' => [
                    'label' => '전환 속도',
                    'help' => '전환 애니메이션 지속 시간',
                    'placeholder' => '500',
                    'unit' => '밀리초',
                ],
            ],
        ],
        'shortcode' => [
            'title' => '임베드 코드',
            'description' => '사용자 정의 임베드 코드 구성',
            'label' => '사용자 정의 임베드 코드',
            'placeholder' => 'HTML/JavaScript 코드를 여기에 붙여넣기...',
            'help' => '슬라이드에 사용자 정의 코드를 임베드하는 데 사용',
        ],
        'list' => [
            'title' => '슬라이드 목록',
            'description' => '각 슬라이드에 대한 기본 매개변수 구성',
            'add_slide' => '슬라이드 추가',
            'empty_state' => [
                'icon' => 'bx-slider-alt',
                'title' => '아직 생성된 슬라이드가 없습니다',
                'description' => '"슬라이드 추가" 버튼을 클릭하여 새 슬라이드 생성',
            ],
            'tabs' => [
                'general' => '일반 정보',
                'seo' => 'SEO',
            ],
            'fields' => [
                'description' => '슬라이드 설명',
                'description_placeholder' => '슬라이드 설명 입력...',
                'canonical' => '정적 URL',
                'new_tab' => '새 탭에서 열기',
                'alt' => '이미지 제목 (ALT)',
                'alt_placeholder' => 'SEO 제목 입력...',
                'title' => '이미지 설명 (Title)',
                'title_placeholder' => 'SEO 설명 입력...',
            ],
            'buttons' => [
                'delete' => '삭제',
            ],
        ],
    ],
    'order' => [
        'index' => [
            'title' => "주문 관리",
            'table' => [
                'title' => '주문 목록',
                'add_button' => '새 주문 추가',
                'order_code' => '주문 코드',
                'order_date' => '주문 날짜',
                'customer' => '고객',
                'payment_method' => '결제 방법',
                'shipping_method' => '배송 방법',
                'total_price' => '총 가격',
                'payment_status' => '결제 상태',
                'delivery_status' => '배송 상태',
                'confirmation' => '확인',
                'actions' => '작업',
            ],
        ],
        'details' => [
            'title' => '주문 상세',
            'order_code' => '주문 코드',
            'customer' => '고객',
            'shipping_address' => '배송지 주소',
            'payment_method' => '결제 방법',
            'order_items' => '청구서 상세',
            'products_count' => ':count개 상품',
            'product' => '상품',
            'price' => '가격',
            'quantity' => '수량',
            'total' => '총액',
            'order_summary' => '주문 요약',
            'subtotal' => '소계',
            'discount' => '할인',
            'shipping_fee' => '배송비',
            'grand_total' => '총 합계',
            'order_status' => '주문 상태',
            'invoice' => '청구서',
            'download_invoice' => '청구서 다운로드',
            'confirm_status' => '확인 상태',
            'payment_status' => '결제 상태',
            'delivery_status' => '배송 상태',
            'shipping_details' => '배송 상세',
            'track_order' => '주문 추적',
            'documents' => '문서',
            'invoice_number' => '청구서 번호',
            'shipping_number' => '배송 번호',
            'edit' => '수정',
            'estimated_delivery' => '예상 배송일',
            'modal' => [
                'update_customer_info' => '고객 정보 업데이트',
                'update_customer_address' => '고객 주소 업데이트',
                'update_invoice_status' => '송장 상태 업데이트',
            ],
        ],
    ],
    'widget' => [
        'index' => [
            'title' => "위젯 관리",
            'table' => [
                'title' => "위젯 목록",
                'add_button' => "새 위젯 추가",
            ],
        ],
        'create' => [
            'title' => "새 위젯 추가",
        ],
        'edit' => [
            'title' => "위젯 수정",
        ],
        'translate' => [
            'title' => '콘텐츠 번역'
        ],
        'notifications' => [

        ],
        'content_configuration' => [
            'title' => '위젯 콘텐츠 설정',
            'description' => '위젯 콘텐츠에 대한 설정',
            'module_section' => [
                'title' => '모듈',
                'select_placeholder' => '선택한 모듈에 따라 카테고리를 선택하세요',
            ],
            'search_section' => [
                'empty_state' => [
                    'icon' => 'bx bx-search-alt',
                    'text' => '상품을 검색하려면 키워드를 입력하세요'
                ],
                'item_template' => [
                    'path_label' => '경로:',
                    'name_validate' => '제목을 입력해 주세요.',
                    'keyword_validate' => '키워드를 입력해 주세요.',
                    'module_validate' => '위젯에 추가할 항목을 최소한 하나 이상 선택해주세요.'
                ]
            ]
        ],
        'fields' => [
            'name' => [
                'label' => '위젯 이름',
                'placeholder' => '위젯 이름을 입력하세요',
            ],
            'keyword' => [
                'label' => '위젯 키워드',
                'placeholder' => '위젯 키워드를 입력하세요',
            ],
        ]
    ],
    'promotion' => [
        'index' => [
            'title' => "프로모션 관리",
            'table' => [
                'title' => "프로모션 목록",
                'add_button' => "새 프로모션 추가",
                'tableHeader' => [
                    'program_name' => '프로그램 이름',
                    'discount' => '할인',
                    'information' => '정보',
                    'start_date' => '시작일',
                    'end_date' => '종료일',
                    'status' => '상태',
                    'actions' => '작업',
                ]
            ],
        ],
        'create' => [
            'title' => "새 프로모션 추가",
        ],
        'edit' => [
            'title' => "프로모션 수정",
        ],
        'notifications' => [
            
        ],
        'aside' => [
            'time' => [
                'title' => '프로그램 적용 기간',
                'description' => '프로그램 적용 기간 설정',
                'start_date' => '시작일',
                'end_date' => '종료일',
                'never_end' => '종료일 없음',
            ],
            
            'source' => [
                'title' => '적용 고객 출처',
                'description' => '아래 적용 설정',
                'scope' => '적용 범위',
                'all_channels' => '모든 채널',
                'all_channels_desc' => '모든 고객 출처에 적용',
                'specific_channels' => '특정 채널',
                'specific_channels_desc' => '적용할 고객 출처 선택',
                'select_channels' => '채널 선택',
                'select_channels_placeholder' => '해당 채널 선택',
            ],
            
            'object' => [
                'title' => '적용 대상',
                'description' => '아래 대상 범위 설정',
                'scope' => '대상 범위',
                'all_customers' => '모든 고객',
                'all_customers_desc' => '모든 대상에 적용',
                'customer_groups' => '고객 그룹',
                'customer_groups_desc' => '선택한 그룹에만 적용',
                'select_groups' => '고객 그룹 선택',
                'select_groups_placeholder' => '고객 그룹 선택',
            ],
        ],
        'general' => [
            'title' => '기본 정보',
            'description' => '주요 프로그램 정보 설정',
            'name_label' => '프로모션 프로그램 이름',
            'name_placeholder' => '프로모션 프로그램 이름 입력',
            'code_label' => '프로모션 코드',
            'code_placeholder' => '프로모션 코드 입력',
            'content_label' => '프로모션 내용',
            'content_placeholder' => '프로모션 프로그램 상세 설명',
            'required' => '<i class="uil uil-exclamation-circle text-danger"></i>',
        ],
        'details' => [
            'title' => '프로모션 상세 설정',
            'description' => '아래 정보 설정',
            'method_label' => '프로모션 방식 선택',
            'method_placeholder' => '방식 선택',
            'order_amount' => [
                'from' => '시작 값',
                'to' => '종료 값',
                'discount' => '할인',
                'order_from' => '주문 금액 시작',
                'order_to' => '종료 금액',
                'discount_level' => '할인 수준',
                'from_placeholder' => '시작 값 입력',
                'to_placeholder' => '종료 값 입력',
                'discount_placeholder' => '할인 금액 입력',
                'currency' => '원',
                'percent' => '%',
                'add_condition' => '조건 추가',
                'invalid_value' => '유효하지 않은 "종료" 값!',
                'value_compare' => '"종료" 값은 "시작" 값보다 크거나 같아야 합니다!',
                'range_conflict' => '이 범위는 이미 존재하거나 겹칩니다!'
            ],
            'product_quantity' => [
                'title' => '적용 상품',
                'select_option' => '방식 선택',
                'table' => [
                    'product' => '상품',
                    'discount_limit' => '할인 한도',
                    'discount_amount' => '할인 금액',
                    'select_product_placeholder' => '상품 선택을 위해 클릭하세요',
                    'max_discount_placeholder' => '할인 한도 입력',
                    'discount_value_placeholder' => '할인 금액 입력',
                    'currency_symbol' => '원',
                    'percent_symbol' => '%',
                ],
                'product_row' => [
                    'product_name' => '상품명',
                    'product_details' => '상품 상세',
                    'no_name' => '(이름 없음)',
                    'sku' => 'SKU:',
                    'inventory' => '재고:',
                    'could_sell' => '판매 가능:',
                ],
                'product_catalogue_row' => [
                    'product_catalogue_name' => '상품 카탈로그명',
                ],
            ],
            'select_product_prompt' => '상품 선택을 위해 클릭하세요...',
            'select_product_warning' => '적용할 상품을 선택해주세요!',
            'select_at_least_one_product' => '최소 한 개 이상의 상품을 선택해주세요!',
            'customer_select' => [
                'label' => '고객 그룹 선택',
                'placeholder' => '고객 그룹 선택'
            ],
            'promotion_table_details' => [
                'view_details' => '상세 보기',
                'max_discount' => '최대:',
                'no_expiry' => '만료 없음',
                'expired' => '만료됨',
                'discount_types' => [
                    'percent' => ':value%',
                    'cash' => ':amount원'
                ],
                'date_format' => 'Y/m/d H:i'
            ],
        ],
    ],
    'notifications' => [
        'create_success' => "새로 만들기 성공!",
        'create_error' => "새로 만들기 중 오류가 발생했습니다!",
        'update_success' => "정보 업데이트 성공!",
        'update_error' => "업데이트 중 오류가 발생했습니다!",
        'delete_success' => "데이터 삭제 성공!",
        'delete_error' => "데이터 삭제 중 오류가 발생했습니다!",
        'not_found' => "요청한 데이터를 찾을 수 없습니다.",
        'no_changes' => "변경 사항이 없습니다.",
        'translation_saved_successfully' => '번역이 성공적으로 저장되었습니다.',
        'error_saving_translation' => '번역을 저장하는 동안 오류가 발생했습니다.',
    ],
    'publish' => [
        '' => '상태 선택',
        '2' => '출판',
        '1' => '비공개',
    ],
    'perpage' => '레코드',
    'keyword_placeholder' => '검색...',
    'status' => '상태',
    'actions' => [
        'title' => '작업',
        'edit' => '편집',
        'translate' => '번역',
        'delete' => '삭제',
        'cancel' => '취소',
        'save' => '저장',
    ],
    'confirmJs' => [
        'title' => "확인하시겠습니까?",
        'text' => "이 작업은 되돌릴 수 없습니다!",
        'confirmButton' => "예, 삭제합니다!",
        'cancelButton' => "취소",
        'successTitle' => "삭제 완료!",
        'errorTitle' => "오류!",
        'deleteSuccess' => "삭제 성공.",
        'deleteError' => "삭제 중 오류가 발생했습니다!",
        'generalError' => "오류가 발생했습니다. 다시 시도해 주세요!",
    ],
    "modal" => [
        'close' => '닫기',
        'confirm' => '확인',
    ],
    'icon_explanation' => '아이콘 설명:',
    'translated' => '번역됨',
    'not_translated' => '번역되지 않음',
    'cannot_be_empty' => '정보를 비울 수 없습니다.',
    'original_language' => '원본 언어',
    'required_fields' => ':icon 아이콘이 있는 필드는 필수 입력 항목입니다.',
    'configuration' => 'SEO 설정',
    'setup_title_description_keywords' => 'SEO 제목, 설명, 키워드 설정',
    'seo_default' => [
        'no_seo_title' => 'SEO 제목이 없습니다',
        'default_canonical' => url('/') . '/' . 'duong-dan-cua-ban' . config('apps.general.suffix'),
        'no_seo_description' => 'SEO 설명이 없습니다',
    ],
    'seo_title' => 'SEO 제목',
    'enter_seo_title' => 'SEO 제목 입력',
    'seo_keywords' => 'SEO 키워드',
    'enter_seo_keywords' => 'SEO 키워드 입력',
    'seo_description' => 'SEO 설명',
    'enter_seo_description' => 'SEO 설명 입력',
    'keyword' => '키워드',
    'enter_keyword' => '키워드 입력',
    'general_information' => '일반 정보',
    'enter_title_description_content' => '제목, 설명 및 내용을 입력하세요',
    'title' => '제목',
    'enter_title' => '제목 입력',
    'short_description' => '짧은 설명',
    'enter_short_description' => '짧은 설명 입력',
    'content' => '내용',
    'enter_content' => '상세 내용 입력',
    'upload_image' => '이미지 업로드',
    'advanced_settings' => '고급 설정',
    'configure_category_status_navigation' => '카테고리, 상태 및 네비게이션 설정',
    'parent_category' => '상위 카테고리',
    'select_root_if_no_parent' => '상위 카테고리가 없으면 <strong>루트</strong>를 선택하세요.',
    'navigation' => '네비게이션',
    'featured_image' => '대표 이미지',
    'select_representative_image' => '공통 대표 이미지 선택',
    'preview_image' => '미리보기 이미지',
    'save' => '저장',
    'translations' => [
        'supported_languages' => "지원되는 언어:",
        'no_languages' => "지원되는 언어가 없습니다",
    ],
    'cannot_delete_category' => '이 카테고리는 하위 카테고리가 있어 삭제할 수 없습니다.',
    'assign_permission' => '권한 부여',
    'album' => [
        'album_title' => '사진 앨범',
        'album_description' => '상품을 위한 이미지를 선택하고 업로드하세요.',
        'upload_placeholder' => '여기에 파일을 끌어다 놓거나 클릭하여 업로드하세요.',
    ],
    'day' => '일',
    'month' => '월',
];