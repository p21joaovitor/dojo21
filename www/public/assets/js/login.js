let Login = (() => {
    let handleForm = () => {
        $('#btn_logar').on( "click", function() {
            event.preventDefault();
            let loginForm = $('#login_form').serialize();

            $.ajax({
                url: 'user/login',
                type: 'POST',
                data: loginForm,
                success: function (data) {
                    let response = JSON.parse(data);
                    if (response.result === 'error') {
                        $("#response").removeClass('d-none');
                        $("#response").addClass('bg-danger');
                        $("#response").append(response.message);
                        return;
                    }
                    console.log('aki');
                    window.location.href = '/home';
                    return;
                }
            });
        });

        $('#btn_register').on( "click", function() {
            event.preventDefault();

            window.location.href = '/user/register';
        })
    }

    return {
        init: () => {
            handleForm();
        }
    }
})();

$(document).ready(() => {
   Login.init();
});