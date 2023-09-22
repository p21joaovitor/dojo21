let Login = (() => {
    let handleForm = () => {
        $('#btn_logar').on( "click", function() {
            event.preventDefault();
            let loginForm = $('#login_form').serialize();
            let responseDiv = $("#response");

            $.ajax({
                url: 'auth/authenticate',
                type: 'POST',
                data: loginForm,
                success: function (data) {
                    let response = JSON.parse(data);
                    responseDiv.empty();
                    if (response.result === 'error') {
                        responseDiv.removeClass('d-none');
                        responseDiv.addClass('bg-danger');
                        responseDiv.append(response.message);
                        return;
                    }
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