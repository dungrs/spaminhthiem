const Promotion = {
    debounceTimer: null,
    ranges: [],
    objectChooses: [],

    promotionNeverEnd: function () {
        const $checkbox = $('#never_end_date');
        const $endDateInput = $('input[name="end_date"]');
    
        const toggleEndDateState = () => {
            const isChecked = $checkbox.is(':checked');
    
            if (isChecked) {
                $endDateInput.prop('disabled', true); 
                $endDateInput.val('');
            } else {
                $endDateInput.prop('disabled', false);
            }
        };
    
        toggleEndDateState();
    
        $checkbox.on('change', toggleEndDateState);
    }
    ,

    promotionSource: function() {
        $(document).on('click', '.chooseSource', function() {
            let _this = $(this);
            let parentContent = _this.closest('.choose-source-container');

            if (_this.attr('id') === 'allSource') {
                parentContent.find('.select-source-wrapper').remove();
            } else if (parentContent.find('.select-source-wrapper').length === 0) {
                $.ajax({
                    url: '/ajax/source/getAllSource',
                    type: 'GET',
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            parentContent.append(Promotion.renderSelectSourcePromotion(response.data))
                            HT.initializeMultiChoices();
                        } else {
                            alertify.error(`${Config.confirmMessages.generalError}`);
                        }
                    },  
                    error: function (xhr) {
                        if (xhr.status === 422 && xhr.responseJSON?.errors) {
                            alertify.error(xhr.responseJSON.errors);
                        } else {
                            alertify.error(`${Config.confirmMessages.generalError}`);
                        }
                    },
                });
            }
        })
    },

    renderSelectSourcePromotion: function(datas) {
        let dataHtml = datas.map(data => `<option value="${data.id}">${data.name}</option>`)
                            .join(' ')
        
        return `
            <div class="mb-3 select-source-wrapper">
                <label class="form-label fw-semibold">${PromotionAsidesMessages.messages.source.select_channels}</label>
                <select name="sourceValue[]" id="sourceSelect" class="form-select choice-multi" multiple>
                    <option value="">${PromotionAsidesMessages.messages.source.select_channels_placeholder}</option>
                    ${dataHtml}
                </select>
            </div>
        `;
    },

    chooseCustomerCondition: function() {
        $(document).on('click', '.chooseApply', function() {
            let _this = $(this);
            let parentContent = _this.closest('.choose-source-container');
            if (_this.attr('id') === 'allApply') {
                parentContent.find('.select-apply-wrapper').remove();
                $('.wrapper-condition').html('');
            } else if (parentContent.find('.select-apply-wrapper').length === 0) {
                parentContent.append(Promotion.renderSelectApplyCondition(applyData));
                Promotion.initializeMultiConditonChoices();
            }
        })
    },

    renderSelectApplyCondition: function(applyData) {
        let dataHtml = applyData.map(data => `<option value="${data.id}">${data.name}</option>`)
                            .join(' ')

        return `
            <div class="mt-3 mb-1 select-apply-wrapper">
                <label for="applyValue[]">${PromotionAsidesMessages.messages.source.select_groups}</label>
                <select name="applyValue[]" id="applySelect" class="choice-multi-condition conditionItem" multiple>
                    <option value="">${PromotionAsidesMessages.messages.source.select_groups_placeholder}</option>
                    ${dataHtml}
                </select>
            </div>
        `;
    },

    chooseApplyItem: function() {
        $(document).on('change', '.conditionItem', function () {
            clearTimeout(Promotion.debounceTimer);
            Promotion.debounceTimer = setTimeout(() => {
                Promotion.handleSelectChange($(this));
            }, 300);
        });
    },

    handleSelectChange: function(_this) {
        clearTimeout(this.debounceTimer);
        this.debounceTimer = setTimeout(() => {
            let selectedValues = _this.val() || [];
            let pendingRequests = selectedValues.length;
            
            selectedValues.forEach(value => {
                if (!$(`.wrapper-condition .wrapper-condition-item[data-value="${value}"]`).length) {
                    let condition = {
                        value: value,
                        label: _this.find(`option[value="${value}"]`).text()
                    };
                    
                    _this.prop('disabled', true);
                    
                    $.ajax({
                        url: '/ajax/promotion/getPromotionConditionValue',
                        type: 'GET',
                        dataType: 'json',
                        data: { value },
                        success: (response) => {
                            if (response.data && Array.isArray(response.data)) {
                                if (!$(`.wrapper-condition .wrapper-condition-item[data-value="${value}"]`).length) {
                                    let optionData = {
                                        [condition.value]: response.data.map(item => ({
                                            id: item.id,
                                            name: item.name
                                        }))
                                    };
                                    
                                    let html = this.renderConditionHTML(condition, optionData);
                                    $('.wrapper-condition').append(html);
                                    HT.initializeMultiChoices();
                                }
                            } else {
                                alertify.error(`${Config.confirmMessages.generalError}`);
                            }
                            
                            if (--pendingRequests === 0) {
                                _this.prop('disabled', false);
                            }
                        },  
                        error: (xhr) => {
                            if (xhr.status === 422 && xhr.responseJSON?.errors) {
                                alertify.error(xhr.responseJSON.errors);
                            } else {
                                alertify.error(`${Config.confirmMessages.generalError}`);
                            }
                            
                            if (--pendingRequests === 0) {
                                _this.prop('disabled', false);
                            }
                        },
                    });
                } else {
                    if (--pendingRequests === 0) {
                        _this.prop('disabled', false);
                    }
                }
            });
        }, 300);
    },

    renderConditionHTML: function(condition, optionData) {
        let content = '';
        if (optionData[condition.value]) {
            content = optionData[condition.value]
                .map(item => `<option value="${item.id}">${item.name}</option>`)
                .join('\n');
        }
    
        return `
            <div class="col-md-12 wrapper-condition-item ${condition.value} mb-3" data-value="${condition.value}">
                <label class="form-label fw-semibold">${condition.label}</label>
                <select name="${condition.value}[]" class="form-select choice-multi" multiple>
                    <option value="">${condition.label}</option>
                    ${content}
                </select>
            </div>
        `;
    },

    renderOrderRangeConditionContainer: function() {
        let option = $('.promotionMethod').val();

        if (option) {
            performAction(option);
        } 

        $(document).on('change', '.promotionMethod', function () {
            let _this = $(this);
            option = _this.val();
            performAction(option);
            Promotion.checkSelectedProductModel();
        });

        function performAction(option) {
            const actions = {
                order_amount_range: () => Promotion.renderOrderAmountRange(),
                product_and_quantity: () => Promotion.renderProductAndQuantity(),
                // product_quantity_range: () => console.log('product_quantity_range'),
                // goods_discount_by_quantity: () => console.log('goods_discount_by_quantity'),
            };
    
            (actions[option] || Promotion.removePromotionContainer)();
        }
    },

    renderOrderAmountRange: function() {
        let datas = JSON.parse($('.input_order_amount_range').val());
        let html = ''
        if (datas && datas.amountFrom && datas.amountFrom.length > 0) {
            html = `
            <div class="order_amount_range">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="30%">${PromotionDetailsMessages.messages.order_amount.from}</th>
                            <th width="30%">${PromotionDetailsMessages.messages.order_amount.to}</th>
                            <th width="20%">${PromotionDetailsMessages.messages.order_amount.discount} (%)</th>
                            <th width="5%"></th>
                        </tr>
                    </thead>
                        <tbody>
                        `
            datas.amountFrom.forEach((amountFrom, index) => {
                html += `
                    <tr>
                        <td class="order_amount_range_from">
                            <input type="text" name="promotion_order_amount_range[amountFrom][]" class="form-control int" placeholder="${PromotionDetailsMessages.messages.order_amount.from_placeholder}" value="${amountFrom}">
                        </td>
                        <td class="order_amount_range_to">
                            <input type="text" name="promotion_order_amount_range[amountTo][]" class="form-control int" placeholder="${PromotionDetailsMessages.messages.order_amount.to_placeholder}" value="${datas.amountTo[index]}">
                        </td>
                        <td class="discountType">
                            <div class="input-group">
                                <input type="text" name="promotion_order_amount_range[amountValue][]" class="form-control int" placeholder="${PromotionDetailsMessages.messages.order_amount.discount_placeholder}" value="${datas.amountValue[index]}">
                                <select name="promotion_order_amount_range[amountType][]" class="form-select discont-type-select" style="flex: 0 0 80px;">
                                    <option value="cash" ${datas.amountType[index] === 'cash' ? 'selected' : ''}>${PromotionDetailsMessages.messages.order_amount.currency}</option>
                                    <option value="percent" ${datas.amountType[index] === 'percent' ? 'selected' : ''}>${PromotionDetailsMessages.messages.order_amount.percent}</option>
                                </select>
                            </div>
                        </td>
                        ${index === 0 ? '<td></td>' : `
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-danger delete-order-amount-range-condition">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        `}
                    </tr>
                `;
            });

            html += `
                </tbody>
            </table>
            `
        } else {
            html = `
                <div class="order_amount_range">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="30%">${PromotionDetailsMessages.messages.order_amount.from}</th>
                                <th width="30%">${PromotionDetailsMessages.messages.order_amount.to}</th>
                                <th width="20%">${PromotionDetailsMessages.messages.order_amount.discount} (%)</th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="order_amount_range_from">
                                    <input type="text" name="promotion_order_amount_range[amountFrom][]" class="form-control int" placeholder="${PromotionDetailsMessages.messages.order_amount.from_placeholder}" value="0">
                                </td>
                                <td class="order_amount_range_to">
                                    <input type="text" name="promotion_order_amount_range[amountTo][]" class="form-control int" placeholder="${PromotionDetailsMessages.messages.order_amount.to_placeholder}" value="0">
                                </td>
                                <td class="discountType">
                                    <div class="input-group">
                                        <input type="text" name="promotion_order_amount_range[amountValue][]" class="form-control int" placeholder="${PromotionDetailsMessages.messages.order_amount.discount_placeholder}" value="0">
                                        <select name="promotion_order_amount_range[amountType][]" class="form-select discont-type-select" style="flex: 0 0 80px;">
                                            <option value="cash">${PromotionDetailsMessages.messages.order_amount.currency}</option>
                                            <option value="percent">${PromotionDetailsMessages.messages.order_amount.percent}</option>
                                        </select>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            `;

        }
        
        html += `
                <button type="button" class="btn btn-sm btn-outline-primary mt-2 add-row-amount-range">
                    <i class="fas fa-plus me-1"></i> ${PromotionDetailsMessages.messages.order_amount.add_condition}
                </button>
        </div>
        `
        Promotion.renderPromotionContainer(html);
        HT.formatNumberInputComma('.int');
    },

    renderPromotionContainer: function(html) {
        $('.promotion-container').html(html);
    },

    addRowAmountRange: function() {
        $(document).on('click', '.add-row-amount-range', function () {
            let inputToFormatted = Promotion.checkBtnJsCondition();
    
            if (!inputToFormatted) {
                return;
            }
    
            let lastInputFrom = $('.order_amount_range')
                .find('tbody tr:last-child')
                .find('.order_amount_range_from input')
                .val()
                .replace(/,/g, '');
            let newFrom = parseInt(lastInputFrom) + 1;
            let newTo = parseInt(inputToFormatted.replace(/,/g, ''));
    
            Promotion.ranges.push({ from: newFrom, to: newTo });
    
            let tdList = [
                { class: 'order_amount_range_from', name: 'promotion_order_amount_range[amountFrom][]', value: Promotion.formatNumberWithCommas(newTo.toString()), attribute: { readonly: false } },
                { class: 'order_amount_range_to', name: 'promotion_order_amount_range[amountTo][]', value: 0, attribute: { readonly: false } }
            ];
    
            let inputFields = tdList.map(item => {
                let readonlyAttr = item.attribute.readonly ? 'readonly' : '';
                return ` 
                    <td class="${item.class}">
                        <input type="text" name="${item.name}" class="form-control int" placeholder="0" value="${item.value}" ${readonlyAttr}>
                    </td>
                `;
            }).join('');
    
            let html = `
                <tr>
                    ${inputFields}
                    <td class="discountType">
                        <div class="input-group">
                            <input type="text" name="promotion_order_amount_range[amountValue][]" class="form-control int" placeholder="0" value="0">
                            <select name="promotion_order_amount_range[amountType][]" class="form-select discont-type-select" style="flex: 0 0 80px;">
                                <option value="vnd">đ</option>
                                <option value="percent">%</option>
                            </select>
                        </div>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-outline-danger delete-order-amount-range-condition">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            `;
            
            $('.order_amount_range table tbody').append(html);
            HT.formatNumberInputComma('.int');
        });
    },

    checkBtnJsCondition: function() {
        let $lastRow = $('.order_amount_range').find('tbody tr:last-child');
        let inputFrom = $lastRow.find('.order_amount_range_from input').val();
        let inputTo = $lastRow.find('.order_amount_range_to input').val();
    
        let cleanInputFrom = inputFrom.replace(/,/g, '');
        let cleanInputTo = inputTo.replace(/,/g, '');
    
        if (cleanInputTo == 0 || cleanInputTo === '') {
            alert(PromotionDetailsMessages.messages.order_amount.invalid_value);
            $lastRow.find('.order_amount_range_to input').val('');
            return false;
        }
    
        if (parseInt(cleanInputTo) < parseInt(cleanInputFrom)) {
            alert(PromotionDetailsMessages.messages.order_amount.value_compare);
            $lastRow.find('.order_amount_range_to input').val('');
            return false; 
        }
    
        if (Promotion.checkBtnConflickRange(parseInt(cleanInputFrom), parseInt(cleanInputTo))) {
            alert(PromotionDetailsMessages.messages.order_amount.range_conflict);
            return false;
        }
    
        return Promotion.formatNumberWithCommas(cleanInputTo);
    },
    
    formatNumberWithCommas: function(number) {
        return number.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    },

    removePromotionContainer: function() {
        $('.promotion-container').empty();
    },

    checkBtnConflickRange: function(newFrom, newTo) {
        for (let i = 0; i < Promotion.ranges.length; i++) {
            let existRange = Promotion.ranges[i];
    
            if (
                (newFrom >= existRange.from && newFrom <= existRange.to) ||
                (newTo >= existRange.from && newTo <= existRange.to) ||
                (newFrom <= existRange.from && newTo >= existRange.to) 
            ) {
                return true;
            }
        }
        return false;
    },

    deleteAmountRangeCondition: function() {
        $(document).on('click', '.delete-order-amount-range-condition', function() {
            let $row = $(this).closest('tr');
            let from = parseInt($row.find('.order_amount_range_from input').val().replace(/,/g, '')) || 0;
            let to = parseInt($row.find('.order_amount_range_to input').val().replace(/,/g, '')) || 0;
    
            Promotion.ranges = Promotion.ranges.filter(range => 
                !(range.from === from && range.to === to)
            );
    
            $row.remove();
    
            let $tableBody = $('.order-amount-range-table tbody');
            let $rows = $tableBody.find('tr');
    
            if ($rows.length <= 1) {
                Promotion.ranges = [];
            } 
        });
    },

    renderProductAndQuantity: function() {
        const productData = JSON.parse(document.getElementById('productData').dataset.products);
        var module_type_selected = $('.preload_select_module_type').val();

        const options = Object.entries(productData).map(([key, val]) => {
            let selected = module_type_selected === key ? 'selected' : '';
            return `<option value="${key}" ${selected}>${val}</option>`;
        }).join('');

        let preloadData = JSON.parse($('.input_product_and_quantity').val()) || {
            quantity: ['1'],
            maxDiscountValue: ['0'],
            discountValue: ['0'],
            discountType: ['cash']
        };

        let html = `
            <div class="product-and-quantity">
                <div class="mb-4">
                    <label for="select-product-and-quantity" class="form-label fw-semibold">${PromotionDetailsMessages.messages.product_quantity.title}</label>
                    <select name="select-product-and-quantity" class="form-control rounded choice-single select-product-and-quantity">
                        <option value="">${PromotionDetailsMessages.messages.product_quantity.select_option}</option>
                        ${options}
                    </select>
                </div>
                <div class="product-and-quantity-table">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="45%">${PromotionDetailsMessages.messages.product_quantity.table.product}</th>
                                <th width="20%">${PromotionDetailsMessages.messages.product_quantity.table.discount_limit}</th>
                                <th width="20%">${PromotionDetailsMessages.messages.product_quantity.table.discount_amount}</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="product-list-container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="product-column product-quantity">
                                                    <div class="row g-2 choose-product-list">
                                                       <div class="product-item select-product d-flex align-items-center justify-content-start ps-3 bg-white rounded w-100" id="find-product">
                                                            <i class="fas fa-plus me-2 text-muted"></i>
                                                            <span class="text-muted fw-semibold">${PromotionDetailsMessages.messages.product_quantity.table.select_product_placeholder}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" name="product_and_quantity[maxDiscountValue]" class="form-control int" placeholder="${PromotionDetailsMessages.messages.product_quantity.table.max_discount_placeholder}" value="${typeof preloadData.maxDiscountValue !== 'undefined' ? preloadData.maxDiscountValue : 0}">
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" name="product_and_quantity[discountValue]" class="form-control int" placeholder="${PromotionDetailsMessages.messages.product_quantity.table.discount_value_placeholder}" value="${typeof preloadData.discountValue !== 'undefined' ? preloadData.discountValue : 0}">
                                        <select name="product_and_quantity[discountType]" class="form-select discont-type-select" style="flex: 0 0 60px;">
                                            <option value="cash" ${preloadData.discountType === 'cash' ? 'selected' : ''}>${PromotionDetailsMessages.messages.product_quantity.table.currency_symbol}</option>
                                            <option value="percent" ${preloadData.discountType === 'percent' ? 'selected' : ''}>${PromotionDetailsMessages.messages.product_quantity.table.percent_symbol}</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        `

        Promotion.renderPromotionContainer(html);
        HT.initializeChoices();
        HT.formatNumberInputComma('.int');
        Promotion.selectProductAndQuantity();
    },

    selectProductAndQuantity: function () {
        const initializeObjectChooses = (modal, objectInput) => {
            const objectChooses = [];
    
            if (modal === 'Product' && Array.isArray(objectInput.name)) {
                objectInput.name.forEach((name, index) => {
                    objectChooses.push({
                        product_id: objectInput.product_id?.[index] || null,
                        variant_uuid: objectInput.variant_uuid?.[index] || null,
                        name: name || ''
                    });
                });
            } else if (modal === 'ProductCatalogue' && Array.isArray(objectInput.name)) {
                objectInput.name.forEach((name, index) => {
                    objectChooses.push({
                        product_catalogue_id: objectInput.product_catalogue_id?.[index] || null,
                        name: name || ''
                    });
                });
            }
    
            return objectChooses;
        };
    
        $(document).on('change', '.select-product-and-quantity', function () {
            const modal = $(this).val();
            $('.data-table').empty();
            $('.data-table-header').empty();
            Promotion.objectChooses = [];
            Promotion.checkEmptyGoodList();
    
            if (modal) {
                Promotion.openAddProductQuantityModal(modal);
            }
        });
    
        const preloadModal = $('.preload_select_module_type').val();
        const preloadObject = JSON.parse($('.input_object').val() || '{}');
    
        if (preloadModal) {
            Promotion.objectChooses = initializeObjectChooses(preloadModal, preloadObject);
            Promotion.openAddProductQuantityModal(preloadModal);
    
            if (preloadModal === 'ProductCatalogue') {
                Promotion.confirmProductCataloguePromotion();
            } else {
                Promotion.confirmProductPromotion();
            }
        }
    },

    checkEmptyGoodList: function() {
        if (Promotion.objectChooses.length === 0) {
            let boxSearchHtml = `
                <div class="product-item select-product d-flex align-items-center justify-content-start ps-3 bg-white rounded w-100" id="find-product">
                    <i class="fas fa-plus me-2 text-muted"></i>
                    <span class="text-muted fw-semibold">${PromotionDetailsMessages.messages.select_product_prompt}</span>
                </div>
            `

            $('.choose-product-list').html(boxSearchHtml)
        }
    },

    openAddProductQuantityModal: function (model) {
        $('.product-quantity')
            .off('click')
            .on('click', function (e) {
                if ($(e.target).closest('.delete-product').length > 0) {
                    return;
                }
    
                e.preventDefault();
                Promotion.loadProduct(HT.currentPage, model);
                $('.store-modal').modal('show');
            });
    },

    checkSelectedProductModel: function () {
        $('.product-quantity').on('click', function(e) {
            if ($(e.target).closest('.delete-product').length > 0) {
                return;
            }

            e.preventDefault();
            let selectedModel = $('.select-product-and-quantity').val();
            if (!selectedModel) {
                alertify.warning(PromotionDetailsMessages.messages.select_product_warning);
                return false;
            }
            return true;
        });
    },

    loadProduct: function(page = 1, model) {
        let dataFilterSend = { 
            page: page, 
            model: model,
        };
    
        $('.filter-data').find("input, select").each(function () {
            let name = $(this).attr("name");
            if (name) {
                dataFilterSend[name] = $(this).val();
            }
        });
    
        $.ajax({
            url: '/ajax/product/loadProductAnimation',
            type: 'GET',
            dataType: 'json',
            data: dataFilterSend,
            delay: 250,
            success: function(response) {
                Promotion.fillToObjectList(response);
            }
        });
    },
    
    fillToObjectList: function(response) {
        const mapping = {
            "Product": Promotion.fillProductToList,
            "ProductCatalogue": Promotion.fillProductCatalogueToList,
        };
    
        if (response.model && typeof mapping[response.model] === 'function') {
            mapping[response.model](response);
        }
    },
    
    fillProductToList: function(response) {
        const tbody = $('.data-table');
        const thead = $('.data-table-header');
        
        thead.html(`
            <tr>
                <th width="50px">
                    <div class="form-check font-size-16">
                        <input class="form-check-input checkStatusProductAll" type="checkbox">
                        <label class="form-check-label"></label>
                    </div>
                </th>
                <th>${PromotionDetailsMessages.messages.product_quantity.product_row.product_name}</th>
                <th class="text-end">${PromotionDetailsMessages.messages.product_quantity.product_row.product_details}</th>
            </tr>
        `);
        
        tbody.empty();
    
        let rows = response.data.data.map(product => {
            const formattedPrice = Promotion.formatPrice(product.price);
            const inventory = product.quantity ?? 0;
            const couldSell = product.quantity ?? 0;
            const isChecked = Promotion.isProductSelected(product.id, product.variant_uuid);
    
            return `
                <tr class="product-row ${isChecked ? 'selected' : ''}" 
                    data-product-id="${product.id}" 
                    data-variant-uuid="${product.variant_uuid}"
                    data-name="${product.variant_name || ''}">
                    <td>
                        <div class="form-check font-size-16">
                            <input name="product-${product.id}" 
                                   value="${product.id}_${product.variant_uuid}" 
                                   ${isChecked ? 'checked' : ''} 
                                   class="form-check-input product-checkbox" 
                                   type="checkbox">
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <img src="${product.image}" alt="${product.variant_name || 'Sản phẩm'}" 
                                     class="rounded avatar-md" onerror="this.src='/images/default-product.png'">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">${product.variant_name || PromotionDetailsMessages.messages.product_quantity.product_row.no_name}</h6>
                                <p class="text-muted mb-0 small">${PromotionDetailsMessages.messages.product_quantity.product_row.sku} ${product.sku || '---'}</p>
                            </div>
                        </div>
                    </td>
                    <td class="text-end">
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-primary">${formattedPrice}₫</span>
                            <div class="d-flex align-items-center justify-content-end small text-muted">
                                <span class="me-2">${PromotionDetailsMessages.messages.product_quantity.product_row.inventory} ${inventory}</span>
                                <span class="me-2">|</span>
                                <span>${PromotionDetailsMessages.messages.product_quantity.product_row.could_sell} ${couldSell}</span>
                            </div>
                        </div>
                    </td>
                </tr>
            `;
        });
    
        tbody.append(rows.join(''));
        Promotion.setupProductSelection();
        Promotion.confirmProductPromotion();
        Promotion.handleCheckAllProducts();
        HT.renderPagination(response);
    },
    
    fillProductCatalogueToList: function(response) {
        const product_catalogues = response.data.data;
        const tbody = $('.data-table');
        const thead = $('.data-table-header');
        
        thead.html(`
            <tr>
                <th width="50px">
                    <div class="form-check font-size-16">
                        <input class="form-check-input checkStatusProductCatalogueAll" type="checkbox">
                        <label class="form-check-label"></label>
                    </div>
                </th>
                <th>${PromotionDetailsMessages.messages.product_quantity.product_catalogue_row.product_catalogue_name}</th>
            </tr>
        `);
        
        tbody.empty();
    
        if (product_catalogues.length) {
            let rows = product_catalogues.map(catalogue => {
                const isChecked = Promotion.isCatalogueSelected(catalogue.id);
                
                return `
                    <tr class="product-row ${isChecked ? 'selected' : ''}" 
                        data-product-catalogue-id="${catalogue.id}" 
                        data-name="${catalogue.name}">
                        <td>
                            <div class="form-check font-size-16">
                                <input class="form-check-input product-checkbox" 
                                       type="checkbox" 
                                       name="product_catalogue-${catalogue.id}" 
                                       value="${catalogue.id}" 
                                       ${isChecked ? 'checked' : ''}>
                            </div>
                        </td>
                        <td>${catalogue.name}</td>
                    </tr>
                `;
            });
    
            tbody.append(rows.join(''));
            Promotion.setupProductCatalogueSelection();
            Promotion.confirmProductCataloguePromotion();
            Promotion.handleCheckAllProductCatalogues();
            HT.renderPagination(response);
        }
    },
    
    isProductSelected: function(productId, variantUuid) {
        return Promotion.objectChooses.some(obj => 
            obj.product_id == productId && obj.variant_uuid == variantUuid
        );
    },
    
    isCatalogueSelected: function(catalogueId) {
        return Promotion.objectChooses.some(obj => 
            obj.product_catalogue_id == catalogueId
        );
    },
    
    setupProductSelection: function() {
        $('.product-row').off('click').on('click', function(e) {
            if ($(e.target).is('input[type=checkbox]')) return;
            
            const $row = $(this);
            const checkbox = $row.find('.product-checkbox');
            const isChecked = !checkbox.prop('checked');
            
            checkbox.prop('checked', isChecked);
            $row.toggleClass('selected', isChecked);
            
            const productData = {
                product_id: $row.data('product-id'),
                variant_uuid: $row.data('variant-uuid'),
                name: $row.data('name')
            };
            
            if (isChecked) {
                Promotion.objectChooses.push(productData);
            } else {
                Promotion.objectChooses = Promotion.objectChooses.filter(obj =>
                    !(obj.product_id == productData.product_id && 
                      obj.variant_uuid == productData.variant_uuid)
                );
            }

        });
        
        $('.product-checkbox').off('change').on('change', function() {
            $(this).closest('.product-row').toggleClass('selected', this.checked);
        });
    },
    
    setupProductCatalogueSelection: function() {
        $('.product-row').off('click').on('click', function(e) {
            if ($(e.target).is('input[type=checkbox]')) return;
            
            const $row = $(this);
            const checkbox = $row.find('.product-checkbox');
            const isChecked = !checkbox.prop('checked');
            
            checkbox.prop('checked', isChecked);
            $row.toggleClass('selected', isChecked);
            
            const catalogueData = {
                product_catalogue_id: $row.data('product-catalogue-id'),
                name: $row.data('name')
            };
            
            if (isChecked) {
                Promotion.objectChooses.push(catalogueData);
            } else {
                Promotion.objectChooses = Promotion.objectChooses.filter(obj =>
                    obj.product_catalogue_id !== catalogueData.product_catalogue_id
                );
            }
        });
        
        $('.product-checkbox').off('change').on('change', function() {
            $(this).closest('.product-row').toggleClass('selected', this.checked);
        });
    },

    confirmProductPromotion: function() {
        const renderProductList = () => {
            const html = Promotion.objectChooses.map(product => `
                <div class="col-6">
                    <div class="product-item d-flex align-items-center justify-content-between p-2 bg-light rounded">
                        <span class="product-name text-truncate">${product.name}</span>
                        <button type="button" class="btn btn-sm btn-icon btn-outline-danger delete-product">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="hidden">
                            <input type="hidden" name="object[product_id][]" value="${product.product_id}">
                            <input type="hidden" name="object[variant_uuid][]" value="${product.variant_uuid || ''}">
                            <input type="hidden" name="object[name][]" value="${product.name}">
                        </div>
                    </div>
                </div>
            `).join('');
    
            const additionalHtml = `
                <div class="col-6">
                    <div class="product-item d-flex align-items-center justify-content-between p-2 rounded">
                        <span class="product-name text-truncate">${PromotionDetailsMessages.messages.select_product_prompt}</span>
                    </div>
                </div>
            `;
    
            $('.choose-product-list').html(html + additionalHtml);
        };
    
        $(document).on('click', '.confirm-product-promotion', function (e) {
            e.preventDefault();
    
            if (Promotion.objectChooses.length === 0) {
                alert(PromotionDetailsMessages.messages.select_at_least_one_product);
            } else {
                renderProductList();
                $('#find-product').remove();
                $('.store-modal').modal('hide');
            }
            
        });
        
        if (Promotion.objectChooses.length > 0) {
            renderProductList();
        }
        Promotion.deleteProductItems();
    },

    confirmProductCataloguePromotion: function() {
        const renderProductCatalogueList = () => {
            const html = Promotion.objectChooses.map(product => `
                <div class="col-6">
                    <div class="product-item d-flex align-items-center justify-content-between p-2 bg-light rounded">
                        <span class="product-name text-truncate">${product.name}</span>
                        <button type="button" class="btn btn-sm btn-icon btn-outline-danger delete-product">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="hidden">
                            <input type="hidden" name="object[product_catalogue_id][]" value="${product.product_catalogue_id}">
                            <input type="hidden" name="object[name][]" value="${product.name}">
                        </div>
                    </div>
                </div>
            `).join('');
    
            const additionalHtml = `
                <div class="col-6">
                    <div class="product-item d-flex align-items-center justify-content-between p-2 rounded">
                        <span class="product-name text-truncate">${PromotionDetailsMessages.messages.select_product_prompt}</span>
                    </div>
                </div>
            `;
    
            $('.choose-product-list').html(html + additionalHtml);
        };
    
        $(document).on('click', '.confirm-product-promotion', function (e) {
            e.preventDefault();
    
            if (Promotion.objectChooses.length === 0) {
                alert(PromotionDetailsMessages.messages.select_at_least_one_product);
            } else {
                renderProductCatalogueList();
                $('#find-product').remove();
                $('.store-modal').modal('hide');
            }
            
        });
        
        if (Promotion.objectChooses.length > 0) {
            renderProductCatalogueList();
        }
        Promotion.deleteProductCatalogueItems();
    },

    deleteProductItems: function() {
        $(document).off('click', '.delete-product').on('click', '.delete-product', function (e) {
            e.preventDefault();
            e.stopPropagation();
    
            let _this = $(this);
            let productId = _this.closest('.product-item').find('input[name="object[product_id][]"]').val();
            let productVariantId = _this.closest('.product-item').find('input[name="object[variant_uuid][]"]').val();
    
            Promotion.objectChooses = Promotion.objectChooses.filter(obj => 
                obj.product_id != productId || obj.variant_uuid != productVariantId
            );
    
            _this.closest('.col-6').remove();
    
            Promotion.checkEmptyGoodList();
        });
    },

    deleteProductCatalogueItems: function() {
        $(document).off('click', '.delete-product').on('click', '.delete-product', function (e) {
            e.preventDefault();
            e.stopPropagation();
    
            let _this = $(this);
            let productCatalogueId = _this.closest('.product-item').find('input[name="object[product_catalogue_id][]"]').val();
    
            Promotion.objectChooses = Promotion.objectChooses.filter(obj => 
                obj.product_catalogue_id != productCatalogueId 
            );
    
            _this.closest('.col-6').remove();
    
            Promotion.checkEmptyGoodList();
        });
    },

    handleCheckAllProducts: function() {
        $('.checkStatusProductAll').off('change').on('change', function () {
            const isChecked = $(this).is(':checked');

            $('.product-checkbox').each(function () {
                $(this).prop('checked', isChecked);
                const $row = $(this).closest('.product-row');
                $row.toggleClass('selected', isChecked);

                const productData = {
                    product_id: $row.data('product-id'),
                    variant_uuid: $row.data('variant-uuid'),
                    name: $row.data('name')
                };

                if (isChecked) {
                    Promotion.objectChooses.push(productData);
                }
            });
        });
    },

    handleCheckAllProductCatalogues: function() {
        $('.checkStatusProductCatalogueAll').off('change').on('change', function () {
            const isChecked = $(this).is(':checked');

            $('.product-checkbox').each(function () {
                $(this).prop('checked', isChecked);
                const $row = $(this).closest('.product-row');
                $row.toggleClass('selected', isChecked);

                const catalogueData = {
                    product_catalogue_id: $row.data('product-catalogue-id'),
                    name: $row.data('name')
                };

                if (isChecked) {
                    Promotion.objectChooses.push(catalogueData);
                }
            });
        });
    },

    submitFormData: function (url) {
        $(".ckeditor-classic").each(function () {
            let editorInstance = this.ckEditorInstance || ClassicEditor.instances[this.id];
            if (editorInstance) {
                $(this).val(editorInstance.getData());
            }
        });
    
        let formElement = document.getElementById('form-store-modal');
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
                    localStorage.setItem("promotionMessage", response.message);
                    window.location.href = "/promotion/index";
                } else {
                    alertify.error(response.message);
                }
            },
            error: function (xhr) {
                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    HT.displayValidationErrors(xhr.responseJSON.errors);
                    if (xhr.responseJSON.errors.method) {
                        alertify.error(xhr.responseJSON.errors.method[0])
                    }
                } else {
                    alertify.error(`${Config.confirmMessages.generalError}`);
                }
            },
        });
    },

    bindStoreAndUpdateEntityHandler: function () {
        $(document).on('click', '.submitButton', function (e) {
            e.preventDefault();
            HT.clearValidationErrors();

            let id = $('#form-store-modal').attr('data-id');
            let url = id ? `/ajax/promotion/update/${id}` : '/ajax/promotion/create';
            Promotion.submitFormData(url);
        });
    },

    sendDataFilter: function(page = 1) {
        if (!window.location.pathname.includes('/promotion/index')) {
            return;
        }
    
        let dataFilterSend = { page: page };
    
        $('.filter-data').find("input, select").each(function() {
            let name = $(this).attr("name");
            if (name) {
                dataFilterSend[name] = $(this).val();
            }
        });
    
        $.ajax({
            url: '/ajax/promotion/filter',
            type: 'GET',
            data: dataFilterSend,
            dataType: 'json',
            success: function(response) {
                const tbody = $('.data-table');
                tbody.empty();
                console.log(response.data);
                
                response.data.data.forEach(item => {
                    const startDate = item.start_date ? moment(item.start_date).format('DD/MM/YYYY HH:mm') : '';
                    const currentDate = moment();

                    let discountDisplay = '';
                    if (item.method === 'order_amount_range') {
                        discountDisplay = `<a href="${Config.baseUrl}/promotion/edit/${item.id}" class="text-white view-details">${PromotionDetailsMessages.messages.promotion_table_details.view_details}</a>`;
                    } else {
                        if (item.discountType === 'percent') {
                            discountDisplay = `${item.discountValue}%`;
                            if (item.maxDiscountValue) {
                                discountDisplay += ` (${PromotionDetailsMessages.messages.promotion_table_details.max_discount} ${Promotion.formatPrice(item.maxDiscountValue)}đ)`;
                            }
                        } else if (item.discountType === 'cash') {
                            discountDisplay = `${Promotion.formatPrice(item.discountValue)}đ`;
                        } else {
                            discountDisplay = `${PromotionDetailsMessages.messages.promotion_table_details.view_details}`;
                        }
                    }
                    let endDateDisplay = '';
                    
                    if (item.never_end_date) {
                        endDateDisplay = `${PromotionDetailsMessages.messages.promotion_table_details.no_expiry}`;
                    } else if (item.end_date) {
                        const endDate = moment(item.end_date);
                        endDateDisplay = endDate.isBefore(currentDate) 
                            ? `<span class="text-danger">${PromotionDetailsMessages.messages.promotion_table_details.expired}</span>` 
                            : endDate.format('DD/MM/YYYY HH:mm');
                    }
    
                    tbody.append(`
                        <tr>
                            <td style="vertical-align: middle;">
                                <div class="form-check font-size-16 d-flex justify-content-center">
                                    <input data-id="${item.id}" class="form-check-input publish-checkAll" type="checkbox" id="listcheck${item.id}">
                                    <label class="form-check-label" for="listcheck${item.id}"></label>
                                </div>
                            </td>
                            <td style="vertical-align: middle;">
                                <div class="d-flex flex-column">
                                    <span class="fw-semibold">${item.name}</span>
                                    <small class="text-muted">${item.code}</small>
                                </div>
                            </td>
                            <td style="vertical-align: middle;">
                                <span class="badge bg-primary py-2 px-3">${discountDisplay}</span>
                            </td>
                            <td style="vertical-align: middle;">
                                <small class="text-truncate d-block" style="max-width: 200px;" title="${item.description}">
                                    ${item.description}
                                </small>
                            </td>
                            <td style="vertical-align: middle;">
                                <span class="text-nowrap">${startDate}</span>
                            </td>
                            <td style="vertical-align: middle;">
                                ${endDateDisplay}
                            </td>
                            <td>
                                <input type="checkbox" id="switch${item.id}" data-field="publish" data-id="${item.id}" class="publish-check" switch="none" ${item.publish == 2 ? 'checked' : ''}>
                                <label for="switch${item.id}" data-on-label="On" data-off-label="Off" class="mb-0"></label>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <p class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                    </p>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="${Config.baseUrl}/promotion/edit/${item.id}" class="dropdown-item edit-button-modal">
                                                <i class="mdi mdi-pencil font-size-16 text-success me-1"></i> ${Config.actionTextButton.edit}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" data-id="${item.id}" class="dropdown-item delete-btn">
                                                <i class="mdi mdi-trash-can font-size-16 text-danger me-1"></i> ${Config.actionTextButton.delete}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    `);
                });
    
                HT.openChangeStatus();
                HT.handleDeleteRequest(".delete-btn", "/ajax/promotion/delete", Promotion);
                HT.renderPagination(response);
                
                $('[title]').tooltip({
                    placement: 'top',
                    trigger: 'hover'
                });
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    alertify.error('Validation Error: ' + xhr.responseText);
                } else {
                    alertify.error('AJAX Error: ' + xhr.responseText);
                }
            }
        });
    },
    
    formatPrice: function(price) {
        if (!price) return '0';
        return parseFloat(price).toLocaleString('vi-VN', {
            maximumFractionDigits: 0
        });
    },

    attachPaginationEvent: function () {
        $(document).on('click', '.pagination .page-link', function (e) {
            e.preventDefault();

            let page = $(this).data('page');
            HT.currentPage = page;
            if (!page) return;

            Promotion.sendDataFilter(HT.currentPage);
            if ($('.select-product-and-quantity')) {
                let modelFromSelect = $('.select-product-and-quantity').val();
                let model = modelFromSelect ? modelFromSelect : 'Product';
                Promotion.loadProduct(HT.currentPage, model)
            }
        });
    },

    attachFilterEvent: function () {
        $(".filter-data").find("input, select").on("input change", function () {
            clearTimeout(HT.filterTimeout);

            HT.filterTimeout = setTimeout(() => {
                Promotion.sendDataFilter();
            }, 500);

            if ($('.select-product-and-quantity')) {
                let modelFromSelect = $('.select-product-and-quantity').val();
                let model = modelFromSelect ? modelFromSelect : 'Product';
                Promotion.loadProduct(HT.currentPage, model)
            }
        });
    },

    setupDatetimePickerBasic: function () {
        flatpickr(".datepicker-start", {
            enableTime: true,
            dateFormat: "d/m/Y H:i:S",
            enableSeconds: true,
            time_24hr: true,
            allowInput: true,
            onReady: function (selectedDates, dateStr, instance) {
                setTimeout(function () {
                    let yearInput = instance.calendarContainer.querySelector(".numInput.cur-year");
                    if (yearInput) {
                        yearInput.removeAttribute("tabindex");
                    }
                }, 10);
            }
        });
    
        flatpickr(".datepicker-end", {
            enableTime: true,
            dateFormat: "d/m/Y H:i:S",
            enableSeconds: true,
            time_24hr: true,
            allowInput: true,
            onReady: function (selectedDates, dateStr, instance) {
                setTimeout(function () {
                    let yearInput = instance.calendarContainer.querySelector(".numInput.cur-year");
                    if (yearInput) {
                        yearInput.removeAttribute("tabindex");
                    }
                }, 10);
            }
        });
    },

    initializeMultiConditonChoices: function () {
        $(".choice-multi-condition").each(function () {
            const $select = $(this);
    
            if (!$select.data("choicesInstance")) {
                const instance = new Choices(this, {
                    removeItemButton: true
                });
    
                this.addEventListener('removeItem', function (event) {
                    const removedValue = event.detail.value;    
                    $(`.wrapper-condition-item[data-value="${removedValue}"]`).remove();
                });
    
                $select.data("choicesInstance", instance);
            }
        });
    },

    formatPrice: function(price) {
        return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
};

$(document).ready(function () {
    Promotion.promotionNeverEnd();
    Promotion.promotionSource();
    Promotion.chooseCustomerCondition();
    Promotion.chooseApplyItem();
    Promotion.renderOrderRangeConditionContainer();
    Promotion.addRowAmountRange();
    Promotion.deleteAmountRangeCondition();
    Promotion.initializeMultiConditonChoices();
    Promotion.selectProductAndQuantity();

    Promotion.bindStoreAndUpdateEntityHandler();
    Promotion.sendDataFilter();
    Promotion.attachFilterEvent();
    Promotion.attachPaginationEvent();
    Promotion.setupDatetimePickerBasic();

    HT.showStoredMessage("promotionMessage", "/promotion/index");
    HT.attachFilterEvent(Promotion);
    HT.initializeMultiChoices();
    HT.formatNumberInputComma('.int');
});