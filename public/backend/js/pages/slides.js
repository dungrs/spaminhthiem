const Slide = {
    counter:  1,
    addSlide: function(type) {
        $(document).on('click', '.addSlide', function(e) {
            e.preventDefault();
            if (typeof(type) == 'undefined') {
                type = "Images";
            }
            
            var finder = new CKFinder();
            finder.resourceType = type;
            finder.selectActionFunction = function(fileUrl, data, allFiles) {
                for (var i = 0; i < allFiles.length; i++) {
                    var image = allFiles[i].url;
                    $('.slide-list').append(Slide.renderSlideItemHtml(image))
                    Slide.checkSlideNotification();
                }
            }

            finder.popup();
        })
    },

    checkSlideNotification: function() {
        let slideItem = $('.slide-image')
        if (slideItem.length) {
            $('.slide-notification').addClass('hidden')
        } else {
            $('.slide-notification').removeClass('hidden')
        }
    },

    renderSlideItemHtml: function(image) {
        let slide_info = "slide-info-" + Slide.counter;
        let slide_seo = "slide-seo-" + (Slide.counter + 1)

        let html = `
                <div class="card mb-4 border position-relative slide-item">
                    <div class="row g-0">
                        <!-- Slide Image with Hover Effect -->
                        <div class="col-md-4 position-relative">
                            <div class="ratio ratio-16x9 h-100">
                                <img class="img-fluid card-img object-fit-cover slide-image" src="${image}" alt="Slide preview">
                                <input type="hidden" name="slide[image][]" value="${image}">
                            </div>
                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 start-0 m-2 deleteSlide z-3" style="width: 30px; height: 30px;">
                                <i class="bx bx-trash"></i>
                            </button>
                        </div>
                        
                        <!-- Slide Content -->
                        <div class="col-md-8">
                            <div class="card-body p-0 h-100 d-flex flex-column">
                                <!-- Tabs Navigation -->
                                <ul class="nav nav-tabs nav-tabs-custom px-3 pt-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#${slide_info}" role="tab">
                                            <i class="bx bx-info-circle d-md-none"></i>
                                            <span class="d-none d-md-inline">Thông tin chung</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#${slide_seo}" role="tab">
                                            <i class="bx bx-search-alt d-md-none"></i>
                                            <span class="d-none d-md-inline">SEO</span>
                                        </a>
                                    </li>
                                </ul>
                
                                <!-- Tab Content -->
                                <div class="tab-content p-3 flex-grow-1">
                                    <!-- General Info Tab -->
                                    <div class="tab-pane fade show active" id="${slide_info}" role="tabpanel">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label fw-medium">Mô tả slide </label>
                                                <textarea class="form-control" 
                                                          name="slide[description][]" 
                                                          rows="3"
                                                          placeholder="Nhập mô tả cho slide..."
                                                          required></textarea>
                                            </div>
                                            <div class="col-md-8">
                                                <label class="form-label fw-medium">Đường dẫn tĩnh</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">${Config.baseUrl}/</span>
                                                    <input type="text" 
                                                           name="slide[canonical][]" 
                                                           class="form-control"
                                                           placeholder="slide-1">
                                                </div>
                                            </div>
                                            <div class="col-md-4 d-flex align-items-end">
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox" name="slide[window][]" id="window_${Slide.counter}" value="_blank" role="switch">
                                                    <label class="form-check-label fw-medium" for="window_${Slide.counter}">Mở tab mới</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- SEO Tab -->
                                    <div class="tab-pane fade" id="${slide_seo}" role="tabpanel">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label fw-medium">Tiêu đề ảnh (ALT)</label>
                                                <input type="text" 
                                                       name="slide[name][]" 
                                                       class="form-control"
                                                       placeholder="Nhập tiêu đề SEO...">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label fw-medium">Mô tả ảnh (Title)</label>
                                                <input type="text" 
                                                       name="slide[alt][]" 
                                                       class="form-control"
                                                       placeholder="Nhập mô tả SEO...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">
        `
        Slide.counter += 2;
        return html;
    },

    deleteSlide: function() {
        $(document).on('click', '.deleteSlide', function(e) {
            e.preventDefault();
            $(this).closest('.slide-item').remove();
            Slide.checkSlideNotification();
        });
    },

    submitFormData: function (url) {
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
                    localStorage.setItem("slideMessage", response.message);
                    window.location.href = "/slide/index";
                } else {
                    alertify.error(response.message);
                }
            },
            error: function (xhr) {
                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    HT.displayValidationErrors(xhr.responseJSON.errors);
                    if (xhr.responseJSON.errors['slide.image']) {
                        alertify.error(xhr.responseJSON.errors['slide.image'].join(', '));
                    }
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
            let url = id ? `/ajax/slide/update/${id}` : '/ajax/slide/create';
            Slide.submitFormData(url);
        });
    },

    sendDataFilter: function (page = 1) {
        if (!window.location.pathname.includes('/slide/index')) {
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
            url: '/ajax/slide/filter',
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
                                            <a href="${Config.baseUrl}/slide/edit/${item.id}" class="dropdown-item edit-button-modal">
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
                HT.handleDeleteRequest(".delete-btn", "/ajax/slide/delete", Slide);
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
            
            Slide.sendDataFilter(HT.currentPage);
        });
    },

    attachFilterEvent: function () {
        $(".filter-data").find("input, select").on("input change", function () {
            clearTimeout(HT.filterTimeout);

            HT.filterTimeout = setTimeout(() => {
                Slide.sendDataFilter();
            }, 500);
        });
    },
};

$(document).ready(function () {
    Slide.addSlide();
    Slide.deleteSlide();
    Slide.bindStoreAndUpdateEntityHandler();
    Slide.sendDataFilter();
    Slide.attachFilterEvent();
    Slide.attachPaginationEvent();
    HT.showStoredMessage("slideMessage", "/slide/index");
    HT.attachFilterEvent(Slide);
});