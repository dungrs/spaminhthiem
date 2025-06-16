const Permission = {
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
                    Permission.sendDataFilter(HT.currentPage);
                } else {
                    alertify.error(response.message)
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
            $('#form-mode').val('store');
    
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

            $('#form-mode').val('edit');
        
            $.ajax({
                url: `/ajax/permission/edit/${id}`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    let item = response.data;
        
                    $('.name').val(item.name);
                    $('.canonical').val(item.canonical);


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
            let url = id ? `/ajax/permission/update/${id}` : '/ajax/permission/create';
            Permission.submitFormData(url);
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
            url: '/ajax/permission/filter',
            type: 'GET',
            data: dataFilterSend,
            dataType: 'json',
            success: function (response) {
                const tbody = $('.data-table');
                tbody.empty();
                response.data.data.forEach(item => {
                    tbody.append(`
                        <tr>
                            <td>${item.name ?? '-'}</td>
                            <td>
                                ${item.canonical ?? '-'}
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

                Permission.openEditModal();
                HT.handleDeleteRequest(".delete-btn", "/ajax/permission/delete", Permission)
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

            
            Permission.sendDataFilter(HT.currentPage);
        });
    },

    attachFilterEvent: function () {
        $(".filter-data").find("input, select").on("input change", function () {
            clearTimeout(HT.filterTimeout);

            HT.filterTimeout = setTimeout(() => {
                Permission.sendDataFilter();
            }, 500);
        });
    },
};

$(document).ready(function () {
    Permission.openAddModal();
    Permission.bindStoreAndUpdateEntityHandler();
    Permission.sendDataFilter();
    Permission.attachFilterEvent();
    Permission.attachPaginationEvent();
});