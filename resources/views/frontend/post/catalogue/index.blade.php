@include('frontend.component.breadcrumb', ['model' => $postCatalogue, 'breadcrumb' => $breadcrumb])
<section class="blog-page py-4">
    <div class="container">
        <div class="row">
            <input type="hidden" name="post_catalogue_id" value="{{ $postCatalogueById->id }}">
            @include('frontend.post.catalogue.component.main')
            @include('frontend.post.catalogue.component.sidebar')
        </div>
    </div>
</section>