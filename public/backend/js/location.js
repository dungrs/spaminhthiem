var LC = {
    getLocation: function() {
        $(document).on('change', '.location', function() {
            let _this = $(this);
            let formData = {
                data: {
                    location_id: _this.val()
                },
                target: _this.data('target')
            };

            LC.sendDataGetLocation(formData);

            if (_this.hasClass("provinces")) {
                LC.resetChoices(".districts", "[Chọn Quận/Huyện]");
                LC.resetChoices(".wards", "[Chọn Phường/Xã]");
            }

            if (_this.hasClass("districts")) {
                LC.resetChoices(".wards", "[Chọn Phường/Xã]");
            }
        });
    },

    initializeChoices: function () {
        $(".choice-single-location").each(function () {
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

    resetChoices: function(selector, placeholderText) {
        let select = $(selector);
        let instance = select.data("choicesInstance");
        if (instance) {
            instance.clearChoices();
            instance.setChoices([{ value: "", label: placeholderText, selected: true }]);
        }
    },
    
    sendDataGetLocation: function (formData) {
        $.ajax({
            url: '/ajax/location/getLocation',
            type: 'GET',
            data: formData,
            dataType: 'json',
            success: function (res) {
                let targetElement = $(`.${formData.target}`),
                    instance = targetElement.data("choicesInstance");
    
                if (instance) {
                    instance.setChoices(res.data, "value", "label", false);
                } else {
                    let newInstance = new Choices(targetElement[0], {
                        placeholderValue: "",
                        searchPlaceholderValue: "Tìm kiếm...",
                        itemSelectText: "",
                        shouldSort: false
                    });
                    targetElement.data("choicesInstance", newInstance);
                    newInstance.setChoices(res.data, "value", "label", true);
                }
    
                if (formData.callback && typeof formData.callback == 'function') {
                    formData.callback();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Lỗi: ' + textStatus + ' ' + errorThrown);
            }
        });
    },

    loadInitialData: function(provinceId, districtId) {
        if (provinceId) {
            LC.sendDataGetLocation({
                data: { location_id: provinceId },
                target: "districts"
            });
        }

        if (districtId) {
            LC.sendDataGetLocation({
                data: { location_id: districtId },
                target: "wards"
            });
        }
    }
};

$(document).ready(function() {
    LC.initializeChoices();
    LC.getLocation();
});