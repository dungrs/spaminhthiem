const Translate = {
    submitFormData: function (url, formData) {
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

    bindSubmitEntityHandler: function () {
        $(document).on('click', '.submitButton', function (e) {
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
                language_id = activeTab.find('input[name="language_id"]').val() || ''
                description = activeTab.find('textarea[name="description_trans"]').val() || '',
                content = activeTab.find('textarea[name="content_trans"]').val() || '',
                meta_title = activeTab.find('input[name="meta_title_trans"]').val() || '',
                meta_keyword = activeTab.find('input[name="meta_keyword_trans"]').val() || '',
                meta_description = activeTab.find('textarea[name="meta_description_trans"]').val() || '',
                canonical = activeTab.find('input[name="canonical_trans"]').val() || '',
                option = {
                    id: form.find('input[name="option[id]"]').val() || '',
                    language_id: form.find('input[name="option[language_id]"]').val() || '',
                    model: form.find('input[name="option[model]"]').val() || '',
                    modelParent: form.find('input[name="option[modelParent]"]').val() || '',
            };

            let canonicalOriginal = canonical.trim();
            let canonicalSlug = SEO.removeUtf8(canonicalOriginal);

            formData = {
                option: option,
                language_id: language_id,
                name_trans: name,
                description_trans: description,
                content_trans: content,
                meta_title_trans: meta_title,
                meta_keyword_trans: meta_keyword,
                meta_description_trans: meta_description,
                canonical_trans: canonicalSlug,
                _token: HT._token,
            };

            url = `/ajax/language/storeTranslate`;
            Translate.submitFormData(url, formData);
        });
    },
};

$(document).ready(function () {
    Translate.bindSubmitEntityHandler();
});