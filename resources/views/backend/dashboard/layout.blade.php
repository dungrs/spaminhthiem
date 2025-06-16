<!doctype html>
<html lang="en">
    <head>
        @include('backend.component.head')
    </head>

    <body data-topbar="dark" data-layout-mode="light" data-sidebar="dark">
        <!-- Begin page -->
        <div id="layout-wrapper">
            @include('backend.component.nav')
            @include('backend.component.lsidebar')
            @include($template)
        </div>
        
        <!-- END layout-wrapper -->
        @include('backend.component.rsidebar')

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        @include('backend.component.script')
    </body>
</html>