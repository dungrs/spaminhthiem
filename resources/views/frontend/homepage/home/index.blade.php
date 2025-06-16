
@php
    $slideKeyword = app('App\\Classes\\SlideEnum');
@endphp
<main class="body">
    <div class="container">
        <section class="carousel mt-2">
            @include('frontend.component.slide')
        </section>

        <section class="mt-5">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-uppercase section-home-header">
                    @if (isset($widgets['summer-deal-hunt']['name']))
                        {{ $widgets['summer-deal-hunt']['name'] }}
                    @endif
                </h3>
            </div>
        
            @if (isset($widgets['summer-deal-hunt']))
                <div class="row mt-3 row-gap-4">
                    <div class="position-relative px-3">
                        <div class="swiper products-swiper" data-row="2">
                            <div class="swiper-wrapper">
                                @foreach ($widgets['summer-deal-hunt']['object'] as $object)
                                    <div class="swiper-slide">
                                        <div class="card border-0 shadow-none h-100 text-center">
                                            <!-- Product Image (Rounded) -->
                                            <div class="d-flex justify-content-center">
                                                <img src="{{ $object->image }}" 
                                                    class="rounded-circle img-fluid" 
                                                    alt="{{ $object->name }}" 
                                                    style="width: 120px; height: 120px; object-fit: cover;">
                                            </div>

                                            <!-- Product Name Below Image -->
                                            <div class="card-body p-2">
                                                <h5 class="card-title mb-0 mt-2" style="font-size: 0.9rem;">
                                                    {{ $object->name }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="swiper-button-prev-custom">
                                <i class="fas fa-chevron-left"></i>
                            </div>
                            <div class="swiper-button-next-custom">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>

        <section class="mt-5">
            <div class="sale-header d-flex align-items-center justify-content-between pb-2 border-bottom border-danger">
                <div class="header_left">
                    <img src="./frontend/img/icon/icon-fls.svg" class="img-fluid">
                    <div id="sale-clock"></div>
                </div>
                <div class="header-right d-flex align-items-center gap-2 cursor-pointer text-danger fw-semibold" style="font-size: 15px;">
                    <span>Xem tất cả</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>

            @if (isset($widgets['best-seller']))
                <div class="row mt-3 row-gap-4">
                    <div class="position-relative px-3">
                        <div class="swiper products-swiper" data-row="2">
                            <div class="swiper-wrapper">
                                @foreach ($widgets['best-seller']['object'] as $object)
                                    @include('frontend.component.productItem', ['product' => $object])
                                @endforeach
                            </div>
                            
                            <div class="swiper-button-prev-custom">
                                <i class="fas fa-chevron-left"></i>
                            </div>
                            <div class="swiper-button-next-custom">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>

        <section class="mt-5">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-uppercase section-home-header">
                    @if (isset($widgets['product-most-viewed']['name']))
                        {{ $widgets['product-most-viewed']['name'] }}
                    @endif
                </h3>
            </div>

            @if (isset($widgets['product-most-viewed']))
                <div class="row mt-3 row-gap-4">
                    <div class="position-relative px-3">
                        <div class="swiper products-swiper" data-row="2">
                            <div class="swiper-wrapper">
                                @foreach ($widgets['product-most-viewed']['object'] as $object)
                                    @include('frontend.component.productItem', ['product' => $object])
                                @endforeach
                            </div>
                            <div class="swiper-button-prev-custom">
                                <i class="fas fa-chevron-left"></i>
                            </div>
                            <div class="swiper-button-next-custom">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="text-center">
                <button class="btn btn-danger px-5 mt-4">Xem Tất Cả <i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </section>

        @if ($widgets['post-hl']['object'])
        <section class="news-section py-5">
            <div class="container">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-uppercase section-home-header">
                        TIN TỨC
                    </h3>
                </div>

                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="featured-news-card card border-0 shadow-sm overflow-hidden">
                            <div class="position-relative">
                                <img src="{{ $widgets['post-hl']['object']->first()->image }}" class="card-img-top" alt="Featured news">
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2 text-muted small">
                                    <span class="me-3"><i class="far fa-calendar-alt me-1"></i> {{ $widgets['post-hl']['object']->first()->created_at->format('d/m/Y') }}</span>
                                    <span><i class="far fa-eye me-1"></i> 1.2k lượt xem</span>
                                </div>
                                <h3 class="card-title">{{ $widgets['post-hl']['object']->first()->name }}</h3>
                                <p class="card-text">{{ $widgets['post-hl']['object']->first()->meta_description ?? '' }}</p>
                                <a href="{{ writeUrl($widgets['post-hl']['object']->first()->canonical, true, true) }}" class="btn btn-link px-0 text-danger text-decoration-none fw-bold">
                                    Đọc tiếp <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="news-list d-flex flex-column">
                            @foreach ($widgets['post-hl']['object']->skip(1) as $post)
                                <div class="card mb-3 overflow-hidden" style="height: 150px;">
                                    <div class="row g-0 h-100">
                                        <div class="col-md-4 h-100">
                                            <img src="{{ $post->image }}" 
                                                class="img-fluid w-100 h-100 rounded-start" 
                                                alt="News thumbnail" 
                                                style="object-fit: cover; display: block;">
                                        </div>
                                        <div class="col-md-8 d-flex flex-column h-100">
                                            <div class="card-body d-flex flex-column justify-content-between h-100 p-3">
                                                <div>
                                                    <div class="d-flex align-items-center mb-1 text-muted small">
                                                        <span class="me-2">
                                                            <i class="far fa-calendar-alt me-1"></i> {{ $post->created_at->format('d/m/Y') }}
                                                        </span>
                                                        <span>
                                                            <i class="far fa-eye me-1"></i> 856 lượt xem
                                                        </span>
                                                    </div>
                                                    <h6 class="card-title mb-1" style="font-size: 1rem;">{{ Str::limit($post->name, 60) }}</h6>
                                                    <p class="card-text mb-2 small text-muted text-truncate" style="font-size: 0.8rem;" title="{{ $post->meta_description }}">
                                                        {{ Str::limit($post->meta_description ?? '', 70) }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <a href="{{ writeUrl($post->canonical, true, true) }}" class="btn btn-link px-0 text-danger text-decoration-none fw-bold small">
                                                        Đọc tiếp <i class="fas fa-arrow-right ms-1"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button class="btn btn-danger px-5 mt-4">Xem Tất Cả <i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>
        </section>
        @endif

        <section class="mt-5">
            <div class="position-relative d-sm-flex">
                <img src="{{ asset("frontend/img/icon/store-bg.jpg") }}" class="w-100 d-sm-flex" height="600px">
                <div
                    class="group-text d-flex flex-column gap-3 align-items-start justify-content-start position-absolute top-50 start-0 w-50 translate-middle-y">
                    <h4>HỆ THỐNG CỬA HÀNG</h4>
                    <h3 class="fw-bold"><span class="text-danger">TOKYOLIFE</span> CÓ HỆ THỐNG CỬA HÀNG <br> TRÊN
                        TOÀN VIỆT NAM</h3>
                    <p>Trải dài trên khắp Việt Nam, TokyoLife mang đến cuộc sống hiện đại,<br> thông minh và chất
                        lượng hơn tới hàng triệu người tiêu dùng Việt.</p>
                    <button class="btn btn-danger px-5">Xem Vị Trí Cửa Hàng</button>
                </div>
            </div>
        </section>
    </div>

    <section class="mt-5 bg-menu-custom py-5">
        <div class="box-header">
            <h3 class="text-center mb-5">Chứng Nhận Chính Hãng </h3>
        </div>

        <div class="container p-0">
            <div class="row">
                <div class="col-xl-6 col-sm-12">
                    <img src="./frontend/img/icon/chung-nhan-chinh-hang.webp" class="img-fluid w-100">
                </div>

                <div class="col-xl-6 col-sm-2 d-flex flex-column align-items-start justify-content-start gap-3">
                    <div class="box-header d-flex flex-row align-items-center gap-4">
                        <img src="./frontend/img/icon/icon-special.svg" alt="" class="img-fluid">
                        <p class="mb-0 fs-5 fw-bold">CHỨNG NHẬN NHẬP KHẨU SẢN PHẨM CHÍNH HÃNG TỪ CÁC THƯƠNG HIỆU NỔI
                            TIẾNG NHẬT BẢN ...</p>
                    </div>

                    <p class="box-content">
                        TokyoLife cam kết luôn mang tới cho khách hàng các sản phẩm tốt chính hãng đến từ các các
                        thương hiệu Nhật Bản. Tất cả sản phẩm MADE IN JAPAN đều có giấy chứng nhận nhập khẩu chính
                        hãng từ các nhà phân phối nhằm đưa tới sự trải nghiệm sản phẩm tốt nhất dành cho khách hàng
                        thân yêu của TokyoLife.
                    </p>

                    <button class="btn btn-danger">
                        Xem Thêm
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div
                    class="col-xl-3 col-md-4 col-sm-6 text-center p-4 rounded-2 shadow-sm multi-box d-flex flex-column align-items-center justify-content-between">
                    <img src="./frontend/img/icon/icon-like.svg" class="img-fluid">
                    <h6 class="fw-bold my-3">Hàng Hoá Chất Lượng</h6>
                    <small>Tận hưởng các mặt hàng chất lượng hàng đầu với giá cả hợp lý</small>
                </div>

                <div
                    class="col-xl-3 col-md-4 col-sm-6 text-center p-4 rounded-2 shadow-sm multi-box d-flex flex-column align-items-center justify-content-between">
                    <img src="./frontend/img/icon/icon-support.svg" class="img-fluid">
                    <h6 class="fw-bold my-3">Hàng Hoá Chất Lượng</h6>
                    <small>Tận hưởng các mặt hàng chất lượng hàng đầu với giá cả hợp lý</small>
                </div>

                <div
                    class="col-xl-3 col-md-4 col-sm-6 text-center p-4 rounded-2 shadow-sm multi-box d-flex flex-column align-items-center justify-content-between">
                    <img src="./frontend/img/icon/icon-truck.svg" class="img-fluid">
                    <h6 class="fw-bold my-3">Hàng Hoá Chất Lượng</h6>
                    <small>Tận hưởng các mặt hàng chất lượng hàng đầu với giá cả hợp lý</small>
                </div>

                <div
                    class="col-xl-3 col-md-4 col-sm-6 text-center p-4 rounded-2 shadow-sm multi-box d-flex flex-column align-items-center justify-content-between">
                    <img src="./frontend/img/icon/icon-money.svg" class="img-fluid">
                    <h6 class="fw-bold my-3">Hàng Hoá Chất Lượng</h6>
                    <small>Tận hưởng các mặt hàng chất lượng hàng đầu với giá cả hợp lý</small>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-5 thankyou-section">
        <div class="container py-5 text-center d-flex flex-column gap-3 justify-content-between  align-items-center">
            <img src="./frontend/img/icon/logo-white.svg" class="img-fluid" width="150px">

            <h5 class="fst-italic text-white">
                TokyoLife trân trọng cảm ơn Quý Khách đã ủng hộ và góp phần tạo thêm cơ hội việc làm cho 142 người
                khuyết tật.
            </h5>

            <p class="fst-italic mb-0 text-white">
                TokyoLife là cửa hàng bán lẻ đồ gia dụng, hóa mỹ phẩm, phụ kiện chính hãng các thương hiệu Nhật Bản:
                Inomata, Ebisu, ORP Tokyo, Momotani, Naturie, Rohto (Hada Labo, Melano CC...), Kose (Dòng Softymo),
                Shiseido (Dòng Senka, Anessa, Tsubaki, Uno, D.Program), KAO (Biore, Laurier), Rosette, Unicharm,
                Rocket, Naris, Meishoku, Chuchu Baby, Deonatulle, Kumano, Taiyo Brush, Okamura, Dentultima, KAI,
                Pelican… Nước hoa TokyoLife sản xuất tại Pháp. Hóa phẩm lành tính TokyoLife sản xuất tại Nhật Bản.
                Mỹ phẩm TokyoLife sản xuất tại Nhật Bản, Hàn Quốc. Sản phẩm Thời trang và Phụ kiện hiệu: TokyoLife,
                TokyoNow, TokyoBasic, TokyoSmart, TokyoSecret. Sản phẩm tiêu dùng hiệu: TokyoLife, TokyoHome,
                TokyoSword... và nhiều thương hiệu khác sản xuất tại Việt Nam, Trung Quốc, Thái Lan…
            </p>
        </div>
    </section>

    @include("frontend.component.productDetailsModal")
</main>