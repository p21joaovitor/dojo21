let Objective = (() => {
    let handleForm = () => {
        $('#btn_register_objective').on( "click", function() {
            event.preventDefault();
            let objectiveForm = $('#objective_form').serialize();

            $.ajax({
                url: 'save',
                type: 'POST',
                data: objectiveForm,
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
    Objective.init();
});