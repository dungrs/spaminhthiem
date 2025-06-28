<div class="row mt-5">
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
                            <img src="{{ asset('frontend/img/icon/EmtyReview.86be870e.svg') }}" alt="Empty" class="img-fluid mb-4" style="width: 150px;">
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
                                    <div class="review-item card mb-3 border-0 shadow-sm">
                                        <div class="card-body p-4">
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
@include('frontend.product.product.component.productItem')