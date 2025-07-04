@include('frontend.component.breadcrumb', ['model' => $post, 'breadcrumb' => $breadcrumb])
<section class="blog-page">
    <div class="container">
        <div class="row">
            @include('frontend.post.post.component.main')
            @include('frontend.post.post.component.sidebar')
        </div>
    </div>
</section>