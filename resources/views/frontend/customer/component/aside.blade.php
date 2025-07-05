<div class="col-xs-12 col-sm-12 col-lg-3 col-left-ac">
    <div class="block-account">
        <h5 class="title-account">Trang tài khoản</h5>
        <p>
            Xin chào, <span style="color:#01964a;">{{ $customer->name }}</span>&nbsp;!
        </p>
        <ul>
            <li>
                <a class="title-info {{ $active == 'tai-khoan' ? 'active' : '' }}"
                href="{{ writeUrl('tai-khoan', true, true) }}">
                Thông tin tài khoản
                </a>
            </li>
            <li>
                <a class="title-info {{ $active == 'don-hang' ? 'active' : '' }}"
                href="{{ writeUrl('don-hang-cua-toi', true, true) }}">
                Đơn hàng của bạn
                </a>
            </li>
        </ul>
    </div>
</div>