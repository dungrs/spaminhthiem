<div class="opacity_menu"></div>
<script>
    $(document).ready(() => {
        $(".top-banner .close").click(() => {
            $(".top-banner").slideToggle();
            sessionStorage.setItem("top-banner", true);
        });
    });
</script>

<header class="header header_menu">
    <div class="mid-header wid_100 d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-3 header-right d-lg-none d-block">
                    <div class="toggle-nav btn menu-bar mr-4 ml-0 p-0 d-lg-none d-flex text-white">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </div>
                </div>
                <div class="col-6 col-xl-3 col-lg-3 header-left">
                    <a href="/" class="logo-wrapper">
                        <img class="img-fluid" src="//bizweb.dktcdn.net/100/494/811/themes/921992/assets/logo.png?1717567288856" alt="logo Mỹ Phẩm Thu Cúc" width="248" height="53" />
                    </a>
                </div>
                <div class="col-xl-4 col-lg-4 col-12 header-center" id="search-header">
                    <form action="/search" method="get" class="input-group search-bar custom-input-group" role="search">
                        <input type="text" name="query" value="" autocomplete="off" class="input-group-field auto-search form-control" required="" data-placeholder="Tìm theo tên sản phẩm...; Tìm theo thương hiệu...;" />
                        <input type="hidden" name="type" value="product" />
                        <span class="input-group-btn btn-action">
                            <button type="submit" aria-label="search" class="btn text-white icon-fallback-text h-100">
                                <svg class="icon">
                                    <use xlink:href="#icon-search" />
                                </svg>
                            </button>
                        </span>
                    </form>
                    <div class="search-overlay"></div>
                </div>
                <div class="col-3 col-xl-5 col-lg-5">
                    <ul class="header-right mb-0 float-right list-unstyled d-flex align-items-center">
                        <!-- Hotline -->
                        <li class="media d-lg-flex d-none hotline">
                            <img loading="lazy" src="{{ asset('frontend/img/icon/phone_icon.webp') }}" width="32" height="32" class="mr-3 align-self-center" alt="phone_icon" />
                            <div class="media-body d-md-flex flex-column d-none">
                                <span>Hỗ trợ khách hàng</span>
                                <a class="font-weight-bold d-block" href="tel:0982723468" title="Gọi 0982723468">
                                    0982 723 468
                                </a>
                            </div>
                        </li>

                        <!-- Tài khoản -->
                        <li class="ml-4 mr-4 mr-md-3 ml-md-3 media d-lg-flex d-none">
                            @if (isset($customer))
                                <img loading="lazy" src="{{ $customer->image ? writeUrl($customer->image, true) : asset('frontend/img/icon/icon-user.svg') }}" width="40" height="40" alt="account_icon" class="mr-3 align-self-center rounded-pill" />
                                <div class="media-body d-md-flex flex-column d-none">
                                    @php
                                        $fullName = $customer->name ?? '';
                                        $firstName = collect(explode(' ', trim($fullName)))->last();
                                    @endphp
                                    <a href="{{ route('customer.profile') }}" title="Thông tin tài khoản" class="d-block" title="{{ $customer->name }}">
                                        Xin chào, {{ $firstName }}
                                    </a>
                                    <small>
                                        <a href="{{ route('customer.logout') }}" class="font-weight: light">
                                            Đăng xuất
                                        </a>
                                    </small>
                                </div>
                            @else
                                <img loading="lazy" src="{{ asset('frontend/img/icon/account_icon.webp') }}" width="32" height="32" alt="account_icon" class="mr-3 align-self-center" />
                                <div class="media-body d-md-flex flex-column d-none">
                                    <a rel="nofollow" href="{{ writeUrl('dang-nhap', true, true) }}" class="d-block" title="Đăng nhập">
                                        Tài khoản của bạn
                                    </a>
                                    <small>
                                        <a href="{{ writeUrl('dang-nhap', true, true) }}" title="Đăng nhập" class="font-weight: light">
                                            Đăng nhập / Đăng ký
                                        </a>
                                    </small>
                                </div>
                            @endif
                        </li>

                        <!-- Giỏ hàng -->
                        <li class="cartgroup ml-0 mr-2 mr-md-0">
                            <div class="mini-cart text-xs-center">
                                <a class="img_hover_cart" href="{{ route('cart') }}" title="Xem giỏ hàng">
                                    <img loading="lazy" src="{{ asset('frontend/img/icon/cart_icon.png') }}" width="24" height="24" alt="cart_icon" />
                                    <span class="mx-2 d-xl-block d-none">Giỏ hàng</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- subheader == mobile nav -->
