const Widget = {
    handleSearchModelInput: function () {
        $(document).on('change', '.input-radio', function (e) {
            $('.search-modal-results').html('');
            let model = $(this).data('model');
            let modelParent = $(this).data('modelparent');
            Widget.sendAjaxModel(modelParent, model);
        });
    
        $('.input-radio:checked').each(function () {
            let model = $(this).data('model');
            let modelParent = $(this).data('modelparent');
            Widget.sendAjaxModel(modelParent, model);
        });
    },

    sendAjaxModel: function (modelParent, model) {
        $.ajax({
            url: '/ajax/widget/findModelObject',
            type: 'GET',
            data: { modelParent: modelParent, model: model },
            dataType: 'json',
            success: (response) => {
                let renderedCanonicals = $('.search-result-item').map(function () {
                    return $(this).data('canonical');
                }).get();
    
                let modelLists = response.data
                    .filter(modelItem => !renderedCanonicals.includes(modelItem.canonical))
                    .map(modelItem => ({
                        value: modelItem.id,
                        label: modelItem.name,
                        selected: false,
                        disabled: false,
                        customProperties: {
                            canonical: modelItem.canonical,
                            image: modelItem.image,
                            name: modelItem.name
                        }
                    }));
    
                let $select = $('.search-model-select');
                let choicesInstance = $select.data("choicesInstance");
    
                if (choicesInstance) {
                    choicesInstance.clearChoices();
                    choicesInstance.setChoices(modelLists, 'value', 'label', true);
                }
            },
            error: function (xhr) {
                console.error('AJAX error:', xhr.responseText);
            }
        });
    },
    
    handleAddModel: function () {
        $(document).on('change', '.search-model-select', function () {
            const choicesInstance = $(this).data("choicesInstance");
    
            if (choicesInstance) {
                const selected = choicesInstance.getValue();
    
                $(".search-modal-results").append(Widget.renderTemplateModel(selected));
    
                Widget.checkEmptyModel();
    
                const model = $('.input-radio:checked').data('model');
                const modelParent = $('.input-radio:checked').data('modelparent');
    
                if (model && modelParent) {
                    Widget.sendAjaxModel(modelParent, model);
                }
            }
        });
    },
    
    renderTemplateModel: function (data) {
        return `
            <div class="search-result-item card p-3 mb-2" data-canonical="${data.customProperties.canonical}">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="image-thumbnail me-3">
                            <img src="${data.customProperties.image ?? ''}" 
                                class="rounded img-fluid" 
                                alt="Preview"
                                width="60"
                                height="60">
                        </div>
                        <div class="item-info">
                            <h6 class="mb-1">${data.customProperties.name}</h6>
                            <small class="text-muted">${WidgetConfig.messages.path_label} /${data.customProperties.canonical}</small>
                        </div>
                        <div class="hidden-fields d-none">
                            <input type="hidden" name="modelItem[id][]" value="${data.value}">
                            <input type="hidden" name="modelItem[name][]" value="${data.customProperties.name}">
                            <input type="hidden" name="modelItem[image][]" value="${data.customProperties.image}">
                            <input type="hidden" name="modelItem[canonical][]" value="${data.customProperties.canonical}">
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-danger delete-model-item">
                        <i class="bx bx-trash"></i>
                    </button>
                </div>
            </div>
        `;
    },

    deleteModel: function () {
        $(document).on('click', '.delete-model-item', function (e) {
            e.preventDefault();
            $(this).closest('.search-result-item').remove();
            Widget.checkEmptyModel();

            const model = $('.input-radio:checked').data('model');
            const modelParent = $('.input-radio:checked').data('modelparent');

            if (model && modelParent) {
                Widget.sendAjaxModel(modelParent, model);
            }
        });
    },

    checkEmptyModel: function () {
        if ($('.search-result-item').length === 0) {
            $('.notification-model').removeClass('d-none');
        } else {
            $('.notification-model').addClass('d-none');
        }
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
    
        let selectedModel = $('input[name="model"]:checked');
        if (selectedModel.length > 0) {
            let modelValue = selectedModel.val();
            let modelParentValue = selectedModel.data('modelparent');
    
            formData.set('model', modelValue);
            formData.set('modelParent', modelParentValue);
        }
    
        let modelItems = $('input[name="modelItem[id][]"]');
        if (modelItems.length === 0) {
            alertify.error(`${WidgetConfig.messages.module_validate}`);
            return; 
        }
    
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    localStorage.setItem("widgetMessage", response.message);
                    window.location.href = "/widget/index";
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
    
    bindStoreAndUpdateEntityHandler: function () {
        $(document).on('click', '.submitButton', function (e) {
            e.preventDefault();
            HT.clearValidationErrors();

            let id = $('#form-store-modal').attr('data-id');
            let language_id  = $('#form-store-modal').attr('data-language-id');
            let url = id ? `/ajax/widget/update/${id}/${language_id}` : '/ajax/widget/create';
            Widget.submitFormData(url);
        });
    },

    submitFormTranslateData: function (url, formData) {
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    let tab = $('#language-tabs .nav-link.active');
                    let canonical = tab.data('canonical');
                    let icon = tab.find('i');
        
                    if (response.data.canonical == canonical) {
                        icon.removeClass('uil-exclamation-circle text-danger')
                            .addClass('uil-check-circle text-success');
                    }
                    
                    alertify.success(response.message);
                } else {
                    alertify.error(response.message);
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    HT.displayValidationErrors(xhr.responseJSON.errors);
                } else {
                    console.error('AJAX Error: ', xhr.responseText);
                }
            },
        });
    },
    
    bindStoreTranslate: function () {
        $(document).on('click', '.translateButton', function (e) {
            e.preventDefault();
            HT.clearValidationErrors();
    
            $(".ckeditor-classic.trans").each(function () {
                let editorInstance = this.ckEditorInstance || ClassicEditor.instances[this.id];
                if (editorInstance) {
                    $(this).val(editorInstance.getData());
                }
            });
    
            let form = $('#form-translate'),
                url, formData;
    
            let activeTab = $('#language-tabs-content .tab-pane.active') || '';
    
            let name = activeTab.find('input[name="name_trans"]').val() || '',
                language_id = activeTab.find('input[name="language_id"]').val() || '',
                description = activeTab.find('textarea[name="description_trans"]').val() || '',
                keyword = activeTab.find('input[name="keyword_trans"]').val() || '',
                option = {
                    id: form.find('input[name="option[id]"]').val() || '',
                    language_id: form.find('input[name="option[language_id]"]').val() || '',
                };
    
            if (!name.trim()) {
                alertify.error(`${WidgetConfig.messages.name_validate}`);
                return;
            }
            if (!keyword.trim()) {
                alertify.error(`${WidgetConfig.messages.keyword_validate}`);
                return;
            }
    
            formData = {
                option: option,
                language_id: language_id,
                name_trans: name,
                description_trans: description,
                keyword_trans: keyword,
                _token: HT._token,
            };
    
            url = `/ajax/widget/saveTranslate`;
            Widget.submitFormTranslateData(url, formData);
        });
    },

    sendDataFilter: function (page = 1) {
        if (!window.location.pathname.includes('/widget/index')) {
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
            url: '/ajax/widget/filter',
            type: 'GET',
            data: dataFilterSend,
            dataType: 'json',
            success: function (response) {
                const tbody = $('.data-table');
                tbody.empty();
                response.data.data.forEach(item => {
                    let levelPrefix = '|----'.repeat(item.level > 0 ? item.level - 1 : 0);
                
                    tbody.append(`
                        <tr>
                            <td>
                                <div class="form-check font-size-16 d-flex justify-content-center">
                                    <input data-id="${item.id}" class="form-check-input publish-checkAll" type="checkbox" id="listcheck${item.id}">
                                    <label class="form-check-label" for="listcheck${item.id}"></label>
                                </div>
                            </td>
                            <td>
                                <div class="mb-1">
                                    <strong>${levelPrefix} ${item.name ?? '-'}</strong>
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
                                            <a href="${Config.baseUrl}/widget/edit/${item.id}/${item.language_id}" class="dropdown-item edit-button-modal">
                                                <i class="mdi mdi-pencil font-size-16 text-success me-1"></i> ${Config.actionTextButton.edit}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="translate/${item.id}/${item.language_id}" data-id="${item.id}" class="dropdown-item translate-btn">
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
                HT.handleDeleteRequest(".delete-btn", "/ajax/widget/delete", Widget);
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

            
            Widget.sendDataFilter(HT.currentPage);
        });
    },

    attachFilterEvent: function () {
        $(".filter-data").find("input, select").on("input change", function () {
            clearTimeout(HT.filterTimeout);

            HT.filterTimeout = setTimeout(() => {
                Widget.sendDataFilter();
            }, 500);
        });
    },
};

$(document).ready(function () {
    Widget.handleSearchModelInput();
    Widget.handleAddModel();
    Widget.deleteModel();
    Widget.checkEmptyModel();

    Widget.bindStoreAndUpdateEntityHandler();
    Widget.bindStoreTranslate();
    Widget.sendDataFilter();
    Widget.attachFilterEvent();
    Widget.attachPaginationEvent();
    HT.showStoredMessage("widgetMessage", "/widget/index");
    HT.attachFilterEvent(Widget);
});