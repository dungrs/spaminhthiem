const System = {
    submitFormData: function (url) {
        let activeTab = document.querySelector('.tab-pane.active.show');
    
        if (!activeTab) {
            alertify.error('Không tìm thấy tab đang hiển thị!');
            return;
        }
    
        $(activeTab).find('.ckeditor-classic').each(function () {
            let editorInstance = this.ckEditorInstance || ClassicEditor.instances?.[this.id];
            if (editorInstance) {
                this.value = editorInstance.getData();
            }
        });
    
        let formData = new FormData();
        $(activeTab).find('input, select, textarea').each(function () {
            if (this.name) {
                if (this.type === 'file' && this.files.length > 0) {
                    formData.append(this.name, this.files[0]);
                } else {
                    formData.append(this.name, $(this).val());
                }
            }
        });
    
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

            let url = '/ajax/system/create';
            System.submitFormData(url);
        });
    },

};

$(document).ready(function () {
    System.bindStoreAndUpdateEntityHandler();
});