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

<meta name="google-site-verification" content="UEM9EiIxf4IycCJ5IVey33ujVIAGuQZ9DrWtfPSr9dc"/>
<meta charset="UTF-8"/>
<meta name="google-site-verification" content="ZjN2o5ymTH_j2xMWXVmR6T6K4UlnVgJxM6c0SAjuCxM"/>
<!-- Google Tag Manager -->
<script>
      (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
      "gtm.start": (new Date).getTime(),
      event: "gtm.js"
      });
      var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = l != "dataLayer" ? "&l=" + l : "";
      j.async = true;
      j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
      f.parentNode.insertBefore(j, f);
      })(window, document, "script", "dataLayer", "GTM-5D5VDGR");
</script>
<!-- End Google Tag Manager -->
<meta name="google-site-verification" content="LySYxdFpQkWOJApLA1rL0c3ZC_rSubWkbsp74nLQtKE"/>

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
<meta name="theme-color" content="#f02b2b"/>
<meta
      property="og:image"
      content="https://bizweb.dktcdn.net/100/494/811/themes/921992/assets/share_fb_home.jpg?1717567288856">
<meta
      property="og:image:secure_url"
      content="https://bizweb.dktcdn.net/100/494/811/themes/921992/assets/share_fb_home.jpg?1717567288856">
<link
      rel="icon"
      href="//bizweb.dktcdn.net/100/494/811/themes/921992/assets/favicon.png?1717567288856"
      type="image/x-icon"/>
<link rel="dns-prefetch" href="https://fonts.googleapis.com">
<link rel="dns-prefetch" href="https://fonts.gstatic.com">
<link rel="dns-prefetch" href="https://bizweb.dktcdn.net">
<link rel="dns-prefetch" href="https://myphamthucuc.com">
<link
      rel="preload"
      as='style'
      type="text/css"
      href="{{ asset('frontend/css/main.scss.css') }}">
<link
      rel="preload"
      as='style'
      type="text/css"
      href="{{ asset('frontend/css/index.scss.css') }}">
<link
      rel="preload"
      as='style'
      type="text/css"
      href="{{ asset('frontend/css/bootstrap-lite.css') }}">
<link
      rel="preload"
      as='style'
      type="text/css"
      href="{{ asset('frontend/css/responsive.scss.css') }}">
<link
      rel="preload"
      as='style'
      type="text/css"
      href="{{ asset('frontend/css/product_infor_style.scss.css') }}">
<link
      rel="stylesheet"
      href="{{ asset('frontend/css/bootstrap-lite.css') }}">
<link
      href="{{ asset('frontend/css/main.scss.css') }}"
      rel="stylesheet"
      type="text/css"
      media="all"/>
<link
      href="{{ asset('frontend/css/product_infor_style.scss.css') }}"
      rel="stylesheet"
      type="text/css"
      media="all"/>
<link
      href="{{ asset('frontend/css/index.scss.css') }}"
      rel="stylesheet"
      type="text/css"
      media="all"/>
<link
      rel="preload"
      as="script"
      href="//bizweb.dktcdn.net/100/494/811/themes/921992/assets/jquery.js?1717567288856"/>
<script src="//bizweb.dktcdn.net/100/494/811/themes/921992/assets/jquery.js?1717567288856" type="text/javascript"></script>
<link
      href="{{ asset('frontend/css/responsive.scss.css') }}"
      rel="stylesheet"
      type="text/css"
      media="all"/>
      
<script>
      var Bizweb = Bizweb || {};
      Bizweb.store = "my-pham-cho-spa.mysapo.net";
      Bizweb.id = 494811;
      Bizweb.theme = {
      id: 921992,
      name: "EGA Cosmetic",
      role: "main"
      };
      Bizweb.template = "index";
      if (!Bizweb.fbEventId) Bizweb.fbEventId = "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g, (function(c) {
      var r = Math.random() * 16 | 0, v = c == "x" ? r : r & 3 | 8;
      return v.toString(16);
      }));
</script>
<script>
      (function() {
      function asyncLoad() {
      var urls = [ "//newproductreviews.sapoapps.vn/assets/js/productreviews.min.js?store=my-pham-cho-spa.mysapo.net" ];
      for (var i = 0; i < urls.length; i++) {
            var s = document.createElement("script");
            s.type = "text/javascript";
            s.async = true;
            s.src = urls[i];
            var x = document.getElementsByTagName("script")[0];
            x.parentNode.insertBefore(s, x);
      }
      }
      window.attachEvent ? window.attachEvent("onload", asyncLoad) : window.addEventListener("load", asyncLoad, false);
      })();
</script>
<script>
      window.BizwebAnalytics = window.BizwebAnalytics || {};
      window.BizwebAnalytics.meta = window.BizwebAnalytics.meta || {};
      window.BizwebAnalytics.meta.currency = "VND";
      window.BizwebAnalytics.tracking_url = "/s";
      var meta = {};
      for (var attr in meta) {
      window.BizwebAnalytics.meta[attr] = meta[attr];
      }
</script>
<link
      href="{{ asset('frontend/css/appcombo.css') }}"
      rel="stylesheet"
      type="text/css"
      media="all"/>