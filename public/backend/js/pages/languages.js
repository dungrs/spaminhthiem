const Language = {
    submitFormData: function (url) {
        let formData = $('#form-store-modal').serialize();
        formData += '&_token=' + encodeURIComponent(HT._token);

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    alertify.success(response.message);
                    $('.store-modal').modal('hide');
                    $('#form-store-modal')[0].reset();
                    Language.sendDataFilter(HT.currentPage);
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
                url: `/ajax/language/edit/${id}`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    let item = response.data;

                    $('.image').val(item.image);
                    $('.name').val(item.name);
                    $('.canonical').val(item.canonical);
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

    bindStoreAndUpdateEntityHandler: function () {
        $(document).on('click', '.submitButton', function (e) {
            e.preventDefault();
            HT.clearValidationErrors();

            let id = $('#form-store-modal').attr('data-id');
            let url = id ? `/ajax/language/update/${id}` : '/ajax/language/create';
            Language.submitFormData(url);
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
            url: '/ajax/language/filter',
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
                                <image src="${item.image}" class="rounded img-flag">
                            </td>
                            <td>${item.name ?? '-'}</td>
                            <td>${item.canonical ?? '-'}</td>
                            <td>${item.description ?? '-'}</td>
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
                                            <a href="#" data-id="${item.id}" class="dropdown-item delete-btn">
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
                Language.openEditModal();
                HT.handleDeleteRequest(".delete-btn", "/ajax/language/delete", Language)
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

            Language.sendDataFilter(HT.currentPage);
        });
    },

    attachFilterEvent: function () {
        $(".filter-data").find("input, select").on("input change", function () {
            clearTimeout(HT.filterTimeout);

            HT.filterTimeout = setTimeout(() => {
                Language.sendDataFilter();
            }, 500);
        });
    },
};

$(document).ready(function () {
    Language.bindStoreAndUpdateEntityHandler();
    Language.sendDataFilter();
    Language.openAddModal();
    Language.attachFilterEvent();
    Language.attachPaginationEvent();
});