<!-- Charset & Viewport -->
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- Basic Info -->
<meta name="author" content="{{ $systems['homepage_company'] }}" />
<meta name="copyright" content="{{ $systems['homepage_company'] }}" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="theme-color" content="#f02b2b"/>

<!-- SEO -->
<title>{{ $seo['meta_title'] }}</title>
<meta name="description" content="{{ $seo['meta_description'] }}" />
<meta name="keyword" content="{{ $seo['meta_keyword'] }}" />
<link rel="canonical" href="{{ $seo['canonical'] }}" />

<!-- Google Verification -->
<meta name="google-site-verification" content="UEM9EiIxf4IycCJ5IVey33ujVIAGuQZ9DrWtfPSr9dc"/>
<meta name="google-site-verification" content="ZjN2o5ymTH_j2xMWXVmR6T6K4UlnVgJxM6c0SAjuCxM"/>
<meta name="google-site-verification" content="LySYxdFpQkWOJApLA1rL0c3ZC_rSubWkbsp74nLQtKE"/>

<!-- Favicon -->
<link rel="icon" href="{{ writeUrl($systems['homepage_favicon'], true) }}" type="image/png" sizes="30x30" />
<link rel="shortcut icon" href="{{ writeUrl($systems['homepage_favicon'], true) }}" type="image/x-icon">
<link rel="icon" href="{{ writeUrl($systems['homepage_favicon'], true) }}" type="image/x-icon"/>

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

<!-- DNS Prefetch -->
<link rel="dns-prefetch" href="https://fonts.googleapis.com">
<link rel="dns-prefetch" href="https://fonts.gstatic.com">

<!-- Fonts & Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" rel="stylesheet" />
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet">

<!-- Libraries CSS -->
<link href="{{ asset('frontend/libs/alertifyjs/build/css/alertify.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('frontend/libs/wow/css/libs/animate.css') }}" rel="stylesheet" type="text/css" />
<link href="https://unpkg.com/swiper/swiper-bundle.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="{{ asset('backend/libs/alertifyjs/build/css/alertify.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/libs/alertifyjs/build/css/themes/default.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.css" rel="stylesheet">
<link href="{{ asset('backend/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Core CSS - Preload -->
<link rel="preload" as='style' type="text/css" href="{{ asset('frontend/css/bootstrap-lite.css') }}">
<link rel="preload" as='style' type="text/css" href="{{ asset('frontend/css/main.scss.css') }}">
<link rel="preload" as='style' type="text/css" href="{{ asset('frontend/css/index.scss.css') }}">
<link rel="preload" as='style' type="text/css" href="{{ asset('frontend/css/responsive.scss.css') }}">

<!-- Core CSS - Styles -->
<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-lite.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/boostrap.min.css') }}">
<link href="{{ asset('frontend/css/main.scss.css') }}" rel="stylesheet" type="text/css" media="all"/>
<link href="{{ asset('frontend/css/index.scss.css') }}" rel="stylesheet" type="text/css" media="all"/>
<link href="{{ asset('frontend/css/responsive.scss.css') }}" rel="stylesheet" type="text/css" media="all"/>
<link href="{{ asset('frontend/css/appcombo.css') }}" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
<link href="{{ asset('frontend/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

<!-- Custom CSS -->
@php
      $customCss = $config['css'] ?? [];
@endphp

@foreach ($customCss as $css)
      <link href="{{ asset($css) }}" rel="stylesheet">
@endforeach

<!-- Google Tag Manager -->
<script>
      (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
            "gtm.start": (new Date).getTime(),
            event: "gtm.js"
      });
      var f = d.getElementsByTagName(s)[0], 
            j = d.createElement(s), 
            dl = l != "dataLayer" ? "&l=" + l : "";
      j.async = true;
      j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
      f.parentNode.insertBefore(j, f);
      })(window, document, "script", "dataLayer", "GTM-5D5VDGR");
</script>
<!-- End Google Tag Manager -->

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-968062939"></script>
<script>
      window.dataLayer = window.dataLayer || [];
      function gtag() {
      dataLayer.push(arguments);
      }
      gtag("js", new Date);
      gtag("config", "AW-968062939");
</script>
