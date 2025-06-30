var Library = {
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
};

$(document).ready(function () {
    Library.setupLocation();
    Library.initAvatarPreview('#avatar', '#avatarPreview');
});
