<div align="center">

# SPAMINHTHIEM - Laravel E-commerce Platform

**Website thương mại điện tử đầy đủ tính năng được xây dựng bằng Laravel 9**

Hỗ trợ đa kênh thanh toán (PayPal, VNPay, MoMo) • Admin Panel mạnh mẽ • Tối ưu SEO

[![Laravel](https://img.shields.io/badge/Laravel-9.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.0%2B-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
[![Status](https://img.shields.io/badge/Status-Active-success.svg)](https://github.com)

[Tính Năng](#tính-năng) • [Demo](#demo) • [Cài Đặt](#cài-đặt) • [Tài Liệu](#api-endpoints) • [Đóng Góp](#đóng-góp)

</div>

---

## 📑 Mục Lục

- [Giới Thiệu](#-giới-thiệu)
- [Demo](#-demo)
- [Tính Năng](#-tính-năng)
- [Yêu Cầu Hệ Thống](#-yêu-cầu-hệ-thống)
- [Cài Đặt](#-cài-đặt)
- [Cấu Hình](#-cấu-hình)
- [Sử Dụng](#-sử-dụng)
- [Cấu Trúc Dự Án](#-cấu-trúc-dự-án)
- [Technologies](#-technologies)
- [API Endpoints](#-api-endpoints)
- [Database Schema](#-database-schema)
- [Testing](#-testing)
- [Deployment](#-deployment)
- [Troubleshooting](#-troubleshooting)
- [Roadmap](#-roadmap)
- [Đóng Góp](#-đóng-góp)
- [License](#-license)
- [Liên Hệ](#-liên-hệ)

## 📖 Giới Thiệu

**SPAMINHTHIEM** là một nền tảng thương mại điện tử hoàn chỉnh được phát triển trên framework **Laravel 9**, tuân thủ các best practices và design patterns hiện đại. Dự án cung cấp đầy đủ các chức năng cần thiết cho một website bán hàng online chuyên nghiệp, từ quản lý sản phẩm, đơn hàng, khách hàng đến tích hợp thanh toán đa kênh (PayPal, VNPay, MoMo).

### ⚡ Điểm Nổi Bật

| Tính năng | Mô tả |
|-----------|-------|
| 🏗️ **Kiến trúc MVC** | Service Layer & Repository Pattern cho code sạch, dễ maintain |
| 🎛️ **Admin Panel** | Dashboard mạnh mẽ với quản lý toàn diện |
| 💳 **Thanh toán đa kênh** | PayPal, VNPay, MoMo, COD |
| 🌍 **Đa ngôn ngữ** | Multi-language support |
| 🎁 **Khuyến mãi** | Hệ thống promotion linh hoạt |
| ⭐ **Review & Rating** | Đánh giá sản phẩm với upload hình ảnh |
| 🛒 **AJAX Cart** | Giỏ hàng realtime không reload trang |
| 📍 **Địa chỉ VN** | Database đầy đủ Tỉnh/Quận/Phường Việt Nam |
| 🔒 **Bảo mật** | Laravel Sanctum, CSRF Protection, XSS Prevention |
| 🚀 **Performance** | Query optimization, Eager loading, Cache |

## 🎬 Demo

> **Lưu ý:** Thêm screenshots hoặc video demo của bạn tại đây

### Screenshots

<details>
<summary><b>🏠 Trang chủ</b></summary>

<!-- Thêm ảnh screenshot tại đây -->
```
[Screenshot trang chủ]
```

</details>

<details>
<summary><b>🛍️ Trang sản phẩm</b></summary>

<!-- Thêm ảnh screenshot tại đây -->
```
[Screenshot trang sản phẩm]
```

</details>

<details>
<summary><b>🎛️ Admin Dashboard</b></summary>

<!-- Thêm ảnh screenshot tại đây -->
```
[Screenshot admin panel]
```

</details>

### Live Demo (Nếu có)

- **Frontend**: [https://your-demo-site.com](https://your-demo-site.com)
- **Admin Panel**: [https://your-demo-site.com/admin](https://your-demo-site.com/admin)
  - Email: `admin@example.com`
  - Password: `demo123`

## ✨ Tính Năng

### 🛍️ Frontend (Khách Hàng)

#### Quản Lý Sản Phẩm
- Xem danh sách sản phẩm theo danh mục
- Tìm kiếm và lọc sản phẩm
- Chi tiết sản phẩm với biến thể (kích cỡ, màu sắc)
- Yêu thích sản phẩm (wishlist)
- Xem reviews và rating

#### Giỏ Hàng & Thanh Toán
- Thêm sản phẩm vào giỏ hàng (AJAX)
- Cập nhật số lượng và xóa sản phẩm
- Tính toán tự động giá, thuế, phí ship
- Áp dụng mã giảm giá
- Checkout với nhiều phương thức thanh toán:
  - Thanh toán khi nhận hàng (COD)
  - PayPal
  - VNPay (Ngân hàng nội địa)
  - MoMo (Ví điện tử)

#### Quản Lý Đơn Hàng
- Tạo đơn hàng (với/không tài khoản)
- Tra cứu đơn hàng bằng mã
- Lịch sử đơn hàng
- Theo dõi trạng thái giao hàng

#### Tài Khoản Khách Hàng
- Đăng ký/Đăng nhập
- Quản lý thông tin cá nhân
- Quản lý địa chỉ giao hàng
- Xem lịch sử mua hàng

#### Bài Viết & Blog
- Xem danh sách bài viết
- Chi tiết bài viết
- Danh mục bài viết phân cấp

#### Review & Rating
- Viết đánh giá sản phẩm
- Upload hình ảnh review
- Like/Unlike review
- Xếp hạng sao (1-5 sao)

### 🎛️ Backend (Admin Panel)

#### Quản Lý Người Dùng
- CRUD tài khoản admin
- Phân quyền (Permissions)
- Quản lý vai trò (Roles)
- Nhật ký hoạt động

#### Quản Lý Sản Phẩm
- CRUD sản phẩm
- Quản lý danh mục sản phẩm (phân cấp đa cấp)
- Quản lý biến thể sản phẩm (variants)
- Quản lý thuộc tính (attributes)
- Upload nhiều hình ảnh
- Tối ưu SEO (meta tags)

#### Quản Lý Đơn Hàng
- Xem danh sách đơn hàng
- Chi tiết đơn hàng
- Cập nhật trạng thái đơn hàng
- Xác nhận và hủy đơn
- In hóa đơn
- Thống kê doanh thu

#### Quản Lý Khách Hàng
- Danh sách khách hàng
- Phân loại khách hàng
- Lịch sử mua hàng
- Thống kê khách hàng

#### Quản Lý Khuyến Mãi
- Tạo chương trình khuyến mãi
- Giảm giá theo phần trăm/số tiền
- Áp dụng cho sản phẩm/danh mục
- Thời gian áp dụng

#### Quản Lý Nội Dung
- CRUD bài viết/blog
- Quản lý danh mục bài viết
- Quản lý menu điều hướng
- Quản lý slide/banner trang chủ
- Widget quản lý

#### Quản Lý Hệ Thống
- Cài đặt chung website
- Quản lý ngôn ngữ (Multi-language)
- Quản lý resources (CSS, JS, Images)
- Cấu hình email
- Cấu hình thanh toán

## 💻 Yêu Cầu Hệ Thống

### Phần Mềm Cần Thiết

| Phần mềm | Phiên bản tối thiểu | Ghi chú |
|----------|---------------------|---------|
| PHP | 8.0.2+ | Khuyến nghị PHP 8.1+ |
| MySQL | 5.7+ | Hoặc MariaDB 10.3+ |
| Composer | 2.0+ | Package manager cho PHP |
| Node.js | 16.x+ | Khuyến nghị LTS version |
| NPM | 8.x+ | Hoặc Yarn 1.22+ |
| Web Server | - | Apache 2.4+ hoặc Nginx 1.18+ |

### PHP Extensions Bắt Buộc

```bash
# Kiểm tra extensions đã cài đặt
php -m
```

- ✅ OpenSSL - Mã hóa SSL/TLS
- ✅ PDO - Database abstraction layer
- ✅ Mbstring - Xử lý multi-byte strings
- ✅ Tokenizer - Parsing PHP code
- ✅ XML - XML manipulation
- ✅ Ctype - Character type checking
- ✅ JSON - JSON manipulation
- ✅ BCMath - Tính toán số học chính xác
- ✅ Fileinfo - File type detection
- ✅ GD - Image processing

## 🚀 Cài Đặt

### Hướng Dẫn Cài Đặt Nhanh

```bash
# Clone repository
git clone <repository-url> spaminhthiem
cd spaminhthiem

# Cài đặt dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Tạo database và chạy migrations
php artisan migrate --seed

# Tạo storage link
php artisan storage:link

# Build assets và chạy server
npm run dev
php artisan serve
```

### Chi Tiết Từng Bước

#### 1. Clone Repository

```bash
git clone <repository-url> spaminhthiem
cd spaminhthiem
```

### 2. Cài Đặt Dependencies

#### Backend (PHP/Composer)
```bash
composer install
```

#### Frontend (Node.js/NPM)
```bash
npm install
```

### 3. Cấu Hình Environment

Sao chép file `.env.example` thành `.env`:

```bash
cp .env.example .env
```

Tạo Application Key:

```bash
php artisan key:generate
```

### 4. Cấu Hình Database

Chỉnh sửa file `.env` với thông tin database của bạn:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=spaminhthiem
DB_USERNAME=root
DB_PASSWORD=
```

Tạo database:

```bash
mysql -u root -p
CREATE DATABASE spaminhthiem CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### 5. Chạy Migration & Seeder

```bash
php artisan migrate
php artisan db:seed
```

### 6. Tạo Storage Link

```bash
php artisan storage:link
```

### 7. Build Frontend Assets

#### Development
```bash
npm run dev
```

#### Production
```bash
npm run build
```

### 8. Khởi Động Server

```bash
php artisan serve
```

Website sẽ chạy tại: `http://localhost:8000`

#### Hoặc sử dụng XAMPP

- Copy project vào thư mục `C:\xampp\htdocs\`
- Truy cập: `http://localhost/spaminhthiem/public`

## ⚙️ Cấu Hình

### 📧 Email Configuration

Chỉnh sửa trong file `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 💳 PayPal Configuration

```env
PAYPAL_MODE=sandbox
PAYPAL_SANDBOX_CLIENT_ID=your-sandbox-client-id
PAYPAL_SANDBOX_CLIENT_SECRET=your-sandbox-secret
PAYPAL_LIVE_CLIENT_ID=your-live-client-id
PAYPAL_LIVE_CLIENT_SECRET=your-live-secret
```

### 🏦 VNPay Configuration

Cấu hình trong `config/apps/general.php` hoặc file cấu hình tương tự:

```php
'vnpay' => [
    'tmn_code' => 'YOUR_TMN_CODE',
    'hash_secret' => 'YOUR_HASH_SECRET',
    'url' => 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html',
    'return_url' => 'http://yourdomain.com/vnpay/callback',
],
```

### 📱 MoMo Configuration

```php
'momo' => [
    'partner_code' => 'YOUR_PARTNER_CODE',
    'access_key' => 'YOUR_ACCESS_KEY',
    'secret_key' => 'YOUR_SECRET_KEY',
    'endpoint' => 'https://test-payment.momo.vn/v2/gateway/api/create',
    'return_url' => 'http://yourdomain.com/momo/callback',
    'notify_url' => 'http://yourdomain.com/momo/notify',
],
```

## 📘 Sử Dụng

### 👤 Tài Khoản Admin Mặc Định

Sau khi chạy seeder, bạn có thể đăng nhập vào admin panel với:

```
URL: http://localhost:8000/admin
Email: admin@example.com
Password: password
```

*(Lưu ý: Cần kiểm tra seeder để xác nhận thông tin chính xác)*

### Cấu Trúc URL

- **Frontend**: `http://localhost:8000/`
- **Admin Panel**: `http://localhost:8000/admin`
- **API**: `http://localhost:8000/api/`

### Các URL Quan Trọng

#### Frontend
- Trang chủ: `/`
- Danh sách sản phẩm: `/san-pham.html`
- Chi tiết sản phẩm: `/san-pham/{slug}.html`
- Giỏ hàng: `/gio-hang.html`
- Thanh toán: `/thanh-toan.html`
- Đăng nhập: `/dang-nhap.html`
- Đăng ký: `/dang-ky.html`

#### Admin
- Dashboard: `/admin/dashboard`
- Sản phẩm: `/admin/product/index`
- Đơn hàng: `/admin/order/index`
- Khách hàng: `/admin/customer/index`
- Bài viết: `/admin/post/index`

## 📂 Cấu Trúc Dự Án

```
spaminhthiem/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Backend/       # Admin controllers
│   │   │   ├── Frontend/      # Frontend controllers
│   │   │   └── Ajax/          # AJAX API controllers
│   │   ├── Middleware/        # Custom middleware
│   │   ├── Requests/          # Form validation
│   │   └── ViewComposers/     # View composers
│   ├── Models/                # Eloquent models
│   ├── Services/              # Business logic layer
│   ├── Repositories/          # Repository pattern
│   ├── Helpers/               # Helper functions
│   ├── Traits/                # Reusable traits
│   └── Providers/             # Service providers
├── config/
│   ├── apps/
│   │   └── general.php        # Custom app config
│   ├── paypal.php             # PayPal configuration
│   └── ...
├── database/
│   ├── migrations/            # Database migrations
│   ├── seeders/               # Database seeders
│   └── factories/             # Model factories
├── public/
│   ├── backend/               # Admin static assets
│   │   ├── js/
│   │   ├── css/
│   │   └── images/
│   └── frontend/              # Frontend static assets
│       ├── js/
│       ├── css/
│       └── images/
├── resources/
│   ├── views/
│   │   ├── backend/           # Admin views (Blade)
│   │   └── frontend/          # Frontend views (Blade)
│   ├── css/
│   │   └── app.css
│   └── js/
│       └── app.js
├── routes/
│   ├── web.php                # Web routes
│   ├── api.php                # API routes
│   └── ...
├── storage/                   # App storage
├── vendor/                    # Composer dependencies
├── .env                       # Environment configuration
├── composer.json              # Composer dependencies
├── package.json               # NPM dependencies
├── vite.config.js             # Vite configuration
└── artisan                    # Laravel CLI
```

## 🛠️ Technologies

### Backend Stack

| Công nghệ | Phiên bản | Mục đích |
|-----------|-----------|----------|
| **Laravel** | 9.19 | PHP Framework |
| **PHP** | 8.0+ | Backend Language |
| **MySQL** | 5.7+ | Database |
| **Eloquent ORM** | - | Object-Relational Mapping |
| **Laravel Sanctum** | 3.0 | API Authentication |

### Frontend Stack

| Công nghệ | Phiên bản | Mục đích |
|-----------|-----------|----------|
| **Blade** | - | Template Engine |
| **Vite** | 4.0 | Build Tool & Hot Reload |
| **jQuery** | Latest | DOM Manipulation |
| **Axios** | 1.1+ | HTTP Client |
| **AJAX** | - | Asynchronous Requests |
| **Custom CSS** | - | Styling |

### Key Dependencies

#### Composer Packages
```json
{
  "bumbummen99/shoppingcart": "^4.2",    // Shopping cart management
  "srmklive/paypal": "^3.0",             // PayPal integration
  "yoeunes/toastr": "^2.3",              // Toast notifications
  "doctrine/dbal": "^3.9",               // Database schema tools
  "guzzlehttp/guzzle": "^7.2",           // HTTP client
  "ramsey/uuid": "^4.7"                  // UUID generation
}
```

#### NPM Packages
```json
{
  "axios": "^1.1.2",                     // Promise-based HTTP client
  "laravel-vite-plugin": "^0.7.2",       // Vite integration
  "lodash": "^4.17.19",                  // Utility library
  "vite": "^4.0.0"                       // Build tool
}
```

### Architecture Patterns

- **MVC (Model-View-Controller)**: Core architecture
- **Service Layer Pattern**: Business logic separation
- **Repository Pattern**: Data access abstraction
- **Dependency Injection**: Loose coupling
- **Eloquent ORM**: Database interactions

## 🌐 API Endpoints

### AJAX Endpoints (Frontend)

> **Base URL**: `http://localhost:8000/ajax`

#### 🛒 Cart API

| Method | Endpoint | Description | Request Body |
|--------|----------|-------------|--------------|
| POST | `/ajax/cart/create` | Thêm sản phẩm vào giỏ | `{product_id, quantity, variant_id}` |
| POST | `/ajax/cart/update` | Cập nhật số lượng | `{cart_id, quantity}` |
| POST | `/ajax/cart/delete` | Xóa sản phẩm khỏi giỏ | `{cart_id}` |

**Ví dụ Request:**
```javascript
// Thêm sản phẩm vào giỏ
$.ajax({
    url: '/ajax/cart/create',
    method: 'POST',
    data: {
        product_id: 123,
        quantity: 2,
        variant_id: 456,
        _token: $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
        console.log('Added to cart:', response);
    }
});
```

#### 📦 Product API

| Method | Endpoint | Description | Parameters |
|--------|----------|-------------|------------|
| GET | `/ajax/product/filter` | Lọc sản phẩm | `category, price_range, sort` |
| POST | `/ajax/product/follow` | Yêu thích sản phẩm | `{product_id}` |

#### ⭐ Review API

| Method | Endpoint | Description | Request Body |
|--------|----------|-------------|--------------|
| POST | `/ajax/review/create` | Tạo đánh giá | `{product_id, rating, comment, images}` |
| POST | `/ajax/review/like` | Like/Unlike review | `{review_id}` |

#### 📍 Location API

| Method | Endpoint | Description | Parameters |
|--------|----------|-------------|------------|
| GET | `/ajax/location/getLocation` | Lấy tỉnh/quận/phường | `type, parent_id` |

**Response Format:**
```json
{
    "status": "success",
    "data": {
        "provinces": [...],
        "districts": [...],
        "wards": [...]
    }
}
```

### RESTful API Routes

Kiểm tra file `routes/api.php` cho đầy đủ API endpoints.

**Authentication:** Bearer Token (Laravel Sanctum)

```bash
# Example with cURL
curl -H "Authorization: Bearer YOUR_TOKEN" \
     -H "Content-Type: application/json" \
     http://localhost:8000/api/products
```

## Database Schema

### Các Bảng Chính

- **users**: Tài khoản admin
- **customers**: Tài khoản khách hàng
- **products**: Sản phẩm
- **product_catalogues**: Danh mục sản phẩm
- **product_variants**: Biến thể sản phẩm
- **attributes**: Thuộc tính (size, color, etc.)
- **orders**: Đơn hàng
- **order_products**: Chi tiết đơn hàng
- **reviews**: Đánh giá sản phẩm
- **review_likes**: Lượt thích review
- **promotions**: Khuyến mãi
- **posts**: Bài viết
- **post_catalogues**: Danh mục bài viết
- **menus**: Menu điều hướng
- **slides**: Slide show
- **permissions**: Phân quyền
- **languages**: Đa ngôn ngữ
- **provinces, districts, wards**: Địa chỉ Việt Nam

## Development

### Chạy Development Server

```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Vite dev server
npm run dev
```

### Chạy Tests

```bash
php artisan test
```

### Code Quality

```bash
# PHP CS Fixer
composer fix-cs

# PHPStan
composer analyse
```

### Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Tối Ưu Production

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

## Deployment

### Chuẩn Bị Production

1. Cấu hình `.env` cho production:
```env
APP_ENV=production
APP_DEBUG=false
```

2. Tối ưu autoload:
```bash
composer install --optimize-autoloader --no-dev
```

3. Cache config:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

4. Build assets:
```bash
npm run build
```

5. Set permissions:
```bash
chmod -R 755 storage bootstrap/cache
```

### Requirements Server

- PHP >= 8.0.2
- MySQL >= 5.7
- Composer
- Node.js & NPM (để build assets)
- SSL certificate (khuyến nghị)

## Đóng Góp

Mọi đóng góp đều được chào đón! Vui lòng:

1. Fork repository
2. Tạo branch mới (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Mở Pull Request

## Bảo Mật

Nếu phát hiện lỗ hổng bảo mật, vui lòng gửi email trực tiếp thay vì tạo issue công khai.

## Changelog

### Version 1.0.0 (Current)
- Hoàn thành sơ lược toàn bộ website
- Thêm chức năng mua ngay
- Tích hợp PayPal, VNPay, MoMo
- Hệ thống giỏ hàng với AJAX
- Admin panel đầy đủ tính năng
- Hệ thống review & rating
- Hỗ trợ đa ngôn ngữ

## License

[Thêm thông tin license của bạn ở đây]

## Liên Hệ

- **Email**: [dungnhung1209@example.com]
- **Website**: [jobbox.com.vn]
- **GitHub**: [github.com/dungrs]

## Credits

Dự án sử dụng các thư viện và packages mã nguồn mở tuyệt vời từ cộng đồng Laravel và PHP.

---

Được phát triển với Laravel 9 | Copyright © 2025
