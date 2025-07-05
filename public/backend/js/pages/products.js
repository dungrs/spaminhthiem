const Product = {
    setupProductVariant: function() {
        if ($('.turnOnVariant').length) {
            $(document).on('click', '.turnOnVariant', function() {
                let _this = $(this);
                let price = $('input[name="price"]').val();
                let code = $('input[name="code"]').val();

                if (code == '' || price == '') {
                    alertify.error(`${ProductMessages.messages.product_variant_required}`);
                    return false;
                }

                if (_this.siblings("input:checked").length == 0) {
                    $('.variant-wrapper').removeClass('hidden');
                    let html = Product.renderVariantItem();
                    $('.variant-body').append(html);
                    HT.initializeChoices();
                    HT.initializeMultiChoices();
                } else {
                    $('.variant-wrapper').addClass('hidden');
                }
            })
        }
    },

    addVariant: function() {
        let currentVariantCount = $('.variant-item').length;
        let maxVariant = (typeof attributeCatalogues !== 'undefined' && attributeCatalogues && attributeCatalogues.length) ? attributeCatalogues.length : 0;

        if (currentVariantCount >= maxVariant) {
            $('.add-variant').remove();
        } else {
            if ($('.add-variant').length === 0) {
                $('.variant-foot').html(`
                    <button type="button" class="add-variant btn btn-soft-primary w-md text-truncate">Thêm phiên bản mới</button>
                `);
            }
        }

        $(document).off('click', '.add-variant').on('click', '.add-variant', function() {
            let html = Product.renderVariantItem();
            $('.variant-body').append(html);
            HT.initializeChoices();
            HT.initializeMultiChoices();
            Product.disabledAttributeCatalogueChoose();
            Product.createProductVariant();

            currentVariantCount = $('.variant-item').length;

            if (currentVariantCount >= maxVariant) {
                $('.add-variant').remove();
            } else {
                if ($('.add-variant').length === 0) {
                    $('.variant-foot').html(`
                        <button type="button" class="add-variant btn btn-soft-primary w-md text-truncate">Thêm phiên bản mới</button>
                    `);
                }
            }
        });
    },
    
    renderVariantItem: function() {
        let attributeCatalogueList = attributeCatalogues;
        let attributeCatalogueHtml = '';
        
        for (let i = 0; i < attributeCatalogueList.length; i++) {
            attributeCatalogueHtml += `
                <option value="${attributeCatalogueList[i].id}">${attributeCatalogueList[i].name}</option>
            `;
        }
    
        let html = `
            <div class="row mb-2 variant-item">
                <div class="col-lg-4">
                    <div class="attribute-catalogue">
                        <div class="mb-2">
                            <select class="form-control rounded choice-single choose-attribute" name="attributeCatalogue[]">
                                <option value="">${ProductMessages.messages.choose_attribute_group}</option>
                                ${attributeCatalogueHtml}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <select class="form-control choice-multi" name="attribute[]" disabled multiple>
                        <option value="">${ProductMessages.messages.choose_attribute_value}</option>
                    </select>
                </div>
                <div class="col-lg-1">
                    <button type="button" class="remove-attribute btn btn-danger">
                        <i class="bx bx-trash"></i>
                    </button>
                </div>
            </div>
        `;
        
        Product.chooseVariantGroup();
        return html;
    },

    chooseVariantGroup: function () {
        $(document).on('change', '.choose-attribute', function () {
            let _this = $(this);
            let attributeCatalogueId = _this.val();
            let container = _this.closest('.col-lg-4').siblings('.col-lg-7');
            if (attributeCatalogueId != 0) {
                let selectHTML = Product.selectVariant(attributeCatalogueId);
                container.html(selectHTML);
                let select = container.find('.selectVariant');
                let instance = new Choices(select[0], {
                    removeItemButton: true
                });
                select.data('choicesInstance', instance);
                Product.getAttribute(select);
            } else {
                container.html(`
                    <select class="form-control choice-multi" name="attribute[${attributeCatalogueId}]" disabled multiple>
                        <option value="">${ProductMessages.messages.choose_attribute_value}</option>
                    </select>
                `);
            }
        });
    },

    selectVariant: function(attributeCatalogueId) {
        return `
            <select class="form-control choice-multi selectVariant variant-${attributeCatalogueId}" 
                    data-catId="${attributeCatalogueId}" 
                    name="attribute[${attributeCatalogueId}][]" multiple
            >
                <option value="">${ProductMessages.messages.choose_attribute_value}</option>
            </select>
        `
    },

    getAttribute: function (object) {
        let formData = {
            'attributeCatalogueId': object.attr('data-catId')
        };
    
        $.ajax({
            url: '/ajax/attribute/getAttribute',
            type: 'GET',
            data: formData,
            dataType: 'json',
            success: function (response) {
                let attributes = [];
                response.data.forEach(attribute => {
                    attributes.push({ value: attribute.id, label: attribute.name });
                });
    
                let choicesInstance = object.data("choicesInstance");
    
                if (choicesInstance) {
                    choicesInstance.setChoices(attributes, 'value', 'label', true);
                } else {
                    // console.warn("Choices chưa được khởi tạo!", object);
                }
            },
    
            error: function (xhr) {
                alertify.error(`${Config.confirmMessages.generalError}`);
            },
        });
    },
    
    removeAttribute: function() {
        if ($('.remove-attribute')) {
            $(document).on('click', '.remove-attribute', function() {
                let _this = $(this);
                _this.closest('.variant-item').remove();
                HT.initializeChoices();
                HT.initializeMultiChoices();
                Product.disabledAttributeCatalogueChoose();
                Product.prepareProductVariantData();

                let currentVariantCount = $('.variant-item').length;
                let maxAttributes = attributeCatalogues.length;
                if (currentVariantCount < maxAttributes) {
                    if ($('.add-variant').length === 0) {
                        $('.variant-foot').html(`
                            <button type="button" class="add-variant btn btn-soft-primary w-md text-truncate">${ProductMessages.messages.add_variant_button}</button>
                        `);
                    }
                }
            });
        }
    },

    disabledAttributeCatalogueChoose: function() {
        $(document).on('change', '.choose-attribute', function() {
            HT.initializeChoices();
            HT.initializeMultiChoices();
            Product.updateSelectOption();
            Product.prepareProductVariantData();
        });
        Product.updateSelectOption();
    },
    
    updateSelectOption: function() {
        let selectedValues = $('.choose-attribute').map(function() {
            return $(this).val();
        }).get();

        let options = [];
    
        $('.choose-attribute').each(function(index) {
            let select = $(this);
            let currentValue = select.val();
            let usedValues = selectedValues.slice(0, index);
            let selectOptions = [];
    
            attributeCatalogues.forEach(attribute => {
                let attrId = String(attribute.id);
                if (!usedValues.includes(attrId) || attrId === currentValue) {
                    selectOptions.push({ value: attribute.id, label: attribute.name });
                }
            });
    
            if (selectOptions.length > 0) {
                options = selectOptions;
                updated = true;
            }
        });
    
        $('.choose-attribute').each(function() {
            let select = $(this);
            let choicesInstance = select.data("choicesInstance");
            choicesInstance.setChoices(options, 'value', 'label', true);
            choicesInstance.setChoiceByValue(select.val());
        })
    },

    createProductVariant: function() {
        $(document).on('change', '.selectVariant', function() {
            Product.prepareProductVariantData();
        })
    },

    prepareProductVariantData: function() {
        let attributes = [];
        let variants = [];
        let attributeTitle = []

        $('.variant-item').each(function() {
            let _this = $(this);
            let attr = [];
            let attrVariant = [];
            let attributeCatalogueId = _this.find('.choose-attribute').val();
            let optionText = _this.find('.choose-attribute option:selected').text();
            let attributeInstance = $(`.variant-${attributeCatalogueId}`).data('choicesInstance');
            let attribute =  attributeInstance.getValue();

            for (let i = 0; i < attribute.length; i++) {
                let item = {};
                let itemVariant = {};
                item[optionText] = attribute[i].label;
                itemVariant[attributeCatalogueId] = attribute[i].value;
                attr.push(item);
                attrVariant.push(itemVariant);
            }

            attributes.push(attr)
            attributeTitle.push(optionText)
            variants.push(attrVariant)
        });


        if (attributes.length === 0 || variants.length === 0) {
            Product.createTableHeader([]);
            return { attributes: [], variants: [], attributeTitle: [] };
        }

        
        attributes = attributes.reduce(
            (a, b) => a.flatMap(d => b.map(e => ({ ...d, ...e })))
        );
        
        variants = variants.reduce(
            (a, b) => a.flatMap(d => b.map(e => ({ ...d, ...e })))
        );
        
        Product.createTableHeader(attributeTitle);

        let trClass = [];
        attributes.forEach((item, index) => {
            let row = Product.createVariantRow(item, variants[index])
            let classModified = 'tr-variant-' + Object.values(variants[index]).join(', ').replace(/, /g, '-')
            trClass.push(classModified)

            if (!$('.table.variantTable tbody tr').hasClass(classModified)) {
                $('.table.variantTable tbody').append(row)
            }
        })

        $('table.variantTable tbody tr').each(function() {
            const $row = $(this)
            const rowClasses = $row.attr('class')
            if (rowClasses) {
                const rowClassesArray = rowClasses.split(' ')
                let shouldRemove = false;
                rowClassesArray.forEach(rowClass => {
                    if (rowClass == 'variant-row') {
                        return;
                    } else if (!trClass.includes(rowClass)) {
                        shouldRemove = true;
                    }
                })

                if (shouldRemove) {
                    $row.remove();
                }
            }
        })
    },

    createTableHeader: function(attributeTitle) {
        let thead = $('table.variantTable thead');
        let tbody = $('table.variantTable tbody');
    
        if (attributeTitle.length > 0) {
            let attributeTitleHtml = attributeTitle.map(title => `<td>${title}</td>`).join('');
    
            let row = `
                <tr>
                    <td>Hình ảnh</td>
                    ${attributeTitleHtml}
                    <td>Số lượng</td>
                    <td>Giá tiền</td>
                    <td>SKU</td>
                </tr>
            `;
    
            thead.html(row);
        } else {
            thead.html('');
            tbody.html('');
        }
    },

    createVariantRow: function(attributeItem, variantItem) {
        if (!attributeItem || typeof attributeItem !== 'object' || Object.keys(attributeItem).length === 0) {
            return '';
        }
    
        const attributeValues = Object.values(attributeItem);
        const variantValues = Object.values(variantItem);
        const attributeString = attributeValues.join(', ');
        const attributeIdString = variantValues.join(', ');
        const classModified = attributeIdString.replace(/, /g, '-');
    
        let attributeTd = attributeValues.map(value => `<td class="align-middle">${value}</td>`).join('');
    
        let mainPrice = $('input[name=price]').val() || '';
        let mainSKU = $('input[name=code]').val() || '';
    
        let attributesHtml = `
            <tr class="variant-row tr-variant-${classModified}" style="cursor: pointer">
                <td>
                    <img class="rounded imageVariant avatar" src="http://127.0.0.1:8000/backend/images/no-image.jpg" alt="Image">
                </td>
                ${attributeTd}
                <td class="align-middle td_quantity">-</td>
                <td class="align-middle td_price">${mainPrice}</td>
                <td class="align-middle td_sku">${mainSKU}-${classModified}</td>
                <td class="align-middle hidden td-variant">
                    <input type="text" name="variant[quantity][]" class="variant_quantity">
                    <input type="text" name="variant[sku][]" class="variant_sku" value="${mainSKU}-${classModified}">
                    <input type="text" name="variant[price][]" class="variant_price" value="${mainPrice}">
                    <input type="text" name="variant[barcode][]" class="variant_barcode">
                    <input type="text" name="variant[file_name][]" class="variant_filename">
                    <input type="text" name="variant[file_url][]" class="variant_fileurl">
                    <input type="text" name="variant[album][]" class="variant_album">
                    <input type="text" name="productVariant[name][]" value="${attributeString}">
                    <input type="text" name="productVariant[id][]" value="${attributeIdString}">
                </td>
            </tr>
        `;
    
        return attributesHtml;
    },

    updateVariant: function() {
        $(document).on('click', '.variant-row', function() {
            let _this = $(this);
            let variantData = {};
            
            _this.find(".td-variant input[type=text][class^='variant_']").each(function() {
                let className = $(this).attr('class')
                variantData[className] = $(this).val();
            });

            let updateVariantBox = Product.updateVariantHtml(variantData);
            Product.initToggleSwitchInput('#switchQuantity', ['.variant_quantity_disabled']);
            Product.initToggleSwitchInput('#switchFile', ['.variant_filename_disabled', '.variant_fileurl_disabled']);

            if ($('.updateVariantTr').length == 0) {
                _this.after(updateVariantBox);
                Product.variantCancelUpdate();
                HT.formatNumberInputComma('.int');
                Finder.bindUploadPictureEvent();
                Finder.enableSortable();
                Finder.deleteImage();
            }
        })
    },

    updateVariantHtml: function(variantData) {
        let albumVariant = variantData.variant_album.split(',')
        let variantAlbumItem = Product.variantAlbumList(albumVariant);

        let html = `
            <tr class="updateVariantTr">
                <td colspan="999" class="p-0">
                    <div class="updateVariant">
                        <div class="card mb-0 rounded-0">
                            <div class="card-header text-white">
                                <h6 class="my-0 text-primary">${ProductMessages.messages.update_variant_info}</h6>
                            </div>
                            <div class="card-body">
                                <div class="click-to-upload ${albumVariant[0] !== '' ? 'hidden' : ''}">
                                    <div class="icon">
                                        <a href="" class="upload-picture" data-name="variant_album[]">
                                            <i class="display-4 text-muted mdi mdi-cloud-upload"></i>
                                        </a>
                                    </div>
                                    <h5 class="mt-2">${Config.albumMessages.upload_placeholder}</h5>
                                </div>

                                <div data-name="variant_album[]" class="upload-list upload-picture ${variantAlbumItem.length > 0 ? '' : 'hidden'}">
                                    <ul id="sortable" class="clearfix data-album sortui ui-sortable">
                                        ${variantAlbumItem}
                                    </ul>
                                </div>

                                <div class="row my-3">
                                    <div class="my-2 d-flex justify-content-between">
                                        <h6 class="">${ProductMessages.messages.stock_info}</h6>
                                        <div class="me-3">
                                            <input type="checkbox" id="switchQuantity" switch="none" ${variantData.variant_quantity ? 'checked' : ''}>
                                            <label for="switchQuantity" data-on-label="On" data-off-label="Off" class="mb-0"></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="variant_quantity" class="form-label text-primary">${ProductMessages.messages.quantity}</label>
                                            <input type="text" value="${variantData.variant_quantity}" ${variantData.variant_quantity ? '' : 'disabled'} class="form-control variant_quantity variant_quantity_disabled int" name="variant_quantity" placeholder="${ProductMessages.messages.enter_quantity}">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="variant_sku" class="form-label text-primary">${ProductMessages.messages.sku}</label>
                                            <input type="text" value="${variantData.variant_sku}" class="form-control variant_sku" name="variant_sku" placeholder="${ProductMessages.messages.enter_sku}">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="variant_price" class="form-label text-primary">${ProductMessages.messages.price}</label>
                                            <input type="text" value="${variantData.variant_price}" class="form-control variant_price int" name="variant_price" placeholder="${ProductMessages.messages.enter_price}">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="variant_barcode" class="form-label text-primary">${ProductMessages.messages.barcode}</label>
                                            <input type="text" value="${variantData.variant_barcode}" class="form-control variant_barcode" name="variant_barcode" placeholder="${ProductMessages.messages.enter_barcode}">
                                        </div>
                                    </div>
                                </div>
                                
                                <hr/>
                                
                                <div class="row mt-4">
                                    <div class="mb-2 d-flex justify-content-between">
                                        <h6 class="">${ProductMessages.messages.file_management}</h6>
                                        <div class="me-3">
                                            <input type="checkbox" id="switchFile" ${variantData.variant_filename == '' && variantData.variant_fileurl == '' ? '' : 'checked'} switch="none">
                                            <label for="switchFile" data-on-label="On" data-off-label="Off" class="mb-0"></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="variant_filename" class="form-label text-primary">${ProductMessages.messages.file_name}</label>
                                            <input type="text" ${variantData.variant_filename == '' && variantData.variant_fileurl == '' ? 'disabled' : ''} value="${variantData.variant_filename}" class="form-control variant_filename variant_filename_disabled" name="variant_filename" placeholder="${ProductMessages.messages.enter_file_name}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="variant_url" class="form-label text-primary">${ProductMessages.messages.file_url}</label>
                                            <input type="text" ${variantData.variant_filename == '' && variantData.variant_fileurl == '' ? 'disabled' : ''} value="${variantData.variant_fileurl}" class="form-control variant_fileurl variant_fileurl_disabled" name="variant_fileurl" placeholder="${ProductMessages.messages.enter_file_url}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row my-2 me-2">
                                    <div class="col text-end">
                                        <button class="cancleUpdate btn btn-danger me-2"><i class="bx bx-x me-1"></i>${Config.actionTextButton.cancel}</button>
                                        <button class="saveUpdateVariant btn btn-info"><i class="bx bx-file me-1"></i>${Config.actionTextButton.save}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        `;
        return html;
    },

    initToggleSwitchInput: function(checkboxSelector, inputSelectors) {
        function toggleInputState() {
            const isChecked = $(checkboxSelector).is(':checked');
            inputSelectors.forEach(selector => {
                $(selector).prop('disabled', !isChecked);
            });
        }
    
        toggleInputState();
    
        $(document).on('change', checkboxSelector, function () {
            toggleInputState();
        });
    },

    variantCancelUpdate: function() {
        $(document).on('click', '.cancleUpdate', function() {
            $('.updateVariantTr').remove();
        })
    },

    variantSaveUpdate: function() {
        $(document).on('click', '.saveUpdateVariant', function(e) {
            e.preventDefault();
            let variant = {
                'quantity' : $('input[name=variant_quantity]').val(),
                'sku' : $('input[name=variant_sku]').val(),
                'price' : $('input[name=variant_price]').val(),
                'barcode' : $('input[name=variant_barcode]').val(),
                'filename' : $('input[name=variant_filename]').val(),
                'fileurl' : $('input[name=variant_fileurl]').val(),
                'album' : $("input[name='variant_album[]']").map(function() {
                    return $(this).val()
                }).get(),
            }

            $.each(variant, function(index, value) {
                $('.updateVariantTr').prev().find('.variant_' + index).val(value)
            });

            Product.previewVariantTr(variant)
            $('.updateVariantTr').remove();
        })
    },

    previewVariantTr: function(variant) {
        let option = {
            'quantity': variant.quantity,
            'price': variant.price,
            'sku': variant.sku,
        }

        $.each(option, function(index, value) {
            $('.updateVariantTr').prev().find('.td_' + index).html(value);
        })

        $('.updateVariantTr').prev().find('.imageVariant').attr('src', variant.album[0]) ;
    },

    variantAlbumList: function(album) {
        let html = ''
        if (album.length) {
            for(let i = 0; i < album.length; i++) {
                if (album[0] !== '') {
                    html += `
                        <li class="ui-state-default">
                            <div class="thumb">
                                <span class="span image img-scaledown">
                                    <img src="${album[i]}" alt="${album[i]}">
                                    <input type="hidden" name="variant_album[]" value="${album[i]}">
                                </span>
                                <button type="button" class="delete-image"><i class="bx bx-trash"></i></button>
                            </div>
                        </li>
                    `
                }
            }
        }
        return html;
    },

    setupMultiSelect: function(callback) {
        if ($('.selectVariant').length) {
            let count = $('.selectVariant').length;
    
            $('.selectVariant').each(function() {
                let _this = $(this);
                let attributeCatalogueId = _this.attr('data-catid');
                let language_id = $('#form-store-modal').attr('data-language-id') ?? 1;
    
                let choiceInstance = _this.data('choicesInstance');
                if (!choiceInstance) {
                    choiceInstance = new Choices(_this[0], {
                        removeItemButton: true,
                        shouldSort: false
                    });
                    _this.data('choicesInstance', choiceInstance);
                } else {
                    choiceInstance.clearChoices();
                }
    
                if (attributes != '') {
                    $.get(`/ajax/attribute/loadAttribute/${language_id}`, {
                        attribute: attributes,
                        attributeCatalogueId: attributeCatalogueId
                    }, function(json) {
                        if (json.data && Array.isArray(json.data)) {
                            const choices = json.data.map(item => ({
                                value: item.id,
                                label: item.name,
                                selected: true,
                                disabled: false
                            }));
    
                            choiceInstance.setChoices(choices, 'value', 'label', true);
    
                            setTimeout(() => {
                                _this.trigger('change');
    
                                if (--count === 0) {
                                    if (typeof callback === 'function') {
                                        callback();
                                    }
    
                                    Product.bindEditProductVariant();
                                }
                            }, 100);
                        } else {
                            if (--count === 0) {
                                if (typeof callback === 'function') {
                                    callback();
                                }
    
                                Product.bindEditProductVariant();
                            }
                        }
                    });
                }
            });
        }
    },

    bindEditProductVariant: function () {
        const decoded = JSON.parse(atob(variants));
    
        $('.variant-row').each(function (index) {
            const $row = $(this);
            const variant = decoded[index] ?? {};
    
            const quantity = variant.quantity ?? 0;
            const sku = variant.sku ?? '';
            const price = variant.price ?? 0;
            const barcode = variant.barcode ?? '';
            const fileName = variant.file_name ?? '';
            const fileUrl = variant.file_url ?? '';
            const album = variant.album ?? '';
            const imageUrl = album ? album.split(',')[0] : 'http://127.0.0.1:8000/backend/images/no-image.jpg';
    
            const fieldMap = {
                'variant_quantity': quantity,
                'variant_sku': sku,
                'variant_price': price,
                'variant_barcode': barcode,
                'variant_filename': fileName,
                'variant_fileurl': fileUrl,
                'variant_album': album
            };
    
            for (const className in fieldMap) {
                $row.find('.' + className).val(fieldMap[className]);
            }
    
            $row.find('.td_quantity').text(quantity);
            $row.find('.td_price').text(price);
            $row.find('.td_sku').text(sku);
            $row.find('.imageVariant').attr('src', imageUrl);
        });
    },
    
    submitFormData: function (url) {
        $(".ckeditor-classic").each(function () {
            let editorInstance = this.ckEditorInstance || ClassicEditor.instances[this.id];
            if (editorInstance) {
                $(this).val(editorInstance.getData());
            }
        });
    
        let canonicalInput = $("#canonical");
        let canonicalOriginal = canonicalInput.val().trim();
        let canonicalSlug = SEO.removeUtf8(canonicalOriginal);
    
        let formElement = document.getElementById('form-store-modal');
        let formData = new FormData(formElement);
        formData.append('_token', HT._token);
    
        formData.set('canonical', canonicalSlug);
        console.log(formData);
    
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    localStorage.setItem("productMessage", response.message);
                    window.location.href = "/product/index";
                } else {
                    alertify.error(response.message);
                }
            },
            error: function (xhr) {
                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    HT.displayValidationErrors(xhr.responseJSON.errors);
                    if (xhr.responseJSON.errors.attribute) {
                        alertify.error(xhr.responseJSON.errors.attribute[0]);
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
            let language_id  = $('#form-store-modal').attr('data-language-id');
            let url = id ? `/ajax/product/update/${id}/${language_id}` : '/ajax/product/create';
            Product.submitFormData(url);
        });
    },

    sendDataFilter: function (page = 1) {
        if (!window.location.pathname.includes('/product/index')) {
            return;
        }
    
        let dataFilterSend = { page: page };
    
        $('.filter-data').find("input, select").each(function () {
            let name = $(this).attr("name");
            if (name) {
                dataFilterSend[name] = $(this).val();
            }
        });
    
        let selectedLanguage = $('.dropdown-menu .language-filter.active').data('id');
        if (selectedLanguage) {
            dataFilterSend.language_id = selectedLanguage;
        }
    
        $.ajax({
            url: '/ajax/product/filter',
            type: 'GET',
            data: dataFilterSend,
            dataType: 'json',
            success: function (response) {
                const tbody = $('.data-table');
                tbody.empty();
                response.data.data.forEach(item => {
                    tbody.append(`
                        <tr>
                            <td>
                                <div class="form-check font-size-16 d-flex justify-content-center">
                                    <input data-id="${item.id}" class="form-check-input publish-checkAll" type="checkbox" id="listcheck${item.id}">
                                    <label class="form-check-label" for="listcheck${item.id}"></label>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <div>
                                        <img class="rounded imageVariant avatar" src="${item.image}">
                                    </div>
                                    <div class="product-info">
                                        <div class="mb-1">
                                            <strong>${item.name ?? '-'}</strong>
                                        </div>
                                        <div>
                                            <small class="text-primary">${Config.translations.supported_languages}</small>
                                            ${item.languages && item.languages.length > 0 ? 
                                            item.languages.sort((a, b) => a.canonical.localeCompare(b.canonical))
                                                .map(lang => `
                                                    <img src="${lang.image}" alt="${lang.name}" title="${lang.name}" class="flag-icon ms-1">
                                                `).join(' ') 
                                            : `<span class="text-muted">${Config.translations.no_languages}</span>`}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                ${item.product_quantity}
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
                                            <a href="${Config.baseUrl}/product/edit/${item.id}/${item.language_id}" class="dropdown-item edit-button-modal">
                                                <i class="mdi mdi-pencil font-size-16 text-success me-1"></i> ${Config.actionTextButton.edit}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="${Config.baseUrl}/language/${item.id}/${item.language_id}/${Config.modelParent || 'defaultName'}/${Config.model}/translate" data-id="${item.id}" class="dropdown-item translate-btn">
                                                <i class="mdi mdi-translate font-size-16 text-primary me-1"></i> ${Config.actionTextButton.translate}
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
                HT.handleDeleteRequest(".delete-btn", "/ajax/product/delete", Product);
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

            
            Product.sendDataFilter(HT.currentPage);
        });
    },

    attachFilterEvent: function () {
        $(".filter-data").find("input, select").on("input change", function () {
            clearTimeout(HT.filterTimeout);

            HT.filterTimeout = setTimeout(() => {
                Product.sendDataFilter();
            }, 500);
        });
    },
};

$(document).ready(function () {
    // SETUP VARIANT
    Product.setupProductVariant();
    Product.addVariant();
    Product.removeAttribute();
    Product.chooseVariantGroup();
    Product.disabledAttributeCatalogueChoose();
    Product.createProductVariant();
    Product.updateVariant();
    Product.variantSaveUpdate();
    Product.setupMultiSelect();

    // FILTER AND STORE PRODUCT
    Product.bindStoreAndUpdateEntityHandler();
    Product.sendDataFilter();
    Product.attachFilterEvent();
    Product.attachPaginationEvent();
    HT.showStoredMessage("productMessage", "/product/index");
    HT.attachFilterEvent(Product);
    HT.initializeMultiChoices();

    // FORMAT INPUT NUMBER
    HT.formatNumberInputComma('.int');
});