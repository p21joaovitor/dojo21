let User = (() => {
    let handleForm = () => {
        $('#btn_register').on( "click", function() {
            event.preventDefault();
            let registerForm = $('#register_form').serialize();
            let responseDiv = $("#response");
            responseDiv.empty();

            if (!validatorEmail(email.value)) {
                responseDiv.removeClass('d-none');
                responseDiv.addClass('bg-danger');
                responseDiv.append('Favor fornecer um e-mail valido!');
                return;
            }

            if (!passwordSize(password.value)) {
                responseDiv.removeClass('d-none');
                responseDiv.addClass('bg-danger');
                responseDiv.append('A senha deve conter no mínimo 6 dígitos!');
                return;
            }

            $.ajax({
                url: 'save',
                type: 'POST',
                data: registerForm,
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

        function validatorEmail(email)
        {
            let regex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            return regex.test(email);
        }

        function passwordSize(password)
        {
            if (password.length < 6) {
                return false
            }

            return true;
        }
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