<div class="subheader">
    <div class="container">
        <div class="toogle-nav-wrapper">
            <div class="icon-bar btn menu-bar mr-2 p-0 d-inline-flex">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            Danh mục sản phẩm
            <div class="navigation-wrapper">
                <nav class="h-100">
                    <ul class="navigation list-group list-group-flush scroll">
                        @foreach ($menus['product-category'] as $menuItem)
                            @php
                                $hasChildren = !empty($menuItem['children']);
                            @endphp
                            <li class="menu-item list-group-item">
                                <a 
                                    href="{{ writeUrl($menuItem['item']->canonical, true, true) ?: '#' }}" 
                                    class="menu-item__link" 
                                    title="{{ $menuItem['item']->name }}">
                                    <span>{{ $menuItem['item']->name }}</span>
                                    
                                    @if ($hasChildren)
                                        <i class="float-right" data-toggle-submenu>
                                            <svg class="icon">
                                                <use xlink:href="#icon-arrow" />
                                            </svg>
                                        </i>
                                    @endif
                                </a>

                                @if ($hasChildren)
                                <div class="submenu scroll">
                                    <ul class="submenu__list">
                                    @php
                                        $childrenChunks = array_chunk($menuItem['children'], 4);
                                    @endphp

                                    @foreach($childrenChunks as $chunk)
                                        @foreach($chunk as $child)
                                            <li class="submenu__item submenu__item--main">
                                                <a class="link" href="{{ writeUrl($child['item']->canonical, true, true) }}" title="{{ $child['item']->name }}">{{ $child['item']->name }}</a>
                                            </li>
                                        @endforeach
                                    @endforeach
                                    </ul>
                                </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
        @if (isset($menus['menu-header']))
            <ul class="shop-policises list-unstyled d-flex align-items-center flex-wrap m-0 pr-0">
                @foreach ($menus['menu-header'] as $menuItem)
                    <li class="ms-4">
                        <a class="link" href="{{ writeUrl($menuItem['item']->canonical, true, true) ?: '#' }}" title="{{ $menuItem['item']->name }}">{{ $menuItem['item']->name }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
<script type="text/x-custom-template" data-template="stickyHeader">
    <header class="header header_sticky">
        <div class="mid-header wid_100 d-flex align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Mobile Menu Toggle -->
                    <div class="col-2 col-md-3 header-left d-lg-none d-block py-1">
                        <div class="toggle-nav btn menu-bar mr-4 ml-0 p-0 d-lg-none d-flex text-white">
                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>
                        </div>
                    </div>

                    <!-- Desktop Categories -->
                    <div class="col-4 col-xl-3 col-lg-3 header-left d-none d-lg-flex align-items-center h-100">
                        <div class="toogle-nav-wrapper w-100">
                            <div class="d-flex align-items-center" style="height: 52px; font-size: 1rem; font-weight: 500">
                                <div class="icon-bar btn menu-bar mr-3 ml-0 p-0 d-inline-flex">
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                </div>
                                Danh mục sản phẩm
                            </div>

                            <div class="navigation-wrapper">
                                <nav class="h-100">
                                    <ul class="navigation list-group list-group-flush scroll">
                                        @foreach ($menus['product-category'] as $menuItem)
                                            @php
                                                $hasChildren = !empty($menuItem['children']);
                                            @endphp

                                            <li class="menu-item list-group-item">
                                                <a 
                                                    href="{{ writeUrl($menuItem['item']->canonical, true, true) ?: '#' }}" 
                                                    class="menu-item__link" 
                                                    title="{{ $menuItem['item']->name }}">
                                                    <span>{{ $menuItem['item']->name }}</span>
                                                    
                                                    @if ($hasChildren)
                                                        <i class="float-right" data-toggle-submenu>
                                                            <svg class="icon">
                                                                <use xlink:href="#icon-arrow" />
                                                            </svg>
                                                        </i>
                                                    @endif
                                                </a>

                                                @if ($hasChildren)
                                                <div class="submenu scroll">
                                                    <ul class="submenu__list">
                                                    @php
                                                        $childrenChunks = array_chunk($menuItem['children'], 4);
                                                    @endphp

                                                    @foreach($childrenChunks as $chunk)
                                                        @foreach($chunk as $child)
                                                            <li class="submenu__item submenu__item--main">
                                                                <a class="link" href="{{ writeUrl($child['item']->canonical, true, true) }}" title="{{ $child['item']->name }}">{{ $child['item']->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    @endforeach
                                                    </ul>
                                                </div>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="sticky-overlay"></div>
                    </div>

                    <!-- Search Bar -->
                    <div class="col-8 col-md-6 col-lg-4 col-xl-4 header-center py-1" id="search-header">
                        <form action="/search" method="get" class="input-group search-bar custom-input-group" role="search">
                            <input type="text" name="query" value="" autocomplete="off"
                                class="input-group-field auto-search form-control" required=""
                                data-placeholder="Tìm theo tên sản phẩm...; Tìm theo thương hiệu...;">
                            <input type="hidden" name="type" value="product">
                            <span class="input-group-btn btn-action">
                                <button type="submit" aria-label="search" class="btn text-white icon-fallback-text h-100">
                                    <svg class="icon"><use xlink:href="#icon-search" /></svg>
                                </button>
                            </span>
                        </form>
                        <div class="search-overlay"></div>
                    </div>

                    <!-- Right Side Icons -->
                    <div class="col-2 col-md-3 col-xl-5 col-lg-5 py-1">
                        <ul class="header-right mb-0 float-right list-unstyled d-flex align-items-center">
                            <li class='media d-lg-flex d-none hotline'>
                                <img loading="lazy"
                                    src="{{ asset('frontend/img/icon/phone_icon.webp') }}"
                                    width="32" height="32" class="mr-3 align-self-center"
                                    alt="phone_icon"/>
                                <div class="media-body d-md-flex flex-column d-none">
                                    <span>Hỗ trợ khách hàng</span>
                                    <a class="font-weight-bold d-block" href="tel:0982723468" title="0982723468">
                                        0982723468
                                    </a>
                                </div>
                            </li>

                            <li class="ml-4 mr-4 mr-md-3 ml-md-3 media d-lg-flex d-none">
                                @if (isset($customer))
                                    <img loading="lazy" src="{{ $customer->image ? writeUrl($customer->image, true) : asset('frontend/img/icon/icon-user.svg') }}" width="40" height="40" alt="account_icon" class="mr-3 align-self-center rounded-pill" />
                                    <div class="media-body d-md-flex flex-column d-none">
                                        <a href="{{ route('customer.profile') }}" title="Thông tin tài khoản" class="d-block" title="{{ $customer->name }}">
                                            Xin chào, {{ $firstName }}
                                        </a>
                                        <small>
                                            <a href="{{ route('customer.logout') }}" class="font-weight: light">
                                                Đăng xuất
                                            </a>
                                        </small>
                                    </div>
                                @else
                                    <img loading="lazy" src="{{ asset('frontend/img/icon/account_icon.webp') }}" width="32" height="32" alt="account_icon" class="mr-3 align-self-center" />
                                    <div class="media-body d-md-flex flex-column d-none">
                                        <a rel="nofollow" href="{{ writeUrl('dang-nhap', true, true) }}" class="d-block" title="Đăng nhập">
                                            Tài khoản của bạn
                                        </a>
                                        <small>
                                            <a href="{{ writeUrl('dang-nhap', true, true) }}" title="Đăng nhập / Đăng kí" class="font-weight: light">
                                                Đăng nhập / Đăng kí
                                            </a>
                                        </small>
                                    </div>
                                @endif
                            </li>
                            
                            <li class="cartgroup ml-0 mr-2 mr-md-0">
                                <div class="mini-cart text-xs-center">
                                    <a class="img_hover_cart" href="/cart" title="Giỏ hàng">
                                        <img loading="lazy"
                                            src="{{ asset('frontend/img/icon/cart_icon.png') }}"
                                            width="24" height="24"
                                            alt="cart_icon"/>
                                        <span class='mx-2 d-xl-block d-none'>Giỏ hàng</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
</script>
<script type="text/x-custom-template" data-template="navigation">
    <nav class="h-100">
        <ul class="navigation list-group list-group-flush scroll">
            @foreach ($menus['product-category'] as $menuItem)
                @php
                    $hasChildren = !empty($menuItem['children']);
                @endphp
                <li class="menu-item list-group-item">
                    <a 
                        href="{{ writeUrl($menuItem['item']->canonical, true, true) ?: '#' }}" 
                        class="menu-item__link" 
                        title="{{ $menuItem['item']->name }}">
                        <span>{{ $menuItem['item']->name }}</span>
                        
                        @if ($hasChildren)
                            <i class="float-right" data-toggle-submenu>
                                <svg class="icon">
                                    <use xlink:href="#icon-arrow" />
                                </svg>
                            </i>
                        @endif
                    </a>

                    @if ($hasChildren)
                    <div class="submenu scroll">
                        <ul class="submenu__list">
                        @php
                            $childrenChunks = array_chunk($menuItem['children'], 4);
                        @endphp

                        @foreach($childrenChunks as $chunk)
                            @foreach($chunk as $child)
                                <li class="submenu__item submenu__item--main">
                                    <a class="link" href="{{ writeUrl($child['item']->canonical, true, true) }}" title="{{ $child['item']->name }}">{{ $child['item']->name }}</a>
                                </li>
                            @endforeach
                        @endforeach
                        </ul>
                    </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
</script>