const Auth = {
    togglePasswordVisibility: function() {
        $(".password-addon").on('click', function() {
            let _this = $(this),
                passwordInput = _this.closest('.password-form').find('.password-input')
        
            if (passwordInput.attr('type') == "password") {
                passwordInput.attr('type', "text");
            } else {
                passwordInput.attr('type', "password")
            }
        })
    },

    updateUrlOnTabChange: function() {
        $('#authTab button[data-href]').on('click', function() {
            var href = $(this).data('href');
            if (href) {
                history.pushState(null, '', href);
            }
        });

        var path = window.location.pathname;
        if (path.includes('dang-ki')) {
            $('#register-tab').click();
        } else if (path.includes('dang-nhap')) {
            $('#login-tab').click();
        }
    },

    setupDatetimePickerBasic: function() {
        flatpickr(".datepicker-basic", {
            enableTime: false,
            dateFormat: "d/m/Y", 
            allowInput: true, 
            onReady: function(selectedDates, dateStr, instance) {
                setTimeout(function() {
                    let yearInput = instance.calendarContainer.querySelector(".numInput.cur-year");
                    if (yearInput) {
                        yearInput.removeAttribute("tabindex"); 
                    }
                }, 10);
            }
        });
    },

    setupLocation: function() {
        
    }
};

$(document).ready(function () {
    Auth.togglePasswordVisibility();
    Auth.updateUrlOnTabChange();
    Auth.setupDatetimePickerBasic();
});