<meta charset="utf-8" />
<title>Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="" name="description" />
<meta content="Themesdesign" name="author" />
<link rel="shortcut icon" href="{{ asset('backend/images/logo-sm.svg') }}">

<!-- plugin css -->
<link href="{{ asset('backend/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

{{-- Plugin css default--}}
<link href="{{ asset('backend/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/libs/alertifyjs/build/css/alertify.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/libs/alertifyjs/build/css/themes/default.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Bootstrap Css -->
<link href="{{ asset('backend/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />

<!-- Icons Css -->
<link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" rel="stylesheet" />
<link href="{{ asset('backend/css/jquery-ui.css') }}" rel="stylesheet" type="text/css" />

<!-- App Css-->
<link href="{{ asset('backend/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/css/style.css') }}" id="app-style" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{ asset('backend/libs/swiper/swiper-bundle.min.css') }}">

<!-- Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

@if (isset($configs['css']) && is_array($configs['css']))
    @foreach ($configs['css'] as $item)
        <link rel="stylesheet" href="{{ asset($item) }}">
    @endforeach
@endif