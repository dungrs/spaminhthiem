var LG = {
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
    }
};

$(document).ready(function() {
    LG.togglePasswordVisibility();
});