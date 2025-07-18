<footer class="footer" style="background-color: #f8f9fa;">
    <div class="container py-5">
        <div class="row g-4">
            <!-- About Us Column -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-about mb-4">
                    <a href="/" class="d-block mb-3">
                        <img loading="lazy" 
                             src="{{ writeUrl($systems['homepage_logo'], true) }}"
                             alt="Mỹ Phẩm Minh Thiêm" 
                             width="180" 
                             class="img-fluid">
                    </a>
                    <p class="text-muted mb-4">{{ $systems['homepage_slogan'] }}</p>
                    
                    <div class="contact-info">
                        <div class="contact-item d-flex mb-3">
                            <i class="fas fa-map-marker-alt text-primary mt-1 me-3"></i>
                            <div>
                                <h6 class="mb-1">Địa chỉ</h6>
                                <p class="text-muted mb-0">{{ $systems['contact_address'] }}</p>
                            </div>
                        </div>
                        
                        <div class="contact-item d-flex mb-3">
                            <i class="fas fa-phone-alt text-primary mt-1 me-3"></i>
                            <div>
                                <h6 class="mb-1">Điện thoại</h6>
                                <a href="tel:{{ $systems['contact_hotline'] }}" class="text-muted">{{ $systems['contact_hotline'] }}</a>
                            </div>
                        </div>
                        
                        <div class="contact-item d-flex mb-3">
                            <i class="fas fa-envelope text-primary mt-1 me-3"></i>
                            <div>
                                <h6 class="mb-1">Email</h6>
                                <a href="mailto:{{ $systems['contact_email'] }}" class="text-muted">{{ $systems['contact_email'] }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="social-links mt-4">
                        <h6 class="mb-3">Kết nối với chúng tôi</h6>
                        <div class="d-flex gap-3">
                            <a href="{{ writeUrl($systems['socical_facebook'], true) }}" target="_blank" class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="{{ writeUrl($systems['socical_twitter'], true) }}" target="_blank" class="social-icon">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="{{ writeUrl($systems['socical_instagram'], true) }}" target="_blank" class="social-icon">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="{{ writeUrl($systems['socical_youtube'], true) }}" target="_blank" class="social-icon">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Menus -->
            @foreach ($menus['menu-footer'] as $menuBlock)
            <div class="col-lg-2 col-md-6">
                <div class="footer-menu mb-4">
                    <h5 class="mb-3">{{ $menuBlock['item']->name }}</h5>
                    <ul class="list-unstyled">
                        @foreach ($menuBlock['children'] as $child)
                        <li class="mb-2">
                            <a href="{{ url($child['item']->canonical) }}" class="text-muted text-decoration-none hover-primary">
                                {{ $child['item']->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach

            <!-- Newsletter & Payment -->
            <div class="col-lg-4 col-md-6">
                <div class="newsletter mb-4">
                    <h5 class="mb-3">Đăng ký nhận tin</h5>
                    <p class="text-muted mb-3">Nhận thông tin khuyến mãi và sản phẩm mới</p>
                    
                    <form class="mb-4">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Email của bạn" required>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-paper-plane me-1"></i> Đăng ký
                            </button>
                        </div>
                    </form>
                    
                    <div class="payment-methods mb-4">
                        <h5 class="mb-3">Chấp nhận thanh toán</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <img src="{{ writeUrl('frontend/img/icon/footer_trustbadge.png', true) }}" 
                                 alt="Payment methods" 
                                 class="img-fluid rounded" 
                                 loading="lazy">
                        </div>
                    </div>
                    
                    <div class="certification">
                        <img src="{{ writeUrl('frontend/img/icon/logo_bct.webp', true) }}" 
                             alt="Bộ Công Thương" 
                             class="img-fluid" 
                             loading="lazy"
                             width="180">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="bg-dark py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 text-white">
                        © {{ date('Y') }} <a href="/" class="text-white text-decoration-none">{{ $systems['homepage_company'] }}</a>. 
                        All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0 text-white-50">
                        Powered by <a href="https://www.sapo.vn" target="_blank" class="text-white text-decoration-none">Sapo</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<svg style="display: none;">
    <defs>
        <symbol class="icon" id="icon-cart" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M15.594 16.39a.703.703 0 0 1-.703.704h-.704v.703a.703.703 0 0 1-1.406 0v-.703h-.703a.703.703 0 0 1 0-1.407h.703v-.703a.703.703 0 1 1 1.406 0v.704h.704c.388 0 .703.314.703.703Zm0-10.968v6.75a.703.703 0 0 1-1.406 0V6.125H12.78v2.11a.703.703 0 1 1-1.406 0v-2.11h-6.75v2.11a.703.703 0 1 1-1.406 0v-2.11H1.813v10.969h7.453a.703.703 0 1 1 0 1.406H1.109a.703.703 0 0 1-.703-.703V5.422c0-.388.315-.703.703-.703h2.143A4.788 4.788 0 0 1 8 .5a4.788 4.788 0 0 1 4.748 4.219h2.143c.388 0 .703.315.703.703Zm-4.266-.703A3.38 3.38 0 0 0 8 1.906 3.38 3.38 0 0 0 4.672 4.72h6.656Z"
                fill="currentColor"
            />
        </symbol>
    </defs>
</svg>

<svg style="display: none;">
    <defs>
        <symbol id="icon-minus" class="icon icon-minus" viewBox="0 0 16 2" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15.375 0H0.625C0.279813 0 0 0.279813 0 0.625C0 0.970187 0.279813 1.25 0.625 1.25H15.375C15.7202 1.25 16 0.970187 16 0.625C16 0.279813 15.7202 0 15.375 0Z" fill="#8C9196" />
        </symbol>
    </defs>
</svg>

<svg style="display: none;">
    <defs>
        <symbol id="icon-plus" class="icon icon-plus" viewBox="0 0 93.562 93.562" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                xmlns="http://www.w3.org/2000/svg"
                d="M87.952,41.17l-36.386,0.11V5.61c0-3.108-2.502-5.61-5.61-5.61c-3.107,0-5.61,2.502-5.61,5.61l0.11,35.561H5.61   c-3.108,0-5.61,2.502-5.61,5.61c0,3.107,2.502,5.609,5.61,5.609h34.791v35.562c0,3.106,2.502,5.61,5.61,5.61   c3.108,0,5.61-2.504,5.61-5.61V52.391h36.331c3.108,0,5.61-2.504,5.61-5.61C93.562,43.672,91.032,41.17,87.952,41.17z"
                fill="currentColor"
            />
        </symbol>
    </defs>
</svg>

<svg style="display: none;">
    <defs>
        <symbol class="icon icon-arrow" id="icon-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490.8 490.8" fill="none" aria-hidden="true" focusable="false" role="presentation">
            <path
                d="M135.685 3.128c-4.237-4.093-10.99-3.975-15.083.262-3.992 4.134-3.992 10.687 0 14.82l227.115 227.136-227.136 227.115c-4.237 4.093-4.354 10.845-.262 15.083 4.093 4.237 10.845 4.354 15.083.262.089-.086.176-.173.262-.262l234.667-234.667c4.164-4.165 4.164-10.917 0-15.083L135.685 3.128z"
                fill="currentColor"
            />
            <path
                d="M128.133 490.68a10.667 10.667 0 01-7.552-18.219l227.136-227.115L120.581 18.232c-4.171-4.171-4.171-10.933 0-15.104 4.171-4.171 10.933-4.171 15.104 0l234.667 234.667c4.164 4.165 4.164 10.917 0 15.083L135.685 487.544a10.663 10.663 0 01-7.552 3.136z"
            />
        </symbol>
    </defs>
</svg>

<svg style="display: none;">
    <defs>
        <symbol id="icon-search" class="icon icon-search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904">
            <path
                d="M190.707 180.101l-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 005.303 2.197 7.498 7.498 0 005.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z"
            />
        </symbol>
    </defs>
</svg>

<script type="text/x-custom-template" data-template="menuMobile">
    <div id="mobile-menu" class="scroll">
        @php
            $fullName = $customer->name ?? '';
            $firstName = collect(explode(' ', trim($fullName)))->last();
        @endphp
        @if (isset($customer))
        <div class="media d-flex user-menu">
            <img loading="lazy" src="{{ $customer->image ? writeUrl($customer->image, true) : asset('frontend/img/icon/icon-user.svg') }}" width="40" height="40" alt="account_icon" class="mr-3 align-self-center rounded-pill" />
            <div class="media-body d-md-flex flex-column">
                <a href="{{ route('customer.profile') }}" title="Thông tin tài khoản" class="d-block" title="{{ $customer->name }}">
                    Xin chào, {{ $firstName }}
                </a>
                <small>
                    <a href="{{ route('customer.logout') }}" class="font-weight: light">
                        Đăng xuất
                    </a>
                </small>
            </div>
        </div>
        @else
        <div class="media d-flex user-menu">
            <i class="fas fa-user-circle mr-3 align-self-center"></i>
            <div class="media-body d-md-flex flex-column">
                <a rel="nofollow" href="{{ writeUrl('dang-nhap', true, true) }}" class="d-block" title="Tài khoản của bạn">Tài khoản của bạn</a>
                <small>
                    <a href="{{ writeUrl('dang-nhap', true, true) }}" title="Đăng nhập / Đăng kí" class="font-weight: light">Đăng nhập / Đăng kí</a>
                </small>
            </div>
        </div>
        @endif

        <div class="mobile-menu-body scroll">
            <nav class="h-100">
                <ul class="navigation list-group list-group-flush scroll">
                    @foreach ($menus['product-category'] as $menuItem) @php $hasChildren = !empty($menuItem['children']); @endphp
                    <li class="menu-item list-group-item">
                        <a href="{{ writeUrl($menuItem['item']->canonical, true, true) ?: '#' }}" class="menu-item__link" title="{{ $menuItem['item']->name }}">
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
                            <div class="toggle-submenu d-lg-none d-xl-none">
                                <i class="mr-3">
                                    <svg class="icon" style="transform: rotate(180deg);">
                                        <use xlink:href="#icon-arrow" />
                                    </svg>
                                </i>
                                <span>{{ $menuItem['item']->name }}</span>
                            </div>
                            <ul class="submenu__list">
                                @php $childrenChunks = array_chunk($menuItem['children'], 4); @endphp @foreach($childrenChunks as $chunk) @foreach($chunk as $child)
                                <li class="submenu__item submenu__item--main">
                                    <a class="link" href="{{ writeUrl($child['item']->canonical, true, true) }}" title="{{ $child['item']->name }}">{{ $child['item']->name }}</a>
                                </li>
                                @endforeach @endforeach
                            </ul>
                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </nav>
            @if (isset($menus['menu-header']))
            <ul class="shop-policises list-unstyled d-flex align-items-center flex-wrap m-0 pr-0">
                @foreach ($menus['menu-header'] as $menuItem)
                <li class="">
                    <a class="link" href="{{ writeUrl($menuItem['item']->canonical, true, true) ?: '#' }}" title="{{ $menuItem['item']->name }}">{{ $menuItem['item']->name }}</a>
                </li>
                @endforeach
            </ul>
            @endif
        </div>

        <div class="mobile-menu-footer border-top w-100 d-flex align-items-center text-center">
            <div class="hotline w-50 p-2">
                <a href="tel:0982723468" title="0982723468">
                    Gọi điện
                    <i class="fas fa-phone ml-3"></i>
                </a>
            </div>
            <div class="messenger border-left p-2 w-50 border-left">
                <a href="https://www.facebook.com/myphamthucuc.beauty" title="https://www.facebook.com/myphamthucuc.beauty">
                    Nhắn tin
                    <i class="fab fa-facebook-messenger ml-3"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="menu-overlay"></div>
</script>