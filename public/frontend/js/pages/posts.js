const Post = {
    sendDataFilter: function (page = 1) {
        let dataFilterSend = { 
            page: page,
            post_catalogue_id: $('input[name="post_catalogue_id"]').val() || null
        };

        $.ajax({
            url: '/ajax/post/filter',
            type: 'GET',
            data: dataFilterSend,
            dataType: 'json',
            success: function (response) {
                const postsContainer = $('#data-post');
                const paginationContainer = $('#pagination-post');

                postsContainer.empty();

                if (!response.data.data.length) {
                    postsContainer.html('<div class="col-12 text-center text-muted">Không có bài viết nào</div>');
                    paginationContainer.empty();
                    return;
                }

                response.data.data.forEach(item => {
                    const postHtml = `
                        <div class="col-md-6 col-lg-4 mb-4">
                            <article class="blog-card">
                                <a href="${Config.baseUrl}/${item.canonical}.html" class="blog-image">
                                    <img src="${item.image || '/public/images/default-post.jpg'}" 
                                         alt="${item.name || 'Bài viết'}" 
                                         class="img-fluid">
                                </a>
                                <div class="blog-content">
                                    <h3 class="blog-title">
                                        <a href="${Config.baseUrl}/${item.canonical}.html">${item.name || 'Bài viết'}</a>
                                    </h3>
                                    <div class="blog-meta">
                                        <span class="author">${item.author || 'Minh Thiêm'}</span>
                                        <span class="date">${new Date(item.created_at).toLocaleDateString('vi-VN')}</span>
                                    </div>
                                    <p class="blog-excerpt">
                                        ${item.meta_description ? item.meta_description.substring(0, 100) + '...' : 'Nội dung bài viết...'}
                                    </p>
                                    <a href="${Config.baseUrl}/${item.canonical}.html" class="read-more">Đọc tiếp</a>
                                </div>
                            </article>
                        </div>
                    `;
                    postsContainer.append(postHtml);
                });

                Library.renderPagination(response);
            },
            error: function (xhr) {
                console.error('AJAX Error: ', xhr.responseText);
            },
        });
    },

    attachPaginationEvent: function () {
        $(document).on('click', '.pagination .page-link', function (e) {
            e.preventDefault();
            let page = $(this).data('page');
            if (!page) return;
            Post.sendDataFilter(page);
        });
    },

    attachFilterEvent: function () {
        $(".filter-data").find("input, select").on("input change", function () {
            clearTimeout(HT.filterTimeout);
            HT.filterTimeout = setTimeout(() => {
                Post.sendDataFilter();
            }, 500);
        });
    },
};

$(document).ready(function () {
    Post.sendDataFilter();
    Post.attachFilterEvent();
    Post.attachPaginationEvent();
});