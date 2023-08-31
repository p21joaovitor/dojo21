let User = (() => {
    let handleForm = () => {
        $('#user-form').submit(function (event) {
            let userForm = $(this).serialize();

            event.preventDefault();
            $.ajax({
                url: '/user/save',
                type: 'POST',
                data: userForm,
                success: function (data) {
                    let response = JSON.parse(data);

                    if(response.result !== 'success'){
                        alert('Nome inválido ou não preenchido!');
                    }
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