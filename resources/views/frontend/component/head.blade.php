<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="author" content="{{ $systems['homepage_company'] }}" />
<!-- Charset & Viewport -->
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- Basic Info -->
<meta name="author" content="{{ $systems['homepage_company'] }}" />
<meta name="copyright" content="{{ $systems['homepage_company'] }}" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- SEO -->
<title>{{ $seo['meta_title'] }}</title>
<meta name="description" content="{{ $seo['meta_description'] }}" />
<meta name="keyword" content="{{ $seo['meta_keyword'] }}" />
<link rel="canonical" href="{{ $seo['canonical'] }}" />

<!-- Favicon -->
<link rel="icon" href="{{ $systems['homepage_favicon'] }}" type="image/png" sizes="30x30" />
<link rel="shortcut icon" href="{{ asset('frontend/img/icon/favicon.webp') }}" type="image/x-icon">

<!-- Open Graph / Facebook -->
<meta property="og:locale" content="vi_VN" />
<meta property="og:title" content="{{ $seo['meta_title'] }}" />
<meta property="og:type" content="website" />
<meta property="og:image" content="{{ $seo['meta_image'] }}" />
<meta property="og:url" content="{{ $seo['canonical'] }}" />
<meta property="og:description" content="{{ $seo['meta_description'] }}" />
<meta property="og:site_name" content="" />
<meta property="fb:admins" content="" />
<meta property="app_id" content="" />

<!-- Twitter -->
<meta property="twitter:card" content="" />
<meta property="twitter:title" content="{{ $seo['meta_title'] }}" />
<meta property="twitter:description" content="{{ $seo['meta_description'] }}" />
<meta property="twitter:image" content="{{ $seo['meta_image'] }}" />

<!-- Fonts & Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" rel="stylesheet" />
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet">

<!-- Libraries -->
<link href="{{ asset('frontend/libs/alertifyjs/build/css/alertify.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('frontend/libs/wow/css/libs/animate.css') }}" rel="stylesheet" type="text/css" />
<link href="https://unpkg.com/swiper/swiper-bundle.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="{{ asset('backend/libs/alertifyjs/build/css/alertify.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/libs/alertifyjs/build/css/themes/default.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.css" rel="stylesheet">
<link href="{{ asset('backend/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Core CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/boostrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
<link href="{{ asset('frontend/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

{{-- Token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

@php
    $customCss = $config['css'] ?? [];
@endphp

@foreach ($customCss as $css)
    <link href="{{ asset($css) }}"></link>
@endforeach

