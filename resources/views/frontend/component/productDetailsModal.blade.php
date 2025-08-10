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
                                    <input type="hidden" class="product-name" value="">
    
                                    <!-- Product Details -->
                                    <div class="d-flex flex-column gap-1">
                                        <h4 class="text-start fw-bold mb-1 product-main-title">
                                        </h4>
                                        <input type="hidden" class="product-name" value="Gel Massage Desembre Jojoba &amp; Honey Massage" />
                                        <div class="mb-1">
                                            <p class="text-muted mb-1 product-main-description">
                                                
                                            </p>
                                        </div>

                                        <!-- Bọc toàn bộ phần đánh giá + tồn kho vào một hàng flex -->
                                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                            
                                            <div class="d-flex align-items-center flex-wrap gap-2 ">
                                                <div class="product-review">
                                                    
                                                </div>

                                                <div class="border-start ps-3 ms-2 text-muted product-sold" style="font-size: 0.9rem;">
                                                    
                                                </div>
                                            </div>

                                            <!-- Stock status đưa sang bên phải cùng hàng -->
                                            <div class="stock-status d-flex align-items-center mt-1">
                                                <i class="fas fa-check-circle me-2 text-primary"></i>
                                                <span class="text-primary" style="font-size: 0.9rem;">Còn hàng</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Price and SKU --}}
                                    <div class="d-flex align-items-center pb-3 border-bottom flex-wrap gap-2 mt-2">
                                        <div class="me-auto">
                                            <span class="text-danger fw-bold price-sale" style="font-size: 1.3rem;">862.400 đ</span>
                                            <span class="text-decoration-line-through text-muted ms-2 price-old" style="font-size: 0.9rem;">980.000 đ</span>

                                            <span class="badge bg-warning text-danger ms-2 discount" style="font-size: 0.8rem;">-12%</span>

                                            <!-- SKU -->
                                            <div class="mt-1 text-muted text-right" style="font-size: 0.85rem;">
                                                Mã sản phẩm (SKU):
                                                <span class="fw-semibold text-dark sku">DES-CLEANSER-WATER-104-113</span>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="attribute-container mb-4 mt-2">
    
                                    </div>
    
                                    <!-- Quantity (Compact Design) -->
                                    <div class="group-quantity mb-2">
                                        <div class="d-flex flex-column gap-2">
                                            <span class="fs-6 fw-bold d-block text-uppercase">Số Lượng</span>
                                            <div class="d-flex">
                                                <div class="custom-btn-quantity minus">-</div>
                                                <input type="number" value="1" name="quantity" id="quantity" class="custom-input-quantity text-center" min="1" max="">
                                                <div class="custom-btn-quantity add">+</div>
                                            </div>
                                            <small class="text-muted available-quantity">Còn <span class="fw-bold"></span> sản phẩm</small>
                                        </div>
                                    </div>

                                    <div class="mt-auto pt-2 d-grid gap-2">
                                        <button
                                            data-check="{{ empty($customer) ? 'false' : 'true' }}"
                                            type="submit" 
                                            class="btn btn-primary rounded-1 w-100 py-2 submitCartButton">
                                            <i class="fas fa-cart-plus me-2"></i>Thêm Vào Giỏ Hàng
                                        </button>
                                        <button class="btn btn-outline-primary fw-bold rounded-1 buyNowButton"
                                                data-check="{{ empty($customer) ? 'false' : 'true' }}"
                                                style="color: #01964a; border-color: #01964a; letter-spacing: 0.5px;">
                                            <i class="fas fa-bolt me-2"></i> Mua Ngay
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