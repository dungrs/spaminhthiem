@php
    $seoTables = $configs['seo']['index']['table'];
@endphp
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @include('backend.attribute.attribute.component.cardHeader')
                        <div class="card-body">
                            @include('backend.attribute.attribute.component.filter')
                            @include('backend.attribute.attribute.component.table')
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include('backend.component.footer')
</div>