const Library = {
    setValueSwitchChoices: function(selectElement, value) {
        selectElement.val(value);
    
        let instance = selectElement.data("choicesInstance");
        if (instance && value != null) {
            instance.setChoiceByValue(value.toString());
        }
    
        return instance;
    },

    setupLocation: function() {
        let provinceSelect = $('select[name="province_id"]'),
            districtSelect = $('select[name="district_id"]'),
            wardSelect = $('select[name="ward_id"]');
        
        let provinceValue = $('select[name="province_id"]').data('value'),
            districtValue = $('select[name="district_id"]').data('value'),
            wardValue = $('select[name="ward_id"]').data('value');
        
        if (districtValue) {
            HT.setValueSwitchChoices(provinceSelect, provinceValue);
            LC.sendDataGetLocation({
                data : { location_id : provinceValue },
                target: "districts",
                callback: function() {
                    if (districtValue) {
                        HT.setValueSwitchChoices(districtSelect, districtValue);
                        LC.sendDataGetLocation({
                            data: { location_id : districtValue },
                            target: "wards",    
                            callback: function() {
                                if (wardValue) {
                                    HT.setValueSwitchChoices(wardSelect, wardValue);
                                }
                            }
                        })
                    }
                }
            })
        }
    },

    initAvatarPreview: function(inputSelector, imgSelector) {
        $(document).on('change', inputSelector, function (e) {
            const file = this.files[0];
            const $img = $(imgSelector);
    
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $img.attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    },

    addCommas: function(nStr) { 
        nStr = String(nStr);
        nStr = nStr.replace(/\./gi, "");
        let str ='';
        for (let i = nStr.length; i > 0; i -= 3){
            let a = ( (i-3) < 0 ) ? 0 : (i-3);
            str= nStr.slice(a,i) + '.' + str;
        }
        str= str.slice(0,str.length-1);
        return str;
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

        if (response.data.links.length > 3) {
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
        }

        pagination.append(`
            <li class="page-item ${response.data.current_page === response.data.last_page ? 'disabled' : ''}">
                <a class="page-link" href="javascript:void(0)" data-page="${response.data.current_page + 1}" aria-label="Next">
                    <i class="mdi mdi-chevron-right"></i>
                </a>
            </li>
        `);
    },

    // initReviewReplyHandlers: function() {
    //     $('.btn-reply').on('click', function () {
    //         const reviewId = $(this).data('review-id');
    //         const replyForm = $(`#reply-form-${reviewId}`);

    //         $('.reply-form').hide();

    //         replyForm.show();

    //         $('html, body').animate({
    //             scrollTop: replyForm.offset().top - 100
    //         }, 300);
    //     });

    //     $('.btn-cancel-reply').on('click', function () {
    //         const reviewId = $(this).data('review-id');
    //         $(`#reply-form-${reviewId}`).hide();
    //     });

    //     $('.reply-form-inner').on('submit', function (e) {
    //         e.preventDefault();

    //         const form = $(this);
    //         const reviewId = form.data('review-id');
    //         const content = form.find('.reply-textarea').val();

    //         // Gửi AJAX ở đây nếu cần
    //         console.log(`Gửi phản hồi cho review ${reviewId}: ${content}`);

    //         // Sau khi gửi thành công
    //         form.closest('.reply-form').hide();
    //         form.find('.reply-textarea').val('');
            
    //     });
    // }
};

$(document).ready(function () {
    Library.setupLocation();
    // Library.initReviewReplyHandlers(); 
    Library.initAvatarPreview('#avatar', '#avatarPreview');
});
