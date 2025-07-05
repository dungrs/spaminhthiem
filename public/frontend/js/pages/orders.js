const Order = {
    sendDataFilter: function (page = 1) {
        let dataFilterSend = { 
            page: page,
            customer_id: customerId,
        };
    
        $.ajax({
            url: '/ajax/order/filter',
            type: 'GET',
            data: dataFilterSend,
            dataType: 'json',
            success: function (response) {
                const tbody = $('.data-table');
                tbody.empty();

                const orders = response.data.data;

                if (!orders.length) {
                    tbody.append(`
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-box-open fs-1 text-muted mb-3"></i>
                                    <p class="mb-0">Bạn chưa có đơn hàng nào</p>
                                    <a href="${Config.baseUrl}" class="btn btn-outline-primary mt-3">
                                        <i class="fas fa-shopping-cart me-2"></i>Tiếp tục mua sắm
                                    </a>
                                </div>
                            </td>
                        </tr>
                    `);
                    return;
                }

                orders.forEach(item => {
                    const formattedPrice = new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(item.cart.cartTotal);

                    const orderDate = new Date(item.created_at);
                    const formattedDate = `${orderDate.getDate()}/${orderDate.getMonth() + 1}/${orderDate.getFullYear()}`;

                    const paymentStat = paymentStatus[item.payment] || 
                        { label: item.payment, icon: 'fas fa-question-circle', class: 'bg-secondary bg-opacity-10 text-secondary' };

                    const deliveryStat = deliveryStatus[item.delivery] || 
                        { label: item.delivery, icon: 'fas fa-question-circle', class: 'bg-secondary bg-opacity-10 text-secondary' };

                    const confirmStat = confirmMethods[item.confirm] || 
                        { label: item.confirm_status || 'Chưa xác nhận', icon: 'fas fa-question-circle', class: 'bg-secondary bg-opacity-10 text-secondary' };

                    tbody.append(`
                        <tr>
                            <td class="ps-4 fw-semibold text-primary">
                                <a href="${Config.baseUrl}/don-hang.html?code=${item.code}&customer_id=${customerId}">#DH${item.code}</a>
                            </td>
                            <td>${formattedDate}</td>
                            <td style="max-width: 200px;">${item.address}</td>
                            <td class="fw-semibold">${formattedPrice}</td>
                            <td>
                                <span class="badge ${paymentStat.class}">
                                    <i class="${paymentStat.icon} me-1"></i> ${paymentStat.label}
                                </span>
                            </td>
                            <td>
                                <span class="badge ${deliveryStat.class}">
                                    <i class="${deliveryStat.icon} me-1"></i> ${deliveryStat.label}
                                </span>
                            </td>
                            <td>
                                <span class="badge ${confirmStat.class}">
                                    <i class="${confirmStat.icon} me-1"></i> ${confirmStat.label}
                                </span>
                            </td>
                        </tr>
                    `);
                });

                Library.renderPagination(response);
            },

            error: function (xhr) {
                if (xhr.status === 422) {
                    console.error('Validation Error: ', xhr.responseText);
                } else {
                    console.error('AJAX Error: ', xhr.responseText);
                }
            },
        });
    },

    attachPaginationEvent: function () {
        $(document).on('click', '.pagination .page-link', function (e) {
            e.preventDefault();

            let page = $(this).data('page');
            HT.currentPage = page;
            if (!page) return;
            
            Order.sendDataFilter(HT.currentPage);
        });
    },
};

$(document).ready(function () {
    Order.sendDataFilter();
    Order.attachPaginationEvent();
});