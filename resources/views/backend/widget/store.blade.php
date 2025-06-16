{{-- Start Begin Content --}}
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="" id="form-store-modal" data-id="{{ isset($widget) ? $widget->id : '' }}"  data-language-id="{{ isset($widget) ? $widget->language_id : '' }}" >
                <div class="row">
                    <div class="col-lg-9">
                        <div id="addpost-accordion" class="custom-accordion">
                            @include("backend.component.content", ['model' => $widget ?? null,'offTitle' => true, 'offContent' => true, "index" => "01"])
                            @include("backend.component.album", ['index' => "02"])
                            @include("backend.widget.component.configWidget")
                        </div>
                    </div>
                    <div class="col-lg-3">
                        @include("backend.widget.component.aside", ['model' => $widget ?? null])
                    </div>
                </div>
                <!-- end row -->
    
                <div class="row mb-4">
                    <div class="col text-end">
                        <button type="submit" class="btn btn-success submitButton">
                            <i class="bx bx-file me-1"></i> {{ __('messages.save') }}
                        </button>
                    </div> <!-- end col -->
                </div> <!-- end row-->
                <!-- end row -->
            </form>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @include('backend.component.footer')
</div>
{{-- End Begin Content --}}
<script>
    const WidgetConfig = {
        messages : {!! json_encode(__('messages.widget.content_configuration.search_section.item_template')) !!},
    };
</script>