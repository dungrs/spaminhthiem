@php
    $segment = request()->segment(1);
@endphp

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ route('dashboard.index') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('backend/images/logo-sm.svg') }}" alt="" height="28">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('backend/images/logo-sm.svg') }}" alt="" height="28"> 
                <span class="logo-txt text-xs">Welcome!</span>
            </span>
        </a>

        <a href="{{ route('dashboard.index') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('backend/images/logo-sm.svg') }}" alt="" height="28">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('backend/images/logo-sm.svg') }}" alt="" height="28"> 
                <span class="logo-txt text-xs">Welcome!</span>
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                @foreach (__('sidebar.module') as $item)
                    @isset($item['menu_title'])
                        <li class="menu-title">{{ $item['menu_title'] }}</li> @continue
                    @endisset

                    <li class="{{ (in_array($segment, $item['name'])) ? 'mm-active' : '' }}">
                        <a href="{{ route('dashboard.index') }}" class="{{ isset($item['subModule']) ? 'has-arrow' : '' }}">
                            <i class="{{ $item['icon'] }} nav-icon"></i>
                            <span class="menu-item" data-key="t-ecommerce">{{ $item['title'] }}</span>
                        </a>
                        @isset($item['subModule'])
                            <ul class="sub-menu" aria-expanded="false">
                                @foreach ($item['subModule'] as $value)
                                    <li class="{{ Request::routeIs($value['route']) ? 'mm-active' : '' }}">
                                        <a href="{{ route($value['route']) }}">
                                            {{ $value['title'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endisset
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>