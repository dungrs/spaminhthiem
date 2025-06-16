var Editor = {
    setupCKEditor: function () {
        var editors = document.querySelectorAll(".ckeditor-classic");
        if (editors.length === 0) {
            console.warn("CKEditor: Không tìm thấy phần tử .ckeditor-classic.");
            return;
        }

        editors.forEach(function (editorElement) {
            ClassicEditor.create(editorElement, {
                ckfinder: {
                    uploadUrl: '' // Không cần upload mặc định, sẽ dùng CKFinder
                }
            })
            .then(function (editor) {
                editor.ui.view.editable.element.style.height = "200px";
                editorElement.ckEditorInstance = editor; // Gán CKEditor vào textarea

                if (editorElement.hasAttribute("disabled")) {
                    editor.isReadOnly = true; // Sửa lỗi enableReadOnlyMode
                }
            })
            .catch(function (error) {
                console.error("Lỗi CKEditor:", error);
            });
        });
    },

    insertImageToEditor: function (editor, imageUrl) {
        if (editor.isReadOnly) {
            console.warn("CKEditor đang ở chế độ chỉ đọc, không thể chèn ảnh.");
            return;
        }

        editor.model.change(writer => {
            const imageElement = writer.createElement('image', {
                src: imageUrl
            });
            editor.model.insertContent(imageElement, editor.model.document.selection);
        });
    },

    openCKFinderAndInsertImage: function(button) {
        var editorElement = $(button).closest(".mb-3").find(".ckeditor-classic")[0];
        if (!editorElement || !editorElement.ckEditorInstance) {
            console.warn("CKEditor chưa khởi tạo!");
            return;
        }

        var editor = editorElement.ckEditorInstance;

        if (editor.isReadOnly) {
            console.warn("CKEditor đang ở chế độ chỉ đọc, không thể tải ảnh.");
            return;
        }

        var finder = new CKFinder();
        
        finder.selectActionFunction = function (fileUrl) {
            Editor.insertImageToEditor(editor, fileUrl);
        };
        
        finder.popup();
    },

    initCKFinderUploadButton: function() {
        $(".upload-image-ckeditor").click(function (e) {
            e.preventDefault();
            Editor.openCKFinderAndInsertImage(this);
        });
    }
};

$(document).ready(function () {
    Editor.setupCKEditor();
    Editor.initCKFinderUploadButton();
});
