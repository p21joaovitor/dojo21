let Login = (() => {
    let handleForm = () => {
        $('#btn_logar').on( "click", function() {
            event.preventDefault();
            let loginForm = $('#login_form').serialize();
            let responseDiv = $("#response");
            responseDiv.empty();

            if (!validatorEmail(email.value)) {
                responseDiv.removeClass('d-none');
                responseDiv.addClass('bg-danger');
                responseDiv.append('Favor fornecer um e-mail valido!');
                return;
            }

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
                }
            });
        });

        $('#btn_register').on( "click", function() {
            event.preventDefault();

            window.location.href = '/user/register';
        })

        function validatorEmail(email)
        {
            let regex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            return regex.test(email);
        }
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