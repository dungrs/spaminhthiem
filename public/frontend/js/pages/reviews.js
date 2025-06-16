const Review = {
    init: function () {
        this.handleSubmit();
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
    }
};

$(document).ready(function () {
    Review.init();
});
