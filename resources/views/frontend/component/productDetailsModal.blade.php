<!-- Product Detail Modal -->
<div class="modal fade" id="productDetailModal" tabindex="-1" data-language-id="" data-product-id="" aria-labelledby="productDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header border-0 pb-0 position-relative">
                <h1 class="modal-title text-center w-100 fw-bold" id="productDetailModalLabel" style="font-size: 1.1rem; letter-spacing: 0.5px;">
                    THÔNG TIN SẢN PHẨM
                    <div class="mx-auto modal-title-underline mt-2"></div>
                </h1>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="" id="form-store-cart">
                @csrf
                <input type="hidden" name="language_id" value="">
                <input type="hidden" name="product_id" value="">
                <!-- Modal Body -->
                <div class="modal-body pt-4">
                    <div class="container-fluid">
                        <div class="row g-4">
                            <!-- Product Images -->
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <!-- Main Image Swiper -->
                                    <div class="col-12">
                                        <div class="swiper productImagesSwiper rounded-3 overflow-hidden" style="height: 100%; background: #f8f9fa;">
                                            <div class="swiper-wrapper">
                                                
                                            </div>
                                        </div>
                                    </div>
                            
                                    <!-- Thumbnail Swiper -->
                                    <div class="col-12">
                                        <div class="swiper productThumbsSwiper">
                                            <div class="swiper-wrapper justify-content-center">
                                                
                                            </div>
                                        </div>
                                    </div>
                            
                                </div>
                            </div>
    
                            <!-- Product Info -->
                            <div class="col-lg-6">
                                <div class="d-flex flex-column h-100 ps-lg-3">
    
                                    <!-- Product Name -->
                                    <h2 class="fw-bold mb-2 product-main-title" style="font-size: 1.4rem;"></h2>
                                    <input type="hidden" class="product-name" value="">
                                    <!-- Description -->
                                    <div class="mb-3">
                                        <p class="text-muted mb-2 product-main-description" style="font-size: 0.9rem; line-height: 1.5;">
                                            
                                        </p>
                                    </div>
    
                                    <!-- Rating and Sales -->
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="text-warning me-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <span class="text-muted me-3" style="font-size: 0.85rem;">128 đánh giá</span>
                                        <span class="text-muted" style="font-size: 0.85rem;">Đã bán 320</span>
                                    </div>
    
                                    <!-- Price -->
                                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                                        <div class="me-auto">
                                            <span class="text-danger fw-bold price-sale" style="font-size: 1.3rem;"></span>
                                            <span class="text-decoration-line-through text-muted ms-2 price-old" style="font-size: 0.9rem;"></span>
                                            <span class="badge bg-danger ms-2 discount" style="font-size: 0.8rem;"></span>
                                        </div>
                                        <div class="d-flex align-items-center text-success">
                                            <i class="fas fa-check-circle me-2"></i>
                                            <span style="font-size: 0.9rem;">Còn hàng</span>
                                        </div>
                                    </div>
    
                                    <div class="attribute-container mb-4">
    
                                    </div>
    
                                    <!-- Quantity (Compact Design) -->
                                    <div class="group-quantity">
                                        <div class="d-flex flex-column gap-2 mt-2">
                                            <span class="fs-6 fw-bold d-block mb-1">SỐ LƯỢNG</span>
                                            <div class="d-flex">
                                                <div class="custom-btn-quantity minus">-</div>
                                                <input type="number" value="1" name="quantity" id="quantity" class="custom-input-quantity text-center">
                                                <div class="custom-btn-quantity add">+</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-auto pt-2 d-grid gap-3">
                                        <button class="btn btn-primary py-auto fw-bold rounded-pill submitCartButton" 
                                                data-check="{{ empty($customer) ? 'false' : 'true' }}"
                                                style="background-color: #01964a; border-color: #01964a; letter-spacing: 0.5px; color: #fff;">
                                            <i class="fas fa-cart-plus me-2"></i> THÊM VÀO GIỎ HÀNG
                                        </button>
                                        <button class="btn btn-outline-primary py-auto fw-bold rounded-pill buyNowButton"
                                                data-check="{{ empty($customer) ? 'false' : 'true' }}"
                                                style="color: #01964a; border-color: #01964a; letter-spacing: 0.5px;">
                                            <i class="fas fa-bolt me-2"></i> MUA NGAY
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product Info -->
                        </div>
                    </div>
                </div>
                <!-- End Modal Body -->
            </form>
        </div>
    </div>
</div>
