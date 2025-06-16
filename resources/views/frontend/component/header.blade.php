<section class="header shadow-lg header-pc">
    <div class="top_bar">
        <div class="container-fluid py-2">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-6">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <a href="mailto:{{ $systems['contact_email'] ?? '#' }}" class="text-decoration-none text-white hover-primary">
                                <i class="fas fa-envelope me-2"></i>
                                <span>{{ $systems['contact_email'] ?? 'contact@example.com' }}</span>
                            </a>
                        </div>
                    </div>
        
                    <div class="col-lg-4 col-md-6 d-none d-lg-block text-center">
                        <p class="text-white mb-0 fst-italic slogan-text">
                            {{ $systems['homepage_slogan'] ?? 'Your inspiring slogan here' }}
                        </p>
                    </div>
        
                    <div class="col-lg-4 col-md-12">
                        <div class="d-flex align-items-center justify-content-center justify-content-lg-end gap-4 social-icons">
                            <a href="{{ $systems['socical_facebook'] }}" class="text-white hover-primary"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ $systems['socical_youtube'] }}" class="text-white hover-primary"><i class="fab fa-youtube"></i></a>
                            <a href="{{ $systems['socical_instagram'] }}" class="text-white hover-primary"><i class="fab fa-instagram"></i></a>
                            <a href="{{ $systems['socical_twitter'] }}" class="text-white hover-primary"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="header-sticky" class="w-100" sticky-scroll>
        <div class="header_middle py-3 bg-menu-custom">
            <div class="container">
                <div class="row align-items-center">
                    <a href="{{ url('/') }}" class="col-3">
                        <img src="{{ $systems['homepage_logo'] ?? '' }}" class="img-fluid" />
                    </a>

                    <div class="col-6 position-relative">
                        <form class="form-search d-flex">
                            <input type="text" 
                                class="form-control search-box rounded-start-pill" 
                                placeholder="Tìm kiếm sản phẩm..." 
                                style="border-right: none;">
                            <button type="submit" class="btn btn-danger rounded-end-pill px-4">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    
                        <!-- Kết quả tìm kiếm -->
                        <div class="search-result position-absolute top-100 mt-2 rounded border shadow bg-white overflow-hidden" style="z-index: 9999; width: 97% !important; display: none;">
                            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                                <table class="table align-middle table-hover mb-0">
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="group-icon col-3 d-flex align-items-center justify-content-end gap-4">
                        <div class="position-relative">
                            <a href="{{ route('cart') }}">
                                <img src="{{ asset('frontend/img/icon/icon-cart.svg') }}" class="img-fluid icon-size-custom" />
                            </a>
                        </div>
                        
                        <div class="icon-tracking">
                            <a href="{{ route('lookup') }}">
                                <img src="{{ asset('frontend/img/icon/icon-tracking.svg') }}" class="img-fluid icon-size-custom" />
                            </a>
                        </div>
                        
                        @if(isset($customer))
                            {{-- Đã đăng nhập --}}
                            <div class="dropdown">
                                <div class="cursor-pointer dropdown-toggle d-flex align-items-center gap-1" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img class="rounded-circle header-profile-user" src="{{ $customer->image ? writeUrl($customer->image, true) : asset('frontend/img/icon/icon-user.svg') }}" alt="Header Avatar">
                                    <span>{{ $customer->name }} <i class="mdi mdi-chevron-down"></i></span>
                                </div>
                        
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('customer.profile') }}" class="dropdown-item">Thông Tin Cá Nhân</a></li>
                                    <li><a href="#" class="dropdown-item">Đơn Hàng Của Tôi</a></li>
                                    <li><a href="#" class="dropdown-item">Sản Phẩm Yêu Thích</a></li>
                                    <li><a href="{{ route('customer.logout') }}" class="dropdown-item">Đăng Xuất</a></li>
                                </ul>
                            </div>
                        @else
                            {{-- Chưa đăng nhập --}}
                            <div class="dropdown">
                                <div class="cursor-pointer dropdown-toggle d-flex align-items-center gap-1" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('frontend/img/icon/icon-user.svg') }}" class="img-fluid icon-size-custom" />
                                    <span>Tài Khoản</span>
                                </div>
                        
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('customer.showRegister') }}">Đăng Ký</a></li>
                                    <li><a class="dropdown-item" href="{{ route('customer.showLogin') }}">Đăng Nhập</a></li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="menu fs-6">
            @include('frontend.component.navigation')
        </div>
    </div>
</section>