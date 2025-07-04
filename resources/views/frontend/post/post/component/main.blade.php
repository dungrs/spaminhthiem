<main class="col-lg-9 col-md-12">
    <article class="article-card card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <!-- Tiêu đề bài viết -->
            <h1 class="article-title mb-3">{{ $post->name }}</h1>
            
            <!-- Thông tin tác giả -->
            <div class="article-meta d-flex align-items-center mb-4">
                <div class="author-avatar me-3">
                    <i class="fas fa-user-circle fs-4 text-secondary"></i>
                </div>
                <div>
                    <div class="author-name fw-medium">Minh Thiêm</div>
                    <div class="article-date text-muted small">
                        <i class="far fa-clock me-1"></i> 
                        {{ $post->created_at->format('d/m/Y - H:i') }}
                    </div>
                </div>
            </div>
            
            <!-- Nội dung bài viết -->
            <div class="article-content ck-content">
                {!! $post->content !!}
            </div>
            
            <!-- Chia sẻ bài viết -->
            <div class="article-share mt-5 pt-3 border-top">
                <div class="d-flex align-items-center">
                    <span class="me-2 fw-medium">Chia sẻ:</span>
                    <a href="#" class="btn btn-sm btn-outline-secondary me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-sm btn-outline-secondary me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="btn btn-sm btn-outline-secondary"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </article>
    
    <!-- Bình luận -->
    <section class="comments-section card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <!-- Tiêu đề phần bình luận -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="h5 mb-0 d-flex align-items-center">
                    <i class="fas fa-comments me-2 text-primary"></i>
                    Bình luận
                </h3>
            </div>

            <!-- Bình luận từ hệ thống -->
            <div class="user-comments">
                <div class="comment-list" style="max-height: 700px; overflow-y: auto;">
                    @php
                        $totalReviews = $post->reviews()->count();
                    @endphp
                    @foreach ($post->reviews as $review)
                        @php
                            $review->is_liked_by_customer = $review->likedUsers()->where('customer_id', auth('customer')->id())->exists();
                        @endphp
                        <div class="comment-item mb-4 pb-3 border-bottom">
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
                            </div>
                            <p class="mb-0">{{ $review->description }}</p>
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

                                <button class="btn btn-light border rounded-pill d-flex align-items-center px-3 py-1 shadow-sm">
                                    <i class="fas fa-reply me-2 text-success"></i> Trả lời
                                </button>
                            </div>
                        </div>
                    @endforeach

                    <!-- Trường hợp KHÔNG có bình luận -->
                    <div class="no-comments text-center py-5 {{ $totalReviews ? 'd-none' : '' }}">
                        <div class="mb-3">
                            <i class="far fa-comment-dots text-muted" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="h5 mb-2">Chưa có bình luận nào</h4>
                        <p class="text-muted mb-4">Hãy là người đầu tiên chia sẻ cảm nhận của bạn!</p>
                    </div>

                    {{-- <!-- Nút xem thêm bình luận -->
                    <div class="text-center mt-3">
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-chevron-down me-1"></i> Xem thêm bình luận
                        </button>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    
    <!-- Form bình luận -->
    <section class="comment-form card border-0 shadow-sm">
        <div class="card-body p-4">
            @if (isset($customer))
                <h3 class="h5 mb-4 d-flex align-items-center">
                    <i class="fas fa-pen me-2 text-primary"></i>
                    Viết bình luận
                </h3>
                
                <form class="review-form">
                    @csrf
                    <input type="hidden" name="reviewable_type" value="App\Models\Post">
                    <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                    <input type="hidden" name="reviewable_id" value="{{ $post->id }}">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="description" class="form-control" id="comment" name="Body" 
                                            placeholder="Nội dung" style="height: 120px" required></textarea>
                                <label for="comment">Nội dung bình luận</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-paper-plane me-2"></i> Gửi bình luận
                            </button>
                        </div>
                    </div>
                </form>
            @else
                 <!-- Phần hiển thị khi CHƯA đăng nhập -->
                <div class="comment-form-not-logged-in text-center py-4">
                    <div class="mb-3">
                        <i class="fas fa-comment-slash text-muted" style="font-size: 2.5rem;"></i>
                    </div>
                    <h4 class="h5 mb-3">Vui lòng đăng nhập để bình luận</h4>
                    <p class="text-muted mb-4">Bạn cần đăng nhập để có thể chia sẻ ý kiến và thảo luận với mọi người.</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ writeUrl('dang-nhap', true, true) }}" class="btn btn-primary px-4">
                            <i class="fas fa-sign-in-alt me-2"></i> Đăng nhập
                        </a>
                        <a href="{{ writeUrl('dang-ki', true, true) }}" class="btn btn-outline-primary px-4">
                            <i class="fas fa-user-plus me-2"></i> Đăng ký
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
</main>