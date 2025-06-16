const UserCatalogue = {
    submitFormData: function (url, formId, formData) {
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    alertify.success(response.message);
                    let modal = $('#' + formId).closest('.modal');
                    modal.modal('hide');
                    $('#' + formId)[0].reset();
                    UserCatalogue.sendDataFilter(HT.currentPage);
                } else {
                    alertify.error(response.message);
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    HT.displayValidationErrors(xhr.responseJSON.errors);
                } else {
                    alertify.error(xhr.responseJSON.message); 
                }
            },
        });
    },

    openAddModal: function () {
        $('.add-button').on('click', function (e) {
            e.preventDefault();

            $('.modal-title').text(Config.modalTitle.create)
            $('#form-store-modal').attr('data-id', '');
            $('#form-store-modal')[0].reset();

            HT.clearValidationErrors();
            $('.store-modal').modal('show');
        });
    },

    openEditModal: function () {
        $('.edit-button-modal').on('click', function (e) {
            e.preventDefault();

            $('.modal-title').text(Config.modalTitle.edit)
            let id = $(this).data('id');
            HT.clearValidationErrors();

            $.ajax({
                url: `/ajax/user/catalogue/edit/${id}`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    let item = response.data;

                    $('.name').val(item.name);
                    $('.description').val(item.description);
                    $('#form-store-modal').attr('data-id', id);

                    $('.store-modal').modal('show');
                },
                error: function (xhr) {
                    console.error('Error fetching detail: ', xhr.responseText);
                }
            });
        });
    },

    bindSubmitEntityHandler: function () {
        $(document).on('click', '.submitButton', function (e) {
            e.preventDefault();
            HT.clearValidationErrors();
    
            let modal = $(this).closest('.modal');
            let form = modal.find('form');
            let formId = form.attr('id');
            let id = form.attr('data-id'); 
            let url, formData;
    
            if (modal.hasClass('store-modal')) {
                formData = form.serialize() + '&_token=' + encodeURIComponent(HT._token);
                url = id ? `/ajax/user/catalogue/update/${id}` : '/ajax/user/catalogue/create/';
            }
    
            UserCatalogue.submitFormData(url, formId, formData);
        });
    },

    sendDataFilter: function (page = 1) {
        let dataFilterSend = { page: page };

        $('.filter-data').find("input, select").each(function () {
            let name = $(this).attr("name");
            if (name) {
                dataFilterSend[name] = $(this).val();
            }
        });

        $.ajax({
            url: '/ajax/user/catalogue/filter',
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
                                <div class="form-check font-size-16">
                                    <input data-id="${item.id}" class="form-check-input publish-checkAll" type="checkbox" id="customerlistcheck${item.id}">
                                    <label class="form-check-label" for="customerlistcheck${item.id}"></label>
                                </div>
                            </td>
                            <td>
                                <div class="mb-1">
                                    ${item.name ?? '-'}
                                </div>
                            </td>
                            <td>${item.phone ?? '-'}</td>
                            <td>${item.email ?? '-'}</td>
                            <td>${item.users_count ?? '-'}</td>
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
                                            <a href="#" data-id="${item.id}" class="dropdown-item edit-button-modal">
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
                UserCatalogue.openEditModal();
                HT.handleDeleteRequest(".delete-btn", "/ajax/user/catalogue/delete", UserCatalogue)
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

            UserCatalogue.sendDataFilter(HT.currentPage);
        });
    },
};

$(document).ready(function () {
    UserCatalogue.bindSubmitEntityHandler();
    UserCatalogue.sendDataFilter();
    UserCatalogue.openAddModal();
    HT.attachFilterEvent(UserCatalogue);
    UserCatalogue.attachPaginationEvent();
});