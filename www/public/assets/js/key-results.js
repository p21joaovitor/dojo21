let KeyResult = (() => {
    let handleForm = () => {
        $('#key-result-form').submit(function (event) {
            let keyResultForm = $(this).serialize();

            event.preventDefault();

            $.ajax({
                url: '/key-result/save',
                type: 'POST',
                data: keyResultForm,
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
    KeyResult.init();
});