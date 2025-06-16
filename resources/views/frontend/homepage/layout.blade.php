<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.component.head')
</head>
<body class="bg-white">
    @include('frontend.component.header')
    @include($template)
    @include('frontend.component.footer')
    @include('frontend.component.script')
</body>
</html>