<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCatalogueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Thêm dữ liệu mẫu vào bảng user_catalogues
        DB::table('user_catalogues')->insert([
            [   
                'id' => 8,
                'name' => 'Nhóm Phát Triển Sản Phẩm',
                'description' => 'Nhóm nghiên cứu và phát triển sản phẩm mới, cải tiến sản phẩm hiện có dựa trên nhu cầu thị trường và phản hồi từ khách hàng.',
                'phone' => '0955667788',
                'email' => 'product_dev@example.com',
                'publish' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   
                'id' => 9,
                'name' => 'Nhóm Chăm Sóc Khách Hàng',
                'description' => 'Nhóm hỗ trợ khách hàng, giải quyết các vấn đề phát sinh, tư vấn sản phẩm và thu thập phản hồi để nâng cao chất lượng dịch vụ.',
                'phone' => '0966778899',
                'email' => 'customer_care@example.com',
                'publish' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   
                'id' => 10,
                'name' => 'Nhóm Logistics',
                'description' => 'Nhóm quản lý chuỗi cung ứng, vận chuyển hàng hóa, kho bãi và đảm bảo quy trình phân phối sản phẩm đến khách hàng diễn ra hiệu quả.',
                'phone' => '0977889900',
                'email' => 'logistics@example.com',
                'publish' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   
                'id' => 11,
                'name' => 'Nhóm Pháp Lý',
                'description' => 'Nhóm tư vấn pháp luật, rà soát hợp đồng, đảm bảo hoạt động của công ty tuân thủ các quy định pháp lý hiện hành.',
                'phone' => '0988990011',
                'email' => 'legal@example.com',
                'publish' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   
                'id' => 12,
                'name' => 'Nhóm Truyền Thông Nội Bộ',
                'description' => 'Nhóm xây dựng văn hóa doanh nghiệp, tổ chức sự kiện nội bộ và truyền thông các thông điệp quan trọng đến toàn thể nhân viên.',
                'phone' => '0999001122',
                'email' => 'internal_comms@example.com',
                'publish' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
