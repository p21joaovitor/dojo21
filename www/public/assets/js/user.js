let User = (() => {
    let handleForm = () => {
        $('#btn_register').on( "click", function() {
            event.preventDefault();
            let registerForm = $('#register_form').serialize();

            $.ajax({
                url: 'save',
                type: 'POST',
                data: registerForm,
                success: function (data) {
                    let response = JSON.parse(data);
                    $("#response").empty();
                    if (response.result === 'error') {
                        $("#response").removeClass('d-none');
                        $("#response").addClass('bg-danger');
                        $("#response").append(response.message);
                        return;
                    }
                    window.location.href = '/home';
                    return;
                }
            });
        });
    }

    return {
        init: () => {
            handleForm();
        }
    }
})();
$(document).ready(() => {
   User.init();
});