{{-- Start Begin Content --}}
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="" id="form-store-modal" data-language-id="{{ isset($post) ? $post->language_id : '' }}" data-id="{{ isset($post) ? $post->id : '' }}">
                <div class="row">
                    <div class="col-lg-9">
                        <div id="addpost-accordion" class="custom-accordion">
                            @include("backend.component.content", ['model' => $post ?? null, "index" => "01"])
                            @include("backend.component.seo", ['model' => $post ?? null, "index" => "02"])
                        </div>
                    </div>
                    <div class="col-lg-3">
                        @include("backend.post.post.component.aside", ['model' => $post ?? null])
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