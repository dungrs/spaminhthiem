<body id="template-index">
    @php $slideKeyword = app('App\\Classes\\SlideEnum'); @endphp

    <h1 class="d-none">Mỹ Phẩm Thu Cúc | Mỹ Phẩm Ngành Spa Chính Hãng</h1>
    <section class="section awe-section-1">
        <div class="container section mt-0">
            <div class="row">
                @include("frontend.homepage.component.navigation") 
                @include("frontend.homepage.component.bannerSlide")
            </div>
        </div>
    </section>

    {{-- Main --}}
    <section class="section awe-section-2 my-4">
        <div class="text-center my-3">
            <h2 class="fw-bold section-home-header">
                Mỹ Phẩm Cho Spa Cao Cấp
            </h2>
        </div>
        <div class="container card border-0 shadow-none">
            <p class="minhthiem-desc">
                👉 Mỹ Phẩm Thu Cúc - Chuyên nhập khẩu và phân phối sỉ lẻ mỹ phẩm cho Spa trên toàn quốc. Hơn <strong>5000+ sản phẩm chính hãng</strong>, <strong>600+ thương hiệu</strong> đến từ <strong>20 quốc gia</strong>.
            </p>
        </div>
        <section class="section_collections section">
            <div class="container card border-0 shadow-none">
                <div class="text-center row flex-nowrap collections-slide">
                    @if (isset($widgets['auth-spa-skincare'])) @foreach ($widgets['auth-spa-skincare']['object'] as $object)
                    <div class="item">
                        <a href="{{ writeUrl($object->canonical, true, true) }}" title="{{ $object->name }}" class="pos-relative d-flex align-items-center" style="aspect-ratio: 120/ 120;">
                            <img class="img-fluid object-contain mh-100 rounded-pill" loading="lazy" src="{{ $object->image }}" width="120" height="120" alt="coll_1_title" />
                        </a>
                        <h3 class="mb-0">
                            <a href="{{ writeUrl($object->canonical, true, true) }}" title="{{ $object->name }}">{{ $object->name }}</a>
                        </h3>
                    </div>
                    @endforeach @endif
                </div>
            </div>
        </section>
    </section>

    <section class="section awe-section-4">
        <link rel="stylesheet" href="//bizweb.dktcdn.net/100/494/811/themes/921992/assets/flashsale.css?1717567288856" media="print" onload="this.media='all'" />
        <noscript>
            <link href="//bizweb.dktcdn.net/100/494/811/themes/921992/assets/flashsale.css?1717567288856" rel="stylesheet" type="text/css" media="all" />
        </noscript>
        <section
            class="section_flashsale flashsale"
            style="
                --background-color: #f44c26;
                --countdown-background: #ffffff;
                --countdown-color: #f43409;
                --process-background: #b4e8d1;
                --process-color1: #069dba;
                --process-color2: #19bf6a;
                --stock-color: #242424;
                --news-color: #000000;
            "
        >
            <div class="container pt-3 py-2 card border-0">
                <div class="title_module_main row heading-bar d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center flex-wrap flashsale__header col-12 col-lg-6">
                        <div>
                            <h3 class="heading-bar__title flashsale__title">
                                <a class="link" href="uu-dai-hot" title="{{ $widgets['hot-deal']['name'] }}">{{ $widgets['hot-deal']['name'] }}</a>
                            </h3>

                            <span class="flashsale__countdown-label" style="display: none;">Sản phẩm sẽ trở về giá gốc khi hết giờ</span>
                        </div>
                        <div class="flashsale__countdown-wrapper">
                            <div class="flashsale__countdown" data-countdown-type="hours" data-countdown=""></div>
                        </div>
                    </div>
                    <div class="flashsale__news col-12 col-lg-6 product-col" style="min-width: 0px;">
                        <span class="flashsale__news-title">KHUYẾN MÃI NGAY HÔM NAY</span>
                        <div class="flashsale__news-list" style="min-width: 0px;">
                            <a href="/" title="Giảm 20K cho đơn hàng từ 499K">Giảm 20K cho đơn hàng từ 499K</a>
                            <a href="/" title="Giảm 8% cho đơn hàng từ 499K">Giảm 8% cho đơn hàng từ 499K</a>
                            <a href="/" title="Giảm 10% cho đơn hàng từ 800K">Giảm 10% cho đơn hàng từ 800K</a>
                        </div>
                    </div>
                </div>
                <div>
                    @if (isset($widgets['hot-deal']))
                    <div class="row mt-3" style="--limit-column: 5;">
                        @foreach ($widgets['hot-deal']['object']->take(5) as $object)
                        <div class="flashsale__item col-12 col-xl-15">
                            @include('frontend.component.productItem', ['product' => $object])
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <div class="text-center mb-3 mt-1">
                        <a href="uu-dai-hot" title="Xem tất cả" class="btn btn-main btn-icon">
                            Xem tất cả
                            <svg class="icon">
                                <use xlink:href="#icon-arrow" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <script>
            window.flashSale = {
                flashSaleColl: "uu-dai-hot",
                type: "hours",
                dateStart: "01/11/2023",
                dateFinish: "1",
                hourStart: "00:00",
                hourFinish: "24",
                activeDay: "7",
                finishAction: "show",
                finishLabel: "Ch\u01b0\u01a1ng tr\xecnh \u0111\xe3 k\u1ebft th\xfac",
                percentMin: "50",
                percentMax: "90",
                maxInStock: "300",
                useSoldQuantity: false,
                useTags: false,
                timestamp: new Date().getTime(),
                openingText: "V\u1eeba m\u1edf b\xe1n",
                soldText: "\u0110\xe3 b\xe1n [soluong]",
                outOfStockSoonText: "\ud83d\udd25 S\u1eafp b\xe1n h\u1ebft",
            };
        </script>

        <script src="//bizweb.dktcdn.net/100/494/811/themes/921992/assets/flashsale.js?1717567288856" defer></script>
    </section>

    {{-- Danh sách thương hiệu --}}
    <section class="section awe-section-5">
        <section class="section_brand section">
            <div class="container card border-0 shadow-none">
                <div class="text-center my-4">
                    <h3 class="fw-bold section-home-header">
                        Thương Hiệu Mỹ Phẩm Spa
                    </h3>
                </div>

                <p class="minhthiem-desc">
                    👉 Thương hiệu Mỹ Phẩm Spa – Nơi hội tụ các dòng mỹ phẩm cao cấp dành riêng cho Spa. Hơn <strong>600+ thương hiệu uy tín</strong>, <strong>5000+ sản phẩm chính hãng</strong> từ <strong>20 quốc gia hàng đầu</strong>.
                </p>
                
                <div class="row mx-0 hrz-scroll text-center flex-nowrap js-slider justify-content-around">
                    <div class="item">
                        <a href="/esthemax" class="brand-item pos-relative d-flex align-items-center aspect-ratio" title="Esthemax -Esthepro" style="--width: 176; --height: 99;">
                            <img loading="lazy" class="img-fluid m-auto object-contain mh-100 w-auto" src="//bizweb.dktcdn.net/100/494/811/themes/921992/assets/brand_1.jpg?1717567288856" alt="brand_1_title" width="176" height="99" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="/desembre-han-quoc" class="brand-item pos-relative d-flex align-items-center aspect-ratio" title="Desembre" style="--width: 176; --height: 99;">
                            <img loading="lazy" class="img-fluid m-auto object-contain mh-100 w-auto" src="//bizweb.dktcdn.net/100/494/811/themes/921992/assets/brand_2.jpg?1717567288856" alt="brand_2_title" width="176" height="99" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="/gsc" class="brand-item pos-relative d-flex align-items-center aspect-ratio" title="GSC+" style="--width: 176; --height: 99;">
                            <img loading="lazy" class="img-fluid m-auto object-contain mh-100 w-auto" src="//bizweb.dktcdn.net/100/494/811/themes/921992/assets/brand_3.jpg?1717567288856" alt="brand_3_title" width="176" height="99" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="/my-pham-skindom" class="brand-item pos-relative d-flex align-items-center aspect-ratio" title="Skindom" style="--width: 176; --height: 99;">
                            <img loading="lazy" class="img-fluid m-auto object-contain mh-100 w-auto" src="//bizweb.dktcdn.net/100/494/811/themes/921992/assets/brand_4.jpg?1717567288856" alt="brand_4_title" width="176" height="99" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="/smas" class="brand-item pos-relative d-flex align-items-center aspect-ratio" title="Smas" style="--width: 176; --height: 99;">
                            <img loading="lazy" class="img-fluid m-auto object-contain mh-100 w-auto" src="//bizweb.dktcdn.net/100/494/811/themes/921992/assets/brand_5.jpg?1717567288856" alt="brand_5_title" width="176" height="99" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="/huesday" class="brand-item pos-relative d-flex align-items-center aspect-ratio" title="Huesday" style="--width: 176; --height: 99;">
                            <img loading="lazy" class="img-fluid m-auto object-contain mh-100 w-auto" src="//bizweb.dktcdn.net/100/494/811/themes/921992/assets/brand_6.jpg?1717567288856" alt="brand_6_title" width="176" height="99" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="/kamel" class="brand-item pos-relative d-flex align-items-center aspect-ratio" title="Karmel" style="--width: 176; --height: 99;">
                            <img loading="lazy" class="img-fluid m-auto object-contain mh-100 w-auto" src="//bizweb.dktcdn.net/100/494/811/themes/921992/assets/brand_7.jpg?1717567288856" alt="brand_7_title" width="176" height="99" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="/lindsay" class="brand-item pos-relative d-flex align-items-center aspect-ratio" title="Lindsay" style="--width: 176; --height: 99;">
                            <img loading="lazy" class="img-fluid m-auto object-contain mh-100 w-auto" src="//bizweb.dktcdn.net/100/494/811/themes/921992/assets/brand_8.jpg?1717567288856" alt="brand_8_title" width="176" height="99" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="/medic-roller" class="brand-item pos-relative d-flex align-items-center aspect-ratio" title="Medic roller" style="--width: 176; --height: 99;">
                            <img loading="lazy" class="img-fluid m-auto object-contain mh-100 w-auto" src="//bizweb.dktcdn.net/100/494/811/themes/921992/assets/brand_9.jpg?1717567288856" alt="brand_9_title" width="176" height="99" />
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <section class="section awe-section-6">
        <section class="section_product_tag section">
            <div class="container card border-0 shadow-none">
                <div class="text-center my-4">
                    <h3 class="fw-bold section-home-header">
                        {{ $widgets['product-most-viewed']['name'] }}
                    </h3>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-12">
                        <div class="d-lg-block d-none py-3">
                            <a class="banner" href="#" title=" best seller">
                                <img loading="lazy" class="img-fluid" src="//bizweb.dktcdn.net/100/494/811/themes/921992/assets/product_tag_banner.jpg?1717567288856" width="330" height="463" alt=" best seller" />
                            </a>
                        </div>
                        <div class="tag-list pb-3" style="--tag-bg: #efe7d5; --tag-color: #2f4858;">
                            <a class="tag-item" href="/search?q=tags:(desembre)" title="desembre">desembre</a>
                            <a class="tag-item" href="/search?q=tags:(+GSC%2B)" title=" GSC+">GSC+</a>
                            <a class="tag-item" href="/search?q=tags:(+Esthemax)" title=" Esthemax">Esthemax</a>
                            <a class="tag-item" href="/search?q=tags:(+Serum+M%E1%BB%A5n)" title=" Serum Mụn">Serum Mụn</a>
                            <a class="tag-item" href="/search?q=tags:(+M%E1%BA%B7t+N%E1%BA%A1)" title=" Mặt Nạ">Mặt Nạ</a>
                            <a class="tag-item" href="/search?q=tags:(+Medic+Roller)" title=" Medic Roller">Medic Roller</a>
                            <a class="tag-item" href="/search?q=tags:(+Smas)" title=" Smas">Smas</a>
                            <a class="tag-item" href="/search?q=tags:(+Gi%E1%BA%A3m+Gi%C3%A1)" title=" Giảm Giá">Giảm Giá</a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-12">
                        <div class="row mt-3" data-section="product-tag-section">
                            @foreach ($widgets['product-most-viewed']['object']->take(8) as $object)
                            <div class="col-6 product-col col-md-3 col-lg-4 col-xl-3">
                                <div class="item_product_main product-col item_skeleton"></div>
                            </div>
                            @endforeach
                            <script type="text/x-custom-template" data-template="product-tag-section">
                                @foreach ($widgets['product-most-viewed']['object']->take(8) as $object)
                                  <div class="col-6 product-col col-md-3 col-lg-4 col-xl-3">
                                    @include('frontend.component.productItem', ['product' => $object])
                                  </div>
                                @endforeach
                            </script>
                        </div>
                        <div class="text-center mt-3 col-12">
                            <a href="serum-tinh-chat-tri-mun" title="Xem tất cả" class="btn btn-main btn-icon">
                                Xem tất cả
                                <svg class="icon">
                                    <use xlink:href="#icon-arrow" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

    {{-- Banner Trong Trang --}}
    <section class="section awe-section-7">
        <div class="section_banner_adv">
            <div class="container">
                <div class="text-center row">
                    <a class="col-12 banner" href="#" title="Hot product">
                        <picture>
                            <source media="(max-width: 600px)" srcset="//bizweb.dktcdn.net/thumb/grande/100/494/811/themes/921992/assets/section_hot_banner.png?1717567288856" />
                            <img class="img-fluid" loading="lazy" src="//bizweb.dktcdn.net/100/494/811/themes/921992/assets/section_hot_banner.png?1717567288856" alt="Hot product" width="1410" height="176" />
                        </picture>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="section awe-section-8">
        <section class="section_product_top section">
            <div class="container card border-0 shadow-none">
                
                <div class="text-center my-4">
                    <h3 class="fw-bold section-home-header">
                        {{ $widgets['product-most-viewed']['name'] }}
                    </h3>
                </div>
                    {{--
                    <ul class="tabs tabs-title list-unstyled m-0 mt-2 tabs-group d-flex align-items-center">
                        <li class="ega-small tab-link px-3 py-2 link current" data-tab="tab-1">Kem Massage</li>
                        <li class="ega-small tab-link px-3 py-2 linkml-2" data-tab="tab-2">Sữa Rửa Mặt</li>
                        <li class="ega-small tab-link px-3 py-2 linkml-2" data-tab="tab-3">Mặt Nạ Spa</li>
                    </ul>
                    --}}
                <div class="e-tabs">
                    <div id="tab-1" class="tab-content content_extab current">
                        <div class="row mt-3" style="--limit-column: 5;" data-section="tab-section">
                            @foreach ($widgets['product-most-viewed']['object']->take(5) as $object)
                            <div class="col-12 col-xl-15 product-col">
                                <div class="item_product_main item_skeleton"></div>
                            </div>
                            @endforeach

                            <script type="text/x-custom-template" data-template="tab-section">
                                @foreach ($widgets['product-most-viewed']['object']->take(5) as $object)
                                  <div class="col-12 col-xl-15 product-col">
                                    @include('frontend.component.productItem', ['product' => $object])
                                  </div>
                                @endforeach
                            </script>
                        </div>
                        <div class="text-center mt-3 col-12">
                            <a href="kem-massage-mat" title="Xem tất cả" class="btn btn-main btn-icon">
                                Xem tất cả
                                <svg class="icon">
                                    <use xlink:href="#icon-arrow" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <section class="section awe-section-9">
        <section class="section_product_new section">
            <div class="container card border-0 shadow-none">
                <div class="text-center my-4">
                    <h3 class="fw-bold section-home-header">
                        {{ $widgets['product-most-viewed']['name'] }}
                    </h3>
                </div>
                <div class="row mt-3" data-section="hot-section">
                    <div class="col-12 col-xl-30 text-center pb-3 product-col">
                        <a class="banner" href="#" title="{{ $widgets['product-most-viewed']['name'] }}">
                            <picture>
                                <source media="(max-width: 480px)" srcset="//bizweb.dktcdn.net/thumb/large/100/494/811/themes/921992/assets/section_hot.jpg?1717567288856" />
                                <img
                                    class="img-fluid"
                                    loading="lazy"
                                    src="//bizweb.dktcdn.net/thumb/grande/100/494/811/themes/921992/assets/section_hot.jpg?1717567288856"
                                    width="546"
                                    height="353"
                                    alt="{{ $widgets['product-most-viewed']['name'] }}"
                                />
                            </picture>
                        </a>
                    </div>

                    @foreach ($widgets['product-most-viewed']['object']->take(8) as $object)
                    <div class="col-6 col-md-4 col-lg-3 col-xl-15 product-col">
                        <div class="item_product_main item_skeleton"></div>
                    </div>
                    @endforeach
                    <script type="text/x-custom-template" data-template="hot-section">
                        @foreach ($widgets['product-most-viewed']['object']->take(8) as $object)
                          <div class="col-6 col-md-4 col-lg-3 col-xl-15 product-col">
                            @include('frontend.component.productItem', ['product' => $object])
                          </div>
                        @endforeach
                    </script>
                </div>
                <div class="text-center mt-3 col-12">
                    <a href="dau-tay-trang" title="Xem tất cả" class="btn btn-main">
                        Xem tất cả
                        <svg class="icon">
                            <use xlink:href="#icon-arrow" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    </section>

    <section class="section awe-section-11">
        <section class="section_blog section">
            <div class="container card border-0 shadow-none">
                <div class="text-center my-4">
                    <h3 class="fw-bold section-home-header">
                        {{ $widgets['post-hl']['name'] }}
                    </h3>
                </div>
                <div class="row mt-3">
                    @foreach ($widgets['post-hl']['object']->take(4) as $post)
                    <div class="col-lg-3 col-6 product-col">
                        <div class="blogwp clearfix card border-0 shadow-none">
                            <a
                                class="image-blog card-img-top text-center position-relative d-flex align-items-center justify-content-center aspect-ratio"
                                href="{{ writeUrl($post->canonical, true, true) }}"
                                title="{{ Str::limit($post->name, 60) }}"
                                style="--width: 600; --height: 450;"
                            >
                                <img class="img-fluid m-auto object-contain mh-100 w-auto position-absolute" loading="lazy" src="{{ $post->image }}" width="600" height="450" alt="{{ Str::limit($post->name, 60) }}" />
                            </a>
                            <div class="content_blog clearfix card-body px-0 py-2">
                                <h3>
                                    <a class="link" href="{{ writeUrl($post->canonical, true, true) }}" title="{{ Str::limit($post->name, 60) }}">{{ Str::limit($post->name, 60) }}</a>
                                </h3>
                                <div class="media">
                                    <div class="media-body">
                                        <div class="mt-0">Minh Thiêm</div>
                                        <small class="text-muted font-weight-light">
                                            {{ $post->created_at->format('d/m/Y') }}
                                        </small>
                                    </div>
                                </div>
                                <p class="justify">
                                    <span class="art-summary">{{ Str::limit($post->meta_description ?? '', 70) }}...</span>
                                    <a class="button_custome_35 link" href="{{ writeUrl($post->canonical, true, true) }}" title="Đọc tiếp">Đọc tiếp</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center">
                    <a href="tin-tuc" title="Xem tất cả" class="btn btn-main btn-icon">
                        Xem tất cả
                        <svg class="icon">
                            <use xlink:href="#icon-arrow" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    </section>

    @include("frontend.component.productDetailsModal")
</body>