const Order = {
    submitFormData: function (formElement, url) {
        let formData = new FormData(formElement);
        formData.append('_token', HT._token);
    
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    Order.updateOrderInfo(response.data);
    
                    let modal = $(formElement).closest('.modal.show');
                    if (modal.length) {
                        modal.modal('hide');
                    }
    
                    alertify.success(response.message);
                } else {
                    alertify.error(response.message);
                }
            },
            error: function (xhr) {
                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    HT.displayValidationErrors(xhr.responseJSON.errors);
                } else {
                    console.error('AJAX Error:', xhr.responseText);
                    alertify.error(`${Config.confirmMessages.generalError}`);
                }
            },
        });
    },
    
    bindUpdateInfo: function () {
        $(document).on('click', '.submitButton', function (e) {
            e.preventDefault();
            HT.clearValidationErrors();
    
            let modal = $(this).closest('.modal.show');
            let form = modal.find('form');
            let id = form.data('id');
            let url = `/ajax/order/update/${id}`;
    
            Order.submitFormData(form[0], url);
        });
    },
    
    updateOrderInfo: function (data) {
        $('.customer-name').text(data.fullname);
        $('.customer-email').text(data.email);
    
        $('.customer-address').text(data.address.length > 20 ? data.address.slice(0, 20) + '...' : data.address);
        $('.customer-location').text(`${data.ward_name}, ${data.district_name}, ${data.province_name}`);
    
        function updateStatus(selector, statusData, key, labelPrefix = '') {
            const item = statusData[key];
            if (item) {
                $(selector)
                    .html(`${labelPrefix}${item.label}`)
                    .removeClass()
                    .addClass(`mb-1 fw-semibold ${selector.replace('.', '')}`);
            }
        }
    
        updateStatus('.confirm-status', confirmStatus, data.confirm, `${OrderDetailsMessages.messages.confirm_status}: `);
        updateStatus('.payment-status', paymentStatus, data.payment, `${OrderDetailsMessages.messages.payment_status}: `);
        updateStatus('.delivery-status', deliveryStatus, data.delivery, `${OrderDetailsMessages.messages.delivery_status}: `);
        updateStatus('.shipping-method', shippingMethods, data.method_shipping);

        const shippingIcon = shippingMethods[data.method_shipping]?.icon;
        if (shippingIcon) {
            $('.method-shipping-icon i').attr('class', shippingIcon);
        }
    },

    setupLocation: function() {
        let provinceSelect = $('select[name="province_id"]'),
            districtSelect = $('select[name="district_id"]'),
            wardSelect = $('select[name="ward_id"]');
        
        let provinceValue = $('select[name="province_id"]').data('value'),
            districtValue = $('select[name="district_id"]').data('value'),
            wardValue = $('select[name="ward_id"]').data('value');
        
        if (districtValue) {
            HT.setValueSwitchChoices(provinceSelect, provinceValue);
            LC.sendDataGetLocation({
                data : { location_id : provinceValue },
                target: "districts",
                callback: function() {
                    if (districtValue) {
                        HT.setValueSwitchChoices(districtSelect, districtValue);
                        LC.sendDataGetLocation({
                            data: { location_id : districtValue },
                            target: "wards",    
                            callback: function() {
                                if (wardValue) {
                                    HT.setValueSwitchChoices(wardSelect, wardValue);
                                }
                            }
                        })
                    }
                }
            })
        }
    },
    
    sendDataFilter: function (page = 1) {
        if (!window.location.pathname.includes('/order/index')) {
            return;
        }
    
        let dataFilterSend = { page: page };
    
        $('.filter-data').find("input, select").each(function () {
            let name = $(this).attr("name");
            if (name) {
                dataFilterSend[name] = $(this).val();
            }
        });
    
        $.ajax({
            url: '/ajax/order/filter',
            type: 'GET',
            data: dataFilterSend,
            dataType: 'json',
            success: function (response) {
                const tbody = $('.data-table');
                tbody.empty();
                
                response.data.data.forEach(item => {
                    const formattedPrice = new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(item.cart.cartTotal);
    
                    const orderDate = new Date(item.created_at);
                    const formattedDate = `${orderDate.getDate()}/${orderDate.getMonth() + 1}/${orderDate.getFullYear()}`;
    
                    const paymentMethod = paymentMethods[item.method] || 
                        { label: item.method, icon: 'fas fa-question-circle', class: 'bg-secondary bg-opacity-10 text-secondary' };
    
                    const shippingMethod = shippingMethods[item.method_shipping] || 
                        { label: 'Chưa chọn', icon: 'fas fa-question-circle', class: 'bg-secondary bg-opacity-10 text-secondary' };
    
                    const paymentStat = paymentStatus[item.payment] || 
                        { label: item.payment, icon: 'fas fa-question-circle', class: 'bg-secondary bg-opacity-10 text-secondary' };
    
                    const deliveryStat = deliveryStatus[item.delivery] || 
                        { label: item.delivery, icon: 'fas fa-question-circle', class: 'bg-secondary bg-opacity-10 text-secondary' };
    
                    const confirmStat = confirmMethods[item.confirm] || 
                        { label: item.confirm_status || 'Chưa xác nhận', icon: 'fas fa-question-circle', class: 'bg-secondary bg-opacity-10 text-secondary' };
    
                    tbody.append(`
                        <tr>
                            <td class="ps-4 fw-semibold text-primary">
                                <a href="${Config.baseUrl}/order/details/${item.code}">#DH${item.code}</a>
                            </td>
                            <td>${formattedDate}</td>
                            <td>${item.fullname}</td>
                            <td>
                                <span class="badge ${paymentMethod.class}">
                                    <i class="${paymentMethod.icon} me-1"></i> ${paymentMethod.label}
                                </span>
                            </td>
                            <td>
                                <span class="badge ${shippingMethod.class}">
                                    <i class="${shippingMethod.icon} me-1"></i> ${shippingMethod.label}
                                </span>
                            </td>
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
                            <td class="text-center">
                                <a href="${Config.baseUrl}/order/details/${item.code}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    `);
                });
    
                HT.renderPagination(response);
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

    attachFilterEvent: function () {
        $(".filter-data").find("input, select").on("input change", function () {
            clearTimeout(HT.filterTimeout);

            HT.filterTimeout = setTimeout(() => {
                Order.sendDataFilter();
            }, 500);
        });
    },
};

$(document).ready(function () {
    Order.bindUpdateInfo();
    Order.sendDataFilter();
    Order.attachFilterEvent();
    Order.attachPaginationEvent();
    Order.setupLocation();
    HT.attachFilterEvent(Order);
});