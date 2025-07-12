const Finder = {
    uploadImageToInput: function () {
        $('.upload-image').on('click', function () {
            let input = $(this),
                type = input.data('type');
            Finder.setupCKFinder2(input, type);
        });
    },

    setupCKFinder2: function (object, type) {
        type = type || 'Images';
        var finder = new CKFinder();
        finder.resourceType = type;
        finder.selectActionFunction = function (fileUrl) {
            object.val(fileUrl);
        };
        finder.popup();
    },

    uploadImageAvatar: function () {
        $('.image-target').click(function () {
            let input = $(this);
            Finder.browseServerAvatar(input);
        });
    },

    browseServerAvatar: function (object) {
        var finder = new CKFinder();
        finder.resourceType = 'Images';
        finder.selectActionFunction = function (fileUrl) {
            object.find('img').attr('src', fileUrl);
            object.siblings('input').val(fileUrl);
        };
        finder.popup();
    },

    openCKFinder: function(element, isAfter = false, inputName = 'album[]') {
        const finder = new CKFinder();
        finder.resourceType = 'Images';
        finder.selectActionFunction = function(fileUrl, data, allFiles) {
            allFiles.forEach(function(file) {
                const method = isAfter ? 'addImageToGalleryAfter' : 'addImageToGallery';
                Finder[method](file.url, element, inputName);
            });
        };
        finder.popup();
    },

    addImageToGallery: function(fileUrl, uploadContainer, inputName) {
        const uploadList = uploadContainer.siblings('.upload-list');
        const sortable = uploadList.find('#sortable');
    
        if (uploadList.hasClass('hidden')) {
            uploadList.removeClass('hidden');
            uploadContainer.addClass('hidden');
        }
    
        this.appendImageToSortable(sortable, fileUrl, inputName);
    },
    
    addImageToGalleryAfter: function(fileUrl, container, inputName) {
        const sortable = container.find('#sortable');
        this.appendImageToSortable(sortable, fileUrl, inputName);
    },

    appendImageToSortable: function(sortable, fileUrl, inputName = 'album[]') {
        sortable.append(`
            <li class="ui-state-default">
                <div class="thumb">
                    <span class="span image img-scaledown">
                        <img src="${fileUrl}" alt="${fileUrl}">
                        <input type="hidden" name="${inputName}" value="${fileUrl}">
                    </span>
                    <button type="button" class="delete-image"><i class="bx bx-trash"></i></button>
                </div>
            </li>
        `);
    },

    bindUploadPictureEvent: function() {
        $(document).off('click', '.upload-picture').on('click', '.upload-picture', function(e) {
            if (!$(e.target).closest('.delete-image').length) {
                e.preventDefault();
                
                const $this = $(this);
                const isClickToUpload = $this.closest('.click-to-upload').length > 0;
                const element = isClickToUpload ? $this.closest('.click-to-upload') : $this;
                const inputName = $this.data('name') || 'album[]';
    
                Finder.openCKFinder(element, !isClickToUpload, inputName);
            }
        });
    },
    
    enableSortable: function () {
        const $sortable = $('.upload-list #sortable');
        if ($sortable.length && typeof $sortable.sortable === 'function') {
            $sortable.sortable({
                placeholder: 'sortable-placeholder',
                update: function () {
                    Finder.updateImageOrder();
                }
            }).disableSelection();
        } else {
            // console.warn('sortable not available or element not found');
        }
    },

    updateImageOrder: function () {
        $('.upload-list #sortable').each(function () {
            let images = [];
            $(this).find("li").each(function () {
                let imageUrl = $(this).find("input[name='album[]']").val();
                images.push(imageUrl);
            });
        });
    },

    deleteImage: function () {
        $(document).on("click", ".delete-image", function (e) {
            e.preventDefault();
            e.stopPropagation();

            let listItem = $(this).closest("li");
            let uploadList = listItem.closest('.upload-list');
            let uploadContainer = uploadList.siblings('.click-to-upload');

            listItem.remove();
            Finder.updateImageOrder();

            if (uploadList.find('#sortable li').length === 0) {
                console.log(123);
                uploadList.addClass('hidden');
                uploadContainer.removeClass('hidden');
            }
        });
    },
};

$(document).ready(function () {
    Finder.uploadImageToInput();
    Finder.uploadImageAvatar();
    Finder.bindUploadPictureEvent();
    Finder.enableSortable();
    Finder.deleteImage();
});