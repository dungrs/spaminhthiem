@php
    $seoTables = $configs['seo']['index']['table'];
@endphp
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @include('backend.promotion.component.cardHeader')
                        <div class="card-body">
                            @include('backend.promotion.component.filter')
                            @include('backend.promotion.component.table')
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <script>
        var PromotionDetailsMessages = {
            messages: {!! json_encode(__('messages.promotion.details')) !!}
        };
    </script>

    @include('backend.component.footer')
</div>