const Review = {
    init: function () {
        this.handleSubmit();
        this.handleLike();
    },

    handleSubmit: function () {
        $(document).on('submit', '.review-form', function (e) {
            e.preventDefault();

            let _this = $(this);
            let formData = _this.serialize();

            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/ajax/review/create',
                method: 'POST',
                data: formData,
                dataType: 'json',
                beforeSend: function () {
                    _this.find('.btn-send-review').prop('disabled', true).text('Đang gửi...');
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken 
                },
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Gửi đánh giá thành công!');
                        location.reload();
                    } else {
                        alert(response.message || 'Đã có lỗi xảy ra!');
                    }
                },
                error: function (xhr) {
                    alert('Đã có lỗi xảy ra. Vui lòng thử lại!');
                },
                complete: function () {
                    _this.find('.btn-send-review').prop('disabled', false).text('GỬI ĐÁNH GIÁ');
                }
            });
        });
    },

    handleLike: function () {
        $(document).on('click', '.btn-like-review', function (e) {
            e.preventDefault();

            let _this = $(this);
            let reviewId = _this.data('review-id');
            let customerId = _this.data('customer-id');
            let likeCountElement = _this.find('.like-count');
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            if (!customerId) {
                alert('Vui lòng đăng nhập để thích đánh giá!');
                return;
            }

            let isLiked = _this.hasClass('active');
            let currentCount = parseInt(likeCountElement.text().replace(/[()]/g, '')) || 0;

            $.ajax({
                url: '/ajax/review/toggleLike',
                method: 'POST',
                data: {
                    review_id: reviewId,
                    customer_id: customerId,
                    action: isLiked ? 'unlike' : 'like'
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                beforeSend: function () {
                    _this.prop('disabled', true);
                },
                success: function (response) {
                    if (response.status === 'success') {
                        if (isLiked) {
                            _this.removeClass('active');
                            _this.find('i').removeClass('fas').addClass('far');
                            currentCount = Math.max(0, currentCount - 1);
                        } else {
                            _this.addClass('active');
                            _this.find('i').removeClass('far').addClass('fas');
                            currentCount += 1;
                        }

                        if (currentCount > 0) {
                            likeCountElement.text(`(${currentCount})`).show();
                        } else {
                            likeCountElement.text('').hide();
                        }
                    } else {
                        alert(response.message || 'Đã có lỗi xảy ra!');
                    }
                },
                error: function () {
                    alert('Đã có lỗi xảy ra. Vui lòng thử lại!');
                },
                complete: function () {
                    _this.prop('disabled', false);
                }
            });
        });
    }

};

$(document).ready(function () {
    Review.init();
});