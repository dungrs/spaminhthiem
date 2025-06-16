let Menu = {
    submitFormData: function (url, formElement) {
        let formData = new FormData(formElement);
        formData.append('_token', HT._token);
    
        $('.error-container').empty().hide();
    
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    localStorage.setItem("menuMessage", response.message);
                    window.location.href = "/menu/index";
                } else {
                    Menu.showMenuError(response.message);
                }
            },
            error: function (xhr) {
                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    const allErrors = Menu.getAllValidationErrors(xhr.responseJSON.errors);
                    Menu.showMenuError(allErrors);
                    
                    HT.displayValidationErrors(xhr.responseJSON.errors);
                } else {
                    console.error('AJAX Error:', xhr.responseText);
                    Menu.showMenuError(`${Config.confirmMessages.generalError}`);
                }
            },
        });
    },

    getAllValidationErrors: function(errors) {
        let allErrorMessages = [];
        
        for (const [field, messages] of Object.entries(errors)) {
            const uniqueMessages = [...new Set(messages)];
            allErrorMessages = allErrorMessages.concat(uniqueMessages);
        }
        
        const uniqueErrors = [...new Set(allErrorMessages)];
        
        return uniqueErrors.join('<br>');
    },

    showMenuError: function(message) {
        const alertEl = $('#menuErrorAlert');
        const messageEl = $('#menuErrorMessage');
        
        alertEl.removeClass('d-none');
        
        if (typeof message === 'string') {
            messageEl.html(`${message}`);
        } 
        else {
            messageEl.html(`
                <div class="d-flex align-items-start">
                    <div>
                        <strong>Có ${message.split('<br>').length} lỗi cần sửa:</strong>
                        <div class="mt-1">${message}</div>
                    </div>
                </div>
            `);
        }
    },
    
    bindStoreAndUpdateEntityHandler: function () {
        $(document).on('click', '.submitButton', function (e) {
            e.preventDefault();
    
            let formElement = document.getElementById('form-store-modal');
            if (!formElement) return;
    
            HT.clearValidationErrors();
    
            // Lấy data-method và data-id từ form
            let method = formElement.getAttribute('data-method');
            let id = formElement.getAttribute('data-id');
    
            let url = '';
            switch (method) {
                case 'store':
                    url = `/ajax/menu/store`;
                    break;
                case 'update':
                    url = `/ajax/menu/update/${id}`;
                    break;
                case 'saveChildren':
                    url = `/ajax/menu/saveChildren/${id}`;
                    break;
                default:
                    alertify.error('Hành động không hợp lệ');
                    return;
            }
    
            // Gửi form
            Menu.submitFormData(url, formElement);
        });
    },

    bindStoreCatalogueEntityHandler: function() {
        $(document).on('click', '.submitCatalogueButton', function (e) {
            let formElement = document.getElementById('create-menu-catalogue')
            e.preventDefault();
            HT.clearValidationErrors();

            let keywordInput = $("#keyword");
            let keywordOriginal = keywordInput.val().trim();
            let keywordSlug = SEO.removeUtf8(keywordOriginal);

            let url = `/ajax/menu/catalogue/create`;
            let formData = new FormData(formElement);
            formData.append('_token', HT._token);
            formData.set('keyword', keywordSlug);
        
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        console.log(response.data);
                        $('.store-catalogue-modal').modal('hide'); 
                        $('#create-menu-catalogue')[0].reset();
                        alertify.success(response.message);

                        let select = $('select[name="menu_catalogue_id"]');
                        let choicesInstance = select.data('choicesInstance');

                        let newOption = new Option(response.data.name, response.data.id, false, false)

                        select.append(newOption);

                        if (choicesInstance) {
                            choicesInstance.setChoices([{
                                value: response.data.id,
                                label: response.data.name,
                                selected: true
                            }], 'value', 'label', false);
                        }

                        select.trigger('change')
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
        });
    },

    createMenuRow: function() {
        $(document).on('click', '.add-menu', function(e) {
            e.preventDefault();
            $('.menu-wrapper .notification').hide();
            $('#menu-table-body').append(Menu.renderMenuRowHtml())
        })
    },

    renderMenuRowHtml: function(option) {
        return `
            <tr class="menu-item ${(option && typeof(option.canonical) !== 'undefined' ? option.canonical : "")}">
                <td>
                    <input type="text" class="form-control form-control-sm name" name="menu[name][]" value="${option && typeof(option.name) !== 'undefined' ? option.name : ''}" placeholder="${MenuConfig.messages.name_placeholder}" required>
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm canonical" name="menu[canonical][]" value="${option && typeof(option.canonical) !== 'undefined' ? option.canonical : ''}" placeholder="${MenuConfig.messages.canonical_placeholder}" required>
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm" name="menu[order][]" placeholder="${MenuConfig.messages.order_placeholder}" value="0" required>
                </td>
                <td class="text-end">
                    <button type="button" class="btn btn-sm btn-outline-danger delete-menu-row">
                        <i class="mdi mdi-trash-can-outline"></i>
                    </button>
                </td>
                <input type="hidden" name="menu[id][]" value="0">
            </tr>
        `
    },

    deleteMenuRow: function() {
        $(document).on('click', '.delete-menu-row', function(e) {
            e.preventDefault();
            let row = $(this).closest('.menu-item');
            let canonical = row.find('input[name="menu[canonical][]"]').val();
            
            row.remove();
            
            $(`#group-${canonical}, #${canonical}`).prop('checked', false);
            
            if ($('#menu-table-body').children().length === 0) {
                $('.menu-wrapper .notification').show();
            }
        });
    },
    getMenu: function() {
        $(document).on('click', '.menu-module', function() {
            let _this = $(this);
            let accordionItem = _this.closest('.accordion-item');
            let menuList = accordionItem.find('.menu-list');
            let option = {
                model: _this.data('model'),
                modelParent: _this.data('modelparent')
            };

            menuList.html(`
                <div class="text-center py-4 text-muted">
                    <i class="mdi mdi-loading mdi-spin fs-4"></i>
                    <p class="mt-2 mb-0">Laoding...</p>
                </div>
            `);
            
            accordionItem.find('.error-message').remove();
            
            Menu.sendAjaxGetMenu(option, accordionItem);
        });
    },
    
    sendAjaxGetMenu: function(option, accordionItem) {
        $.ajax({
            url: '/ajax/menu/getMenu',
            type: 'GET',
            data: option,
            dataType: 'JSON',
            success: function(response) {
                let menuList = accordionItem.find('.menu-list');
                
                if (response.status === 'success') {
                    let html = Menu.renderMenuTree(response.data);
                    menuList.html(html);
                    
                    $('.menu-item').each(function() {
                        let canonical = $(this).find('input[name="menu[canonical][]"]').val();
                        if (canonical) {
                            $(`#group-${canonical}, #${canonical}`).prop('checked', true);
                        }
                    });
                    
                    Menu.initAccordionComponents(accordionItem);
                } else {
                    menuList.html(`
                        <div class="alert alert-danger error-message">
                            ${response.message}
                        </div>
                    `);
                }
            },
            error: function(xhr) {
                let menuList = accordionItem.find('.menu-list');
                let errorMessage = `${Config.confirmMessages.generalError}`;
                
                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    errorMessage = Object.values(xhr.responseJSON.errors).join('<br>');
                }
                
                menuList.html(`
                    <div class="alert alert-danger error-message">
                        ${errorMessage}
                    </div>
                `);
            }
        });
    },
    
    renderMenuTree: function(categories) {
        if (!categories || categories.length === 0) {
            return `
                <div class="text-center py-4 text-muted">
                    <i class="mdi mdi-information-outline fs-4"></i>
                    <p class="mt-2 mb-0">No data available</p>
                </div>
            `;
        }
    
        let groupParents = categories.filter(item => item.level === 1);
        
        let itemsWithoutParent = categories.filter(item => {
            return item.level !== 1 && !groupParents.some(group => 
                item.lft > group.lft && item.rgt < group.rgt
            );
        });
    
        let groupsHtml = groupParents.map(group => {
            let children = categories.filter(child => 
                child.lft > group.lft && child.rgt < group.rgt
            );
    
            let childrenHtml = children.map(child => {
                let canonical = child.canonical || `cat-${child.id}`;
                return `
                    <div class="form-check py-1">
                        <input class="form-check-input" 
                               type="checkbox" 
                               id="${canonical}"
                               ${child.is_checked ? 'checked' : ''}>
                        <label class="form-check-label w-100 d-flex justify-content-between" 
                               for="${canonical}">
                            <span>${child.name}</span>
                        </label>
                    </div>
                `;
            }).join('');
    
            return `
                <div class="mb-2">
                    <div class="d-flex align-items-center mb-1 px-2 py-1 bg-light rounded">
                        <div class="form-check me-2">
                            <input class="form-check-input group-checkbox" 
                                   type="checkbox" 
                                   id="group-${group.canonical || group.id}"
                                   ${group.is_checked ? 'checked' : ''}>
                        </div>
                        <label class="fw-semibold text-uppercase mb-0 flex-grow-1" 
                               for="group-${group.canonical || group.id}">
                            ${group.name}
                        </label>
                    </div>
                    <div class="ps-4">
                        ${childrenHtml}
                    </div>
                </div>
            `;
        }).join('');
    
        let itemsWithoutParentHtml = itemsWithoutParent.map(item => {
            let canonical = item.canonical || `cat-${item.id}`;
            return `
                <div class="form-check py-1 mb-2">
                    <input class="form-check-input" 
                           type="checkbox" 
                           id="${canonical}"
                           ${item.is_checked ? 'checked' : ''}>
                    <label class="form-check-label w-100 d-flex justify-content-between" 
                           for="${canonical}">
                        <span>${item.name}</span>
                    </label>
                </div>
            `;
        }).join('');
    
        let html = groupsHtml + itemsWithoutParentHtml;
        
        return `<div class="p-2">${html}</div>`;
    },
    
    initAccordionComponents: function(accordionItem) {
        accordionItem.find('.group-checkbox').on('change', function() {
            let groupDiv = $(this).closest('.mb-2');
            let isChecked = $(this).is(':checked');
            groupDiv.find('.form-check-input').prop('checked', isChecked);
        });
    },

    bindApplyButton: function() {
        $(document).on('click', '.btn-apply-menu', function(e) {
            e.preventDefault();
            let accordionItem = $(this).closest('.accordion-item');
            let menuTableBody = $('#menu-table-body');
            
            let checkedItems = [];
            
            accordionItem.find('.group-checkbox:checked').each(function() {
                let group = $(this);
                let groupContainer = group.closest('.mb-2');
                let groupId = group.attr('id').replace('group-', '');
                let groupLabel = group.closest('.d-flex').find('label');
                let groupName = groupLabel.text().trim();
                
                checkedItems.push({
                    name: groupName,
                    canonical: groupId,
                    isGroup: true,
                    order: 0 
                });
                
                groupContainer.find('.form-check-input:checked:not(.group-checkbox)').each(function() {
                    let child = $(this);
                    let childId = child.attr('id').replace('cat-', '');
                    let childLabel = child.next('label');
                    let childName = childLabel.find('span').text().trim();
                    
                    checkedItems.push({
                        name: childName,
                        canonical: childId,
                        isGroup: false,
                        parentCanonical: groupId,
                        order: 0 
                    });
                });
            });
            
            accordionItem.find('.form-check-input:checked:not(.group-checkbox)').each(function() {
                let item = $(this);
                let parentGroup = item.closest('.mb-2').find('.group-checkbox');
                
                if (!parentGroup.is(':checked')) {
                    let itemId = item.attr('id').replace('cat-', '');
                    let itemLabel = item.next('label');
                    let itemName = itemLabel.find('span').text().trim();
                    
                    checkedItems.push({
                        name: itemName,
                        canonical: itemId,
                        isGroup: false,
                        order: 0
                    });
                }
            });

            checkedItems.forEach((item) => {
                let newRow = $(Menu.renderMenuRowHtml(item));
                menuTableBody.append(newRow);
            });

            $('.menu-wrapper .notification').hide();
            alertify.success(`Đã thêm ${checkedItems.length} mục vào menu`);

            if (checkedItems.length === 0) {
                alertify.warning('Vui lòng chọn ít nhất một mục');
                return;
            }
        });
    },

    bindResetButton: function() {
        $(document).on('click', '.btn-reset-menu', function(e) {
            e.preventDefault();
            let accordionItem = $(this).closest('.accordion-item');
            
            accordionItem.find('.form-check-input:checked').prop('checked', false);
        });
    },

    bindSearchMenu: function() {
        function debounce(func, delay) {
            let timer;
            return function (...args) {
                clearTimeout(timer);
                timer = setTimeout(() => func.apply(this, args), delay);
            };
        }

        $(document).off('input', '.search-menu').on('input', '.search-menu', debounce(function () {
            const input = $(this);
            const keyword = input.val();
            const accordionItem = input.closest('.accordion-item');

            const button = accordionItem.find('.accordion-button');
            const model = button.data('model');
            const modelParent = button.data('modelparent');

            const option = {
                model: model,
                modelParent: modelParent,
                keyword: keyword
            };

            Menu.sendAjaxGetMenu(option, accordionItem);
        }, 300));

        $(document).off('keypress', '.search-menu').on('keypress', '.search-menu', function (e) {
            if (e.which === 13) {
                e.preventDefault();
                $(this).trigger('input');
            }
        });
    },

    setupNestable: function () {
        const $nestable = $('#nestable2');
        const $output = $('#nestable2-output');
    
        if ($nestable.length && $output.length) {
            $nestable.data('output', $output);
    
            $nestable.nestable({
                group: 1,
                maxDepth: 5
            }).on('change', function (e) {
                Menu.updateMestableOutput(e);
            });
    
            Menu.updateOutput($nestable);
        }
    },
    
    updateOutput: function (element) {
        const output = element.data('output');
        if (output && window.JSON) {
            const data = element.nestable('serialize');
            output.val(JSON.stringify(data, null, 2));
        }
    },
    
    runUpdateNestableOutput: function () {
        const $nestable = $('#nestable2');
        const $output = $('#nestable2-output');
        $nestable.data('output', $output);
        Menu.updateOutput($nestable);
    },
    
    expandAndCollapse: function () {
        $('#nestable-menu').on('click', function (e) {
            const action = $(e.target).data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });
    },
    
    updateMestableOutput: function (e) {
        const list = $(e.currentTarget);
        const output = list.data('output');
    
        if (!output) return;
    
        const json = JSON.stringify(list.nestable('serialize'));
    
        if (json) {
            const option = {
                json: json,
                menu_catalogue_id: $('#nestable2').data('menucatalogueid'),
                _token: HT._token
            };
    
            $.ajax({
                url: '/ajax/menu/drag',
                type: 'POST',
                data: option,
                dataType: 'json',
                success: function (res) {
                    
                },
                error: function (jqXHR, textStatus, errorThrown) {

                }
            });
        }
    },

    preventNestableDragOnActionClick: function() {
        $(document).on('mousedown', '.dd-handle a', function (e) {
            e.stopPropagation();
            const href = $(this).attr('href');
            window.location.href = href;
        });
    
        $(document).on('click', '.dd-handle a', function (e) {
            e.stopPropagation();
            const href = $(this).attr('href');
            window.location.href = href;
        });
    },
    
    handleTranslateMenu: function() {
        $('#form-translate').on('submit', function (e) {
            e.preventDefault();
    
            const $form = $(this);
            const $activeTab = $('.tab-pane.show.active');
            const formData = new FormData();
    
            // Thu thập dữ liệu của ngôn ngữ đang active
            $activeTab.find('input, textarea').each(function () {
                const name = $(this).attr('name');
                const value = $(this).val();
    
                if (name && value !== undefined) {
                    formData.append(name, value);
                }
            });
    
            formData.append('_token', HT._token);
    
            const languageId = $activeTab.attr('id')?.replace('lang-', '');
    
            $.ajax({
                url: `/ajax/menu/saveTranslate/${languageId}`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status === 'success') {
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
        });
    },
    
    sendDataFilter: function (page = 1) {
        if (!window.location.pathname.includes('/menu/index')) {
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
            url: '/ajax/menu/filter',
            type: 'GET',
            data: dataFilterSend,
            dataType: 'json',
            success: function (response) {
                let tbody = $('.data-table');
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
                                <strong>${item.name ?? '-'}</strong>
                            </td>
                            <td>
                                ${item.keyword}
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
                                            <a href="${Config.baseUrl}/menu/edit/${item.id}" class="dropdown-item edit-button-modal">
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
                HT.handleDeleteRequest(".delete-btn", "/ajax/menu/catalogue/delete", Menu);
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

            
            Menu.sendDataFilter(HT.currentPage);
        });
    },

    attachFilterEvent: function () {
        $(".filter-data").find("input, select").on("input change", function () {
            clearTimeout(HT.filterTimeout);

            HT.filterTimeout = setTimeout(() => {
                Menu.sendDataFilter();
            }, 500);
        });
    },
};

$(document).ready(function () {
    Menu.bindStoreAndUpdateEntityHandler();
    Menu.createMenuRow();
    Menu.deleteMenuRow();
    Menu.getMenu();
    Menu.bindApplyButton();
    Menu.bindResetButton();
    Menu.bindSearchMenu();
    Menu.setupNestable();
    Menu.expandAndCollapse();
    Menu.preventNestableDragOnActionClick();
    Menu.handleTranslateMenu();

    Menu.sendDataFilter();
    Menu.attachFilterEvent();
    Menu.attachPaginationEvent();
    Menu.bindStoreCatalogueEntityHandler();
    HT.showStoredMessage("menuMessage", "/menu/index");
    HT.attachFilterEvent(Menu);
    HT.initializeMultiChoices();
});