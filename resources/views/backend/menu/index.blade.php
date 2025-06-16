@php
    $seoTables = $configs['seo']['index']['table'];
    $seoTableHeaders = $configs['seo']['index']['table']['table_header'];
@endphp
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @include('backend.menu.component.cardHeader')
                        <div class="card-body">
                            @include('backend.menu.component.filter')
                            @include('backend.menu.component.table')
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>

    @include('backend.component.footer')
</div>