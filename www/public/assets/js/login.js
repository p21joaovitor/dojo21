let Login = (() => {

    let handleForm = () => {
        $('#btn_logar').on( "click", function() {
            event.preventDefault();
            let loginForm = $('#login_form').serialize();

            $.ajax({
                url: '/user/login',
                type: 'POST',
                data: loginForm,
                success: function (data) {
                    window.location.href = 'tela_inicial.php';
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
   Login.init();
});