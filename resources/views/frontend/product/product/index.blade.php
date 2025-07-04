
@php
    $productId          = $product->id;
    $name               = $product->name;
    $image              = asset(image($product->image));
    $price              = number_format($product->product_variants->first()->price ?? 0);
    $canonical          = writeUrl($product->canonical, true, true);
    
    $description        = $product->description;
    $content            = $product->content;
    $meta_description   = $product->meta_description;

    $attributeCatalogue = $product->attributeCatalogue;

    $album              = json_decode($product->album);

    $discount = [];
    if (!empty($product->promotions)) {
        foreach ($product->promotions as $promotion) {
            $discount[] = getDiscountType($promotion);
        }
    }

    $totalReviews = $product->reviews()->count();
    $totalRate = number_format($product->reviews()->avg('score'), 1);
    $starPercent = ($totalReviews == 0) ? '0' : $totalRate / 5 * 100;

    $fiveStar = $product->reviews()->where('score', 5)->count();
    $fourStar = $product->reviews()->where('score', 4)->count();
    $threeStar = $product->reviews()->where('score', 3)->count();
    $twoStar = $product->reviews()->where('score', 2)->count();
    $oneStar = $product->reviews()->where('score', 1)->count();
@endphp
@include('frontend.component.breadcrumb', ['model' => $product, 'breadcrumb' => $breadcrumb])
<section class="body">
    <div class="container mt-4">
        @include('frontend.product.product.component.details')
        @include('frontend.product.product.component.descriptionReview')
    </div>
</section>