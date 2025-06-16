<footer class="footer w-100 mt-5 pt-3">
    <div class="container">
        <div class="row border-bottom border-dark-subtle py-3 row-gap-5">
            @foreach ($menus['menu-footer'] as $footerBlock)
                <div class="col-xl-3 col-md-6 col-sm-6 d-flex flex-column align-items-start justify-content-start gap-2">
                    <h6 class="text-left fw-bold">
                        <a href="{{ url($footerBlock['item']->canonical) }}" class="text-dark text-decoration-none text-uppercase">
                            {{ $footerBlock['item']->name }}
                        </a>
                    </h6>

                    @foreach ($footerBlock['children'] as $child)
                        <span class="d-block fw-light mb-1">
                            <a href="{{ url($child['item']->canonical) }}" class="text-dark text-decoration-none">
                                {{ $child['item']->name }}
                            </a>
                        </span>
                    @endforeach
                </div>
            @endforeach

            <div class="col-xl-3 col-md-6 col-sm-6 d-flex flex-column align-items-start justify-content-start gap-2">
                <h6 class="text-left fw-bold">LIÊN HỆ</h6>

                <div class="group-ft">
                    <div class="group-top">
                        <span class="d-block fw-bold mb-1">Hỗ Trợ Tư Vấn Mua Online</span>
                        <span class="d-block fw-light mb-1">Hotline: {{ $systems['contact_hotline'] }}</span>
                        <span class="d-block fw-light mb-1">Email: {{ $systems['contact_email'] }}</span>
                        <span class="d-block fw-light mb-1">Giờ làm việc: 8:30 - 22:00 hằng ngày.</span>
                    </div>

                    <div class="group-top mt-3">
                        <span class="d-block fw-bold mb-1">Hỗ Trợ Tư Vấn Bảo Hành Sản Phẩm</span>
                        <span class="d-block fw-light mb-1">Hotline: {{ $systems['contact_technical_phone'] }}</span>
                        <span class="d-block fw-light mb-1">Email: cskh@tokyolife.vn</span>
                        <span class="d-block fw-light mb-1">Giờ làm việc: 8:30 - 22:00 hằng ngày.</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3 py-3 border-bottom border-dark-subtle align-items-center">
            <div class="ft-left col-12 col-md-6">
                <h6 class="text-left fw-bold mb-3">KẾT NỐI VỚI TOKYOLIFE</h6>

                <div class="icon-socia d-flex align-items-center justify-content-start gap-4">
                    <img src="{{ asset('frontend/img/icon/icon-fb2.svg') }}" class="img-fluid icon-footer-custom">
                    <img src="{{ asset('frontend/img/icon/icon-toptop.svg') }}" class="img-fluid icon-footer-custom">
                    <img src="{{ asset('frontend/img/icon/icon-zalo.svg') }}" class="img-fluid icon-footer-custom">
                    <img src="{{ asset('frontend/img/icon/icon-ytb.svg') }}" class="img-fluid icon-footer-custom">
                </div>
            </div>

            <div
                class="ft-right col-12 col-md-6 d-flex align-items-end justify-content-md-end justify-content-start gap-3">
                <div class="right-1">
                    <img src="{{ asset('frontend/img/icon/qrcode2.svg') }}" alt="">
                </div>

                <div class="right-2 d-flex flex-column gap-1 mt-4 m-md0">
                    <img src="{{ asset('frontend/img/icon/app_store.svg') }}" alt="">
                    <img src="{{ asset('frontend/img/icon/google_play.svg') }}" alt="">
                </div>
            </div>
        </div>

        <div class="row mt-3 justify-content-between flex-column flex-md-row">
            <div class="col-8 ft-left d-flex flex-column  gap-2">
                <p class="mb-0 fs-6 fw-light"> Địa chỉ: {{ $systems['contact_office'] }}</p>
                <p class="mb-0 fs-6 fw-light">Người đại diện: Phạm Vân Anh</p>
                <p class="mb-0 fs-6 fw-light">Mã số thuế: {{ $systems['contact_fax'] }}, ngày cấp ĐKKD 5/1/2018. Nơi cấp: Sở kế hoạch
                    và đầu tư Hà Nội.</p>
                <p class="mb-0 fs-6 fw-light">Điện thoại: {{ $systems['contact_phone'] }} </p>
            </div>

            <div class="col-4 d-flex justify-content-end">
                <img src="{{ asset('frontend/img/icon/bocongthuong (1).svg') }}" class="d-block img-fluid" width="200px">
            </div>
        </div>
    </div>

    <div
        class="copyright bg-dark text-white d-flex flex-column flex-md-row align-items-center justify-content-center gap-2 py-1 mt-3">
        <img src="{{ asset('frontend/img/icon/footer-logo.webp') }}" alt="">
        <span>Copyright &copy; 2024 | All Rights Reserved</span>
    </div>
</footer>