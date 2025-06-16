var SEO = {
    init: function () {
        this.bindEvents();
    },

    bindEvents: function () {
        $(document).on("input", "#meta_title", function () {
            SEO.updateText(this, ".meta_title", Config.seoDefaultMessage.no_seo_title);
        });

        $(document).on("input", "#meta_description", function () {
            SEO.updateText(this, ".meta_description", Config.seoDefaultMessage.no_seo_description);
        });

        $(document).on("input", "#canonical", function () {
            let inputVal = $(this).val().trim();
            let slug = SEO.removeUtf8(inputVal);
            let displayUrl = inputVal ? Config.baseUrl + '/' + slug + ".html" : Config.seoDefaultMessage.default_canonical;
            $(".canonicalText").text(displayUrl);
        });

        $(document).on("input", "#meta_title_trans", function () {
            SEO.updateText(this, ".meta_title_trans", Config.seoDefaultMessage.no_seo_title);
        });

        $(document).on("input", "#meta_description_trans", function () {
            SEO.updateText(this, ".meta_description_trans", Config.seoDefaultMessage.no_seo_description);
        });

        $(document).on("input", "#canonical_trans", function () {
            let inputVal = $(this).val().trim();
            let slug = SEO.removeUtf8(inputVal);
            let displayUrl = inputVal ? Config.baseUrl + '/' + slug + ".html" : Config.seoDefaultMessage.default_canonical;
            $(".canonicalTextTranslate").text(displayUrl);
        });
    },

    updateText: function (input, target, defaultText) {
        let value = $(input).val().trim();
        $(target).text(value || defaultText);
    },

    removeUtf8: function (str) {
        return str.toLowerCase()
            .replace(/à|á|ả|ạ|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a")
            .replace(/è|é|ẻ|ẹ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e")
            .replace(/ì|í|ỉ|ị|ĩ/g, "i")
            .replace(/ò|ó|ỏ|ọ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o")
            .replace(/ù|ú|ủ|ụ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u")
            .replace(/ỳ|ý|ỷ|ỵ|ỹ/g, "y")
            .replace(/đ/g, "d")
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, "-")
            .replace(/^-+|-+$/g, "");
    }
};

$(document).ready(function () {
    SEO.init();
});
