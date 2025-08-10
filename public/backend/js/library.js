var HT = {
    _token: $('meta[name="csrf-token"]').attr('content'),
    filterTimeout: null,
    currentPage: 1,

    initializeChoices: function () {
        $(".choice-single").each(function () {
            let select = $(this);
            if (!select.data("choicesInstance")) {
                let instance = new Choices(this, {
                    placeholderValue: "",
                    searchPlaceholderValue: "Tìm kiếm...",
                    itemSelectText: "",
                    shouldSort: false
                });
                select.data("choicesInstance", instance);
            }
        });
    },

    initializeMultiChoices: function () {
        $(".choice-multi").each(function () {
            let select = $(this);
            if (!select.data("choicesInstance")) {
                let instance = new Choices(this, {
                    removeItemButton: !0
                });
                select.data("choicesInstance", instance);
            }
        });
    },

    preventFormSubmitOnEnter: function () {
        $(document).on('keypress', '#form-store-modal', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                return false;
            }
        });
    },

    clearValidationErrors: function () {
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
    },

    displayValidationErrors: function (errors) {
        $.each(errors, function (field, messages) {
            let inputField = $(`.${field}`);
            
            inputField.addClass('is-invalid');
            inputField.after(`<div class="invalid-feedback">${messages[0]}</div>`);
    
            inputField.off('input change').on('input change', function () {
                inputField.removeClass('is-invalid');
                inputField.next('.invalid-feedback').remove();
            });
        });
    },

    openChangeStatusAll: function () {
        $('.changeStatusAll').on('click', function (e) {
            e.preventDefault();

            let status = $(this).data('value'),
                field = $(this).data('field');

            let selectedIds = [];
            $('.publish-checkAll:checked').each(function () {
                selectedIds.push($(this).data('id'));
            });

            if (selectedIds.length === 0) {
                alert("Vui lòng chọn ít nhất một mục để thay đổi trạng thái.");
                return;
            }

            let formData = {
                _token: HT._token,
                field: field,
                status: status,
                ids: selectedIds,
                model: Config.model,
                modelParent: Config.modelParent
            };

            $.ajax({
                url: `/ajax/dashboard/changeStatusAll`,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        selectedIds.forEach(id => {
                            let checkbox = $(`#switch${id}`);
                            if (status == 2) {
                                checkbox.prop('checked', true);
                            } else {
                                checkbox.prop('checked', false);
                            }
                        });
                    }
                },
                error: function (xhr) {
                    console.error('Error:', xhr.responseText);
                },
            });
        });
    },

    openChangeStatus: function() {
        $('.publish-check').on('change', function () {
            let _this = $(this);

            let id = _this.data('id'),
                status = _this.is(':checked') ? 2 : 1,
                field = _this.data('field');

            let formData = {
                _token: HT._token,
                field: field,
                status: status,
                model: Config.model,
                modelParent: Config.modelParent
            };

            $.ajax({
                url: `/ajax/dashboard/changeStatus/${id}`,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        // alertify.success(response.message);
                    } else {
                        // alertify.error(response.message);
                    }
                },
                error: function (xhr) {
                    alertify.error("Đã xảy ra lỗi khi cập nhật trạng thái.");
                },
            });
        });
    },

    handleDeleteRequest: function(selector, deleteUrl, instance) {
        $(document).on("click", selector, function (e) {
            e.preventDefault();
            let id = $(this).data('id'),
                messages = Config.confirmMessages;
            
            Swal.fire({
                title: messages.title,
                text: messages.text,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#51d28c",
                cancelButtonColor: "#f34e4e",
                confirmButtonText: messages.confirmButton,
                cancelButtonText: messages.cancelButton
            }).then(function (result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${deleteUrl}/${id}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                Swal.fire(messages.successTitle, response.message, "success");
                            } else {
                                Swal.fire(messages.errorTitle, response.message, "error");
                            }
                            instance.sendDataFilter(HT.currentPage);
                        },
                        error: function (xhr) {
                            Swal.fire(messages.errorTitle, xhr.responseJSON?.message || messages.deleteError, "error");
                        },
                    });
                }
            });
        });
    },

    openCheckStatusAll: function () {
        $('.checkStatusAll').on('change', function () {
            let isChecked = $(this).prop('checked');
            $('.publish-checkAll').prop('checked', isChecked);
        });
    },

    renderPagination: function(response) {
        const pagination = $('.pagination');
        pagination.empty();

        pagination.append(`
            <li class="page-item ${response.data.current_page === 1 ? 'disabled' : ''}">
                <a class="page-link" href="javascript:void(0)" data-page="${response.data.current_page - 1}" aria-label="Previous">
                    <i class="mdi mdi-chevron-left"></i>
                </a>
            </li>
        `);

        response.data.links.forEach(link => {
            if (link.label !== 'pagination.previous' && link.label !== 'pagination.next') {
                if (link.url) {
                    pagination.append(`
                        <li class="page-item ${link.active ? 'active' : ''}">
                            <a class="page-link" href="javascript:void(0)" data-page="${link.label}">${link.label}</a>
                        </li>
                    `);
                } else {
                    pagination.append(`
                        <li class="page-item disabled">
                            <span class="page-link">${link.label}</span>
                        </li>
                    `);
                }
            }
        });

        pagination.append(`
            <li class="page-item ${response.data.current_page === response.data.last_page ? 'disabled' : ''}">
                <a class="page-link" href="javascript:void(0)" data-page="${response.data.current_page + 1}" aria-label="Next">
                    <i class="mdi mdi-chevron-right"></i>
                </a>
            </li>
        `);
    },

    setValueSwitchChoices: function(selectElement, value) {
        selectElement.val(value);
    
        let instance = selectElement.data("choicesInstance");
        if (instance && value != null) {
            instance.setChoiceByValue(value.toString());
        }
    
        return instance;
    },

    enableFormValidation: function() {
        window.addEventListener("load", function () {
            var forms = document.getElementsByClassName("needs-validation");
            Array.prototype.filter.call(forms, function (form) {
                form.addEventListener("submit", function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add("was-validated");
                }, false);
            });
        }, false);
    },

    formatDate: function (dateString) {
        const date = new Date(dateString);

        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0'); 
        const year = date.getFullYear();

        return `${day}/${month}/${year}`;
    },
    
    showStoredMessage: function(storageKey, expectedPath) {
        if (window.location.pathname === expectedPath) {
            let message = localStorage.getItem(storageKey);
            if (message) {
                alertify.success(message);
                localStorage.removeItem(storageKey);
            }
        }
    },

    attachFilterEvent: function (instance) {
        $(".filter-data").find("input, select").on("input change", function () {
            clearTimeout(HT.filterTimeout);

            HT.filterTimeout = setTimeout(() => {
                instance.sendDataFilter();
            }, 500);
        });

        $(".dropdown-menu .language-filter").on("click", function () {
            let _this = $(this);
    
            $(".dropdown-menu .language-filter").removeClass('active');
            _this.addClass('active');
    
            let language_name = _this.data('name'),
                language_image = _this.data('image');
    
            $('#lang_image_select').attr('src', language_image);
            $('#lang_name_select').text(language_name);
            
            instance.sendDataFilter();
        });
    },

    formatNumberWithComma: function(value) {
        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    },

    formatNumberInputComma: function(selector = '.int') {
        $(selector).each(function () {
            let val = $(this).val().replace(/,/g, '');
            if (!isNaN(val) && val !== '') {
                $(this).val(HT.formatNumberWithComma(val));
            }

            $(this).on('input', function () {
                let raw = $(this).val().replace(/,/g, '');
                if (!isNaN(raw)) {
                    $(this).val(HT.formatNumberWithComma(raw));
                }
            });
        });
    },
};

$(document).ready(function () {
    HT.initializeChoices();
    HT.openChangeStatusAll();
    HT.openCheckStatusAll();
    HT.enableFormValidation();
});
