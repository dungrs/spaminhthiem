<body id="template-index">
    @php $slideKeyword = app('App\\Classes\\SlideEnum'); @endphp

    <h1 class="d-none">{{ $systems['homepage_slogan'] }}</h1>
    <section class="section">
        <div class="container section mt-0">
            <div class="row">
                @include("frontend.homepage.component.navigation") 
                @include("frontend.homepage.component.bannerSlide")
            </div>
        </div>
    </section>

    {{-- Main --}}
    <section class="section my-4">
        <div class="text-center my-3">
            <h2 class="fw-bold section-home-header">
                {{ $widgets['auth-spa-skincare']['name'] }}
            </h2>
        </div>
        <div class="container card border-0 shadow-none">
            <div class="minhthiem-desc">
                {!! $widgets['auth-spa-skincare']['description'] !!}
            </div>
        </div>
        <section class="section_collections section">
            <div class="container card border-0 shadow-none">
                <div class="text-center row flex-nowrap collections-slide">
                    @if (isset($widgets['auth-spa-skincare'])) 
                        @foreach ($widgets['auth-spa-skincare']['object'] as $object)
                        <div class="item">
                            <a href="{{ writeUrl($object->canonical, true, true) }}" title="{{ $object->name }}" class="pos-relative d-flex align-items-center" style="aspect-ratio: 120/ 120;">
                                <img class="img-fluid object-contain mh-100 rounded-pill" loading="lazy" src="{{ $object->image }}" width="120" height="120" alt="coll_1_title" />
                            </a>
                            <h3 class="mb-0">
                                <a href="{{ writeUrl($object->canonical, true, true) }}" title="{{ $object->name }}">{{ $object->name }}</a>
                            </h3>
                        </div>
                        @endforeach 
                    @endif
                </div>
            </div>
        </section>
    </section>

    <section class="section">
        <link rel="stylesheet" href="{{ asset('frontend/css/flashsale.css') }}" media="print" onload="this.media='all'" />
        <noscript>
            <link href="{{ asset('frontend/css/flashsale.css') }}" rel="stylesheet" type="text/css" media="all" />
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
                        <a href="{{ writeUrl('my-pham', true, true) }}" title="Xem tất cả" class="btn btn-main btn-icon">
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

        <script src="{{ asset('frontend/js/flashsale.js') }}" defer></script>
    </section>

    {{-- Danh sách thương hiệu --}}
    <section class="section">
        <section class="section_brand section">
            <div class="container card border-0 shadow-none">
                <div class="text-center my-3">
                    <h2 class="fw-bold section-home-header">
                        {{ $widgets['spa-brand-highlight']['name'] }}
                    </h2>
                </div>
                <div class="container card border-0 shadow-none">
                    <div class="minhthiem-desc">
                        {!! $widgets['spa-brand-highlight']['description'] !!}
                    </div>
                </div>
                <div class="row mx-0 hrz-scroll text-center flex-nowrap js-slider justify-content-around">
                    @foreach ($widgets['spa-brand-highlight']['object'] as $brand)
                        <div class="item">
                            <a href="{{ writeUrl($brand->canonical, true, true) }}" class="brand-item pos-relative d-flex align-items-center aspect-ratio" title="{{ $brand->name }}" style="--width: 176; --height: 99;">
                                <img loading="lazy" class="img-fluid m-auto object-contain mh-100 w-auto" src="{{ $brand->image }}" alt="{{ $brand->name }}" width="176" height="99" />
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </section>

    {{-- Sản phẩm nhiều lượt xem --}}
    <section class="section">
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
                            <a class="banner" href="#" title=" {{ $widgets['product-most-viewed']['name'] }}">
                                <img loading="lazy" class="img-fluid" src="{{ writeUrl($widgets['product-most-viewed']['album']['0']) }}" width="330" height="463" alt=" {{ $widgets['product-most-viewed']['name'] }}" />
                            </a>
                        </div>
                        <div class="tag-list pb-3" style="--tag-bg: #efe7d5; --tag-color: #2f4858;">
                            @if ($widgets['tag-list-product'])
                                @foreach ($widgets['tag-list-product']['object']->take(8) as $object)
                                    <a class="tag-item" href="{{ writeUrl($object->canonical, true, true) }}" title="{{ $object->name }}">{{ $object->name }}</a>
                                @endforeach
                            @endif
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
                            <a href="{{ writeUrl('my-pham', true, true) }}" title="Xem tất cả" class="btn btn-main btn-icon">
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
    <section class="section">
        <div class="section_banner_adv">
            <div class="container">
                <div class="text-center row">
                    <a class="col-12 banner" href="#" title="Hot product">
                        <picture>
                            <img class="img-fluid" loading="lazy" src="{{ writeUrl($widgets['spa-cosmetics']['album']['0']) }}" alt="Hot product" width="1410" height="176" />
                        </picture>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <section class="section_product_top section">
            <div class="container card border-0 shadow-none">
                <div class="text-center my-4">
                    <h3 class="fw-bold section-home-header">
                        {{ $widgets['spa-cosmetics']['name'] }}
                    </h3>
                </div>
                <div class="e-tabs">
                    <div id="tab-1" class="tab-content content_extab current">
                        <div class="row mt-3" style="--limit-column: 5;" data-section="tab-section">
                            @foreach ($widgets['spa-cosmetics']['object']->take(5) as $object)
                            <div class="col-12 col-xl-15 product-col">
                                <div class="item_product_main item_skeleton"></div>
                            </div>
                            @endforeach

                            <script type="text/x-custom-template" data-template="tab-section">
                                @foreach ($widgets['spa-cosmetics']['object']->take(5) as $object)
                                  <div class="col-12 col-xl-15 product-col">
                                    @include('frontend.component.productItem', ['product' => $object])
                                  </div>
                                @endforeach
                            </script>
                        </div>
                        <div class="text-center mt-3 col-12">
                            <a href="{{ writeUrl('my-pham', true, true) }}" title="Xem tất cả" class="btn btn-main btn-icon">
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

    <section class="section">
        <section class="section_product_new section">
            <div class="container card border-0 shadow-none">
                <div class="text-center my-4">
                    <h3 class="fw-bold section-home-header">
                        {{ $widgets['spa-cleansing']['name'] }}
                    </h3>
                </div>
                <div class="row mt-3" data-section="hot-section">
                    <div class="col-12 col-xl-30 text-center pb-3 product-col">
                        <a class="banner" href="#" title="{{ $widgets['spa-cleansing']['name'] }}">
                            <picture>
                                <img
                                    class="img-fluid"
                                    loading="lazy"
                                    src="{{ writeUrl($widgets['spa-cleansing']['album']['0']) }}"
                                    width="546"
                                    height="353"
                                    alt="{{ $widgets['spa-cleansing']['name'] }}"
                                />
                            </picture>
                        </a>
                    </div>

                    @foreach ($widgets['spa-cleansing']['object']->take(8) as $object)
                        <div class="col-6 col-md-4 col-lg-3 col-xl-15 product-col">
                            <div class="item_product_main item_skeleton"></div>
                        </div>
                    @endforeach
                    <script type="text/x-custom-template" data-template="hot-section">
                        @foreach ($widgets['spa-cleansing']['object']->take(8) as $object)
                          <div class="col-6 col-md-4 col-lg-3 col-xl-15 product-col">
                            @include('frontend.component.productItem', ['product' => $object])
                          </div>
                        @endforeach
                    </script>
                </div>
                <div class="text-center mt-3 col-12">
                    <a href="{{ writeUrl('my-pham', true, true) }}" title="Xem tất cả" class="btn btn-main">
                        Xem tất cả
                        <svg class="icon">
                            <use xlink:href="#icon-arrow" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    </section>

    <!-- Blog Section -->
    <section class="section pt-1 pb-2">
        <div class="container">
            <div class="text-center my-4">
                <h3 class="fw-bold section-home-header">
                    {{ $widgets['post-hl']['name'] }}
                </h3>
            </div>

            <div class="row">
                @foreach ($widgets['post-hl']['object']->take(4) as $post)
                <div class="col-md-6 col-lg-3 mb-4">
                    <article class="blog-card">
                        <a href="{{ writeUrl($post->canonical, true, true) }}" class="blog-image">
                            <img src="{{ $post->image }}" 
                                    alt="{{ Str::limit($post->name, 60) }}" 
                                    class="img-fluid" 
                                    loading="lazy">
                        </a>
                        <div class="blog-content">
                            <h3 class="blog-title">
                                <a href="{{ writeUrl($post->canonical, true, true) }}">{{ Str::limit($post->name, 60) }}</a>
                            </h3>
                            <div class="blog-meta">
                                <span class="author">Minh Thiêm</span>
                                <span class="date">{{ $post->created_at->format('d/m/Y') }}</span>
                            </div>
                            <p class="blog-excerpt">{{ Str::limit($post->meta_description ?? '', 100) }}...</p>
                            <a href="{{ writeUrl($post->canonical, true, true) }}" class="read-more">Đọc tiếp</a>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-3 col-12">
                <a href="{{ writeUrl('tin-tuc', true, true) }}" title="Xem tất cả" class="btn btn-main btn-icon">
                    Xem tất cả
                    <svg class="icon">
                        <use xlink:href="#icon-arrow" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    @include("frontend.component.productDetailsModal")
</body>