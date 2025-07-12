<div class="row mt-5">
    <div class="col-12 col-lg-9 pr-xl-5">
        <div class="accordion" id="accordionExample">
            <div class="accordion border-top" id="accordionExample">
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-white fw-bold px-0 py-3 shadow-none border-bottom d-flex justify-content-between align-items-center" 
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                                aria-controls="collapseOne">
                            <span class="d-flex align-items-center">
                                <i class="fas fa-star me-2 text-warning"></i>
                                MÔ TẢ SẢN PHẨM
                            </span>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body pt-2 ck-content-wrapper">
                            <div class="mt-2">
                                {!! $content !!}
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- ĐÁNH GIÁ -->
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-white fw-bold px-0 py-3 shadow-none border-bottom d-flex justify-content-between align-items-center" 
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo">
                            <span class="d-flex align-items-center">
                                <i class="fas fa-star me-2 text-warning"></i>
                                ĐÁNH GIÁ SẢN PHẨM
                            </span>
                            <span class="badge bg-primary py-1 px-2 rounded-pill ms-2">
                                {{ $totalReviews }}
                            </span>
                        </button>
                    </h2>
                    
                    <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div>
                            <!-- Nếu chưa có đánh giá -->
                            <div class="accordion-body px-0 py-4 text-center border-bottom {{ $totalReviews ? 'd-none' : '' }}">
                                <div class="text-primary mb-2">
                                    <i class="bx bx-message-square-dots bx-lg" style="font-size: 64px;"></i>
                                </div>
                                <h5 class="fw-bold mb-2">Sản phẩm chưa có đánh giá</h5>
                                <p class="text-muted">Hãy là người đầu tiên đánh giá sản phẩm này</p>
                            </div>
                        
                            <!-- Nếu đã có đánh giá -->
                            <div class="accordion-body px-0 {{ $totalReviews ? '' : 'd-none' }}">
                                <!-- Tổng hợp rating -->
                                <div class="d-flex align-items-center mb-4 p-3 bg-light rounded">
                                    <div class="text-center me-4">
                                        <h2 class="fw-bold text-danger mb-0">{{ $totalRate }}<span class="fs-6 text-dark">/5</span></h2>
                                        <div>
                                            {!! generateStar($totalRate) !!}
                                        </div>
                                        <small class="text-muted">{{ $totalReviews }} đánh giá</small>
                                    </div>
                                    <div class="flex-grow-1">
                                        @for ($i = 5; $i >= 1; $i--)
                                            @php
                                                $countStar = $product->reviews()->where('score', $i)->count();
                                                $percent = $totalReviews ? $countStar / $totalReviews * 100 : 0;
                                            @endphp
                                            <div class="rating-progress mb-2">
                                                <div class="d-flex align-items-center">
                                                    <small class="me-2">{{ $i }} <i class="fas fa-star text-warning"></i></small>
                                                    <div class="progress flex-grow-1" style="height: 8px;">
                                                        <div class="progress-bar bg-warning" style="width: {{ $percent }}%"></div>
                                                    </div>
                                                    <small class="text-muted ms-2">{{ $countStar }}</small>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                        
                                <!-- Danh sách đánh giá -->
                                <div class="review-list" style="max-height: 700px; overflow-y: auto;">
                                    @foreach ($product->reviews as $review)
                                        @php
                                            $review->is_liked_by_customer = $review->likedUsers()->where('customer_id', auth('customer')->id())->exists();
                                        @endphp
                                        <div class="review-item card mb-3 border-0 shadow-sm" id="review-{{ $review->id }}">
                                            <div class="card-body p-4">
                                                <!-- Phần thông tin review gốc (giữ nguyên) -->
                                                <div class="d-flex justify-content-between align-items-start mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $review->customers->image ?? asset('frontend/img/icon/icon-user.svg') }}" 
                                                            alt="{{ $review->customers->name }}" 
                                                            class="rounded-circle me-3" 
                                                            style="width: 40px; height: 40px; object-fit: cover;">
                                                        <div>
                                                            <h6 class="mb-0 fw-bold">{{ $review->customers->name }}</h6>
                                                            <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <div class="star-rating mb-1">
                                                            {!! generateStar($review->score) !!}
                                                        </div>
                                                        <small class="text-muted">{{ $review->created_at->format('d/m/Y') }}</small>
                                                    </div>
                                                </div>
                                                <p class="mb-0">{{ $review->description }}</p>
                                                
                                                <!-- Phần actions -->
                                                <div class="comment-actions mt-3 d-flex gap-2">
                                                    <button class="btn btn-light border rounded-pill d-flex align-items-center px-3 py-1 shadow-sm btn-like-review {{ $review->is_liked_by_customer ? 'active' : '' }}"
                                                        data-review-id="{{ $review->id }}"
                                                        data-customer-id="{{ $customer->id ?? 0 }}">
                                                        <i class="{{ $review->is_liked_by_customer ? 'fas' : 'far' }} fa-thumbs-up me-2 text-primary"></i> Thích
                                                        @if ($review->like_count > 0)
                                                            <span class="ms-1 like-count">({{ $review->like_count }})</span>
                                                        @else
                                                            <span class="ms-1 like-count" style="display: none;"></span>
                                                        @endif
                                                    </button>

                                                    <button class="btn btn-light border rounded-pill d-flex align-items-center px-3 py-1 shadow-sm btn-reply"
                                                        data-review-id="{{ $review->id }}">
                                                        <i class="fas fa-reply me-2 text-success"></i> Trả lời
                                                    </button>
                                                </div>

                                                {{-- <!-- Danh sách các phản hồi (nếu có) -->
                                                <div class="replies-list mt-3 ps-4 border-start border-2 border-light">
                                                    <div class="reply-item mb-3">
                                                        <div class="d-flex align-items-start">
                                                            <img src="{{ $review->customers->image ?? asset('frontend/img/icon/icon-user.svg') }}" 
                                                                alt="{{ $review->customers->name }}" 
                                                                class="rounded-circle me-3" 
                                                                style="width: 40px; height: 40px; object-fit: cover;">
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-0 fw-bold">{{ $customer->name }}</h6>
                                                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                                                <p class="mb-0 mt-1">{{ $review->description }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="reply-item mb-3">
                                                        <div class="d-flex align-items-start">
                                                            <img src="{{ $review->customers->image ?? asset('frontend/img/icon/icon-user.svg') }}" 
                                                                alt="{{ $review->customers->name }}" 
                                                                class="rounded-circle me-3" 
                                                                style="width: 40px; height: 40px; object-fit: cover;">
                                                            <div class="flex-grow-1">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <h6 class="mb-0 fw-bold text-dark">{{ $customer->name }}</h6>
                                                                    <i class="fas fa-reply text-muted small"></i>
                                                                    <h6 class="mb-0 fw-bold text-primary">Thiều Lê Dũng</h6>
                                                                </div>

                                                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                                                <p class="mb-0 mt-1">{{ $review->description }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="reply-item mb-3">
                                                        <div class="d-flex align-items-start">
                                                            <img src="{{ $review->customers->image ?? asset('frontend/img/icon/icon-user.svg') }}" 
                                                                alt="{{ $review->customers->name }}" 
                                                                class="rounded-circle me-3" 
                                                                style="width: 40px; height: 40px; object-fit: cover;">
                                                            <div class="flex-grow-1">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <h6 class="mb-0 fw-bold text-dark">{{ $customer->name }}</h6>
                                                                    <i class="fas fa-reply text-muted small"></i>
                                                                    <h6 class="mb-0 fw-bold text-primary">Dương Hồng Nhung</h6>
                                                                </div>

                                                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                                                <p class="mb-0 mt-1">{{ $review->description }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Phần form trả lời (ẩn ban đầu) -->
                                                <div class="reply-form mt-3" id="reply-form-{{ $review->id }}" style="display: none;">
                                                    <form class="reply-form-inner" data-review-id="{{ $review->id }}">
                                                        @csrf
                                                        <div class="form-group mb-2">
                                                            <textarea class="form-control reply-textarea" 
                                                                    rows="3" 
                                                                    placeholder="Viết phản hồi của bạn..." 
                                                                    required></textarea>
                                                        </div>
                                                        <div class="d-flex justify-content-end gap-2">
                                                            <button type="button" class="btn btn-outline-secondary btn-cancel-reply" 
                                                                    data-review-id="{{ $review->id }}">
                                                                Hủy
                                                            </button>
                                                            <button type="submit" class="btn btn-primary btn-submit-reply">
                                                                Gửi phản hồi
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div> --}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        
                            <!-- Form viết đánh giá -->
                            @if (isset($customer))
                                <div class="accordion-body px-0 pt-4">
                                    <h5 class="fw-bold mb-4">VIẾT ĐÁNH GIÁ</h5>
                                    <form class="review-form">
                                        <div class="d-flex mb-3">
                                            <div class="rating">
                                                @for ($i = 5; $i >= 1; $i--)
                                                    <input type="radio" id="star{{ $i }}" name="score" value="{{ $i }}">
                                                    <label for="star{{ $i }}" title="{{ $i }} sao" class="fa-solid me-2 fa-star fs-3"></label>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="reviewComment" class="form-label fw-medium mb-2">Nhận xét</label>
                                            <textarea class="form-control" name="description" id="reviewComment" rows="4" placeholder="Hãy chia sẻ cảm nhận của bạn về sản phẩm"></textarea>
                                        </div>
                                        <input type="hidden" name="reviewable_type" value="App\Models\Product">
                                        <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                                        <input type="hidden" name="reviewable_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">
                                            <i class="fas fa-paper-plane me-2"></i> Gửi đánh giá
                                        </button>
                                    </form>
                                </div>
                            @else
                                <!-- Yêu cầu đăng nhập -->
                                <div class="card border-0 shadow-sm text-center py-5">
                                    <div class="card-body">
                                        <i class="fas fa-lock text-muted fs-1 mb-3"></i>
                                        <h5 class="fw-bold mb-3">Đăng nhập để đánh giá</h5>
                                        <p class="text-muted mb-4">Vui lòng đăng nhập để chia sẻ đánh giá về sản phẩm</p>
                                        <a href="{{ route('customer.showLogin') }}" class="btn btn-primary px-5">
                                            <i class="fas fa-sign-in-alt me-2"></i> Đăng nhập ngay
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3">
        <div class="product-sidebar">
            <div class="">
                <h3 class="product-sidebar__title text-center" style="font-size: 1rem; color: #fff; padding: 10px; border-radius: 8px 8px 0 0; margin: 0px; background: var(--primary-color); margin-bottom: 0.75rem;">
                    <a style="font-size: 1rem; color: #fff;" href="/san-pham-moi" title="Ưu đãi HOT 🔥"> Ưu đãi HOT 🔥 </a>
                </h3>
            </div>
            <div class="product-sidebar-title">
                <div class="item_product_main product--media">
                    @foreach ($widgets['hot-deal']['object']->take(2) as $product)
                        @if ($productId == $product->id)
                            @continue
                        @endif
                        @php
                            $name = $product->name;
                            $made_in = $product->made_in;
                            $image = asset(image($product->image));
                            $price = number_format($product->product_variants->first()->price ?? 0);
                            if (isset($product->promotion)) {
                                $promotion = $product->promotion->toArray();
                                $discount = getDiscountType($promotion);
                            }

                            $canonical = writeUrl($product->canonical, true, true);

                            $total = $product->product_variants->sum('quantity');
                            $sold = $product->sold;
                            $percent = round(($sold / $total) * 100);

                            $totalReviews = $product->reviews()->count();
                            $totalRate = number_format($product->reviews()->avg('score'), 1);
                            $starPercent = ($totalReviews == 0) ? '0' : $totalRate / 5 * 100;
                        @endphp

                        <div class="item_product_main product--media">
                            <form action="" method="post" class="variants product-action" data-id="product-actions-{{ $product->id }}" enctype="multipart/form-data">
                                <div class="product-thumbnail pos-relative">
                                    <a class="image_thumb pos-relative embed-responsive embed-responsive-1by1" href="{{ $canonical }}" title="{{ $name }}">
                                        <img loading="lazy"
                                            width="480"
                                            height="480"
                                            style="--image-scale: 1;"
                                            src="{{ $image }}"
                                            alt="{{ $name }}"
                                        />
                                    </a>

                                    @if (isset($product->promotion))
                                        <div class="label_product">
                                            <div class="label_wrapper">
                                                -{{ $discount['value'] }} {{ $discount['type'] }}
                                            </div>
                                        </div>
                                    @endif

                                    <div class="product-action">
                                        <div class="group_action" data-url="{{ $canonical }}">
                                            <a title="Xem nhanh" href="{{ $canonical }}" data-handle="{{ $product->canonical }}" class="xem_nhanh btn-circle btn-views btn_view btn right-to quick-view">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="product-info">
                                    <span class="product-vendor">{{ $made_in }}</span>
                                    
                                    <h3 class="product-name">
                                        <a href="{{ $canonical }}" title="{{ $name }}">{{ $name }}</a>
                                    </h3>

                                    <div class="d-flex align-items-center mb-2">
                                        @if($totalReviews > 0)
                                            <div class="text-warning small">
                                                {!! generateStar($totalRate) !!}
                                            </div>
                                            <span class="text-muted me-1 small">({{ $totalReviews }} đánh giá)</span>
                                        @else
                                            <span class="text-muted me-1 small">
                                                <i class="fas fa-comment-slash me-1"></i> Chưa có đánh giá
                                            </span>
                                        @endif
                                    </div>

                                    <div class="product-item-cta position-relative">
                                        <div class="price-box">
                                            @if (isset($product->promotion))
                                                <span class="price">{{ $discount['sale_price'] }}₫</span>
                                                <span class="compare-price">{{ $discount['old_price'] }}₫</span>

                                                <div class="label_product d-lg-none d-md-none d-xl-none d-inline-block">
                                                    <div class="label_wrapper">
                                                        -{{ $discount['value'] }} {{ $discount['type'] }}
                                                    </div>
                                                </div>
                                            @else
                                                <span class="price">{{ $price }}₫</span>
                                            @endif
                                        </div>

                                        <input type="hidden" name="variantId" value="{{ $product->product_variants->first()->id ?? '' }}" />
                                        <button class="product-item-btn btn add_to_cart active" title="Thêm vào giỏ hàng">
                                            <svg class="icon">
                                                <use xlink:href="#icon-plus"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@include('frontend.product.product.component.productItem')