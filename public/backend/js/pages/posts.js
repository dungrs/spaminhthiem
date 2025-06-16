const Post = {
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
    
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    localStorage.setItem("postMessage", response.message);
                    window.location.href = "/post/index";
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
            let url = id ? `/ajax/post/update/${id}/${language_id}` : '/ajax/post/create';
            Post.submitFormData(url);
        });
    },

    sendDataFilter: function (page = 1) {
        if (!window.location.pathname.includes('/post/index')) {
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
            url: '/ajax/post/filter',
            type: 'GET',
            data: dataFilterSend,
            dataType: 'json',
            success: function (response) {
                const tbody = $('.data-table');
                console.log(response.data.data);
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
                                            <a href="${Config.baseUrl}/post/edit/${item.id}/${item.language_id}" class="dropdown-item edit-button-modal">
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
                HT.handleDeleteRequest(".delete-btn", "/ajax/post/delete", Post);
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

            
            Post.sendDataFilter(HT.currentPage);
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
    Post.bindStoreAndUpdateEntityHandler();
    Post.sendDataFilter();
    Post.attachFilterEvent();
    Post.attachPaginationEvent();
    HT.showStoredMessage("postMessage", "/post/index");
    HT.attachFilterEvent(Post);
    HT.initializeMultiChoices();
});