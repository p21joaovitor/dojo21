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
                    window.location.href = '/objective';
                    return;
                }
            });
        });

        $('#btn_edit_objective').on( "click", function() {
            event.preventDefault();
            let objectiveForm = $('#objective_form').serialize();

            $.ajax({
                url: '/objective/update',
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

                    $("#response").removeClass('d-none');
                    $("#response").addClass('bg-success');
                    $("#response").append(response.message);
                    return;
                    return;
                }
            });
        });

        $('#btn_remove_objective').on( "click", function() {
            event.preventDefault();
            let objectiveId = $('#objective_id').serialize();

            $.ajax({
                url: '/objective/delete',
                type: 'POST',
                data: objectiveId,
                success: function (data) {
                    let response = JSON.parse(data);
                    $("#response").empty();
                    if (response.result === 'error') {
                        $("#response").removeClass('d-none');
                        $("#response").addClass('bg-danger');
                        $("#response").append(response.message);
                        return;
                    }

                    window.location.href = '/objective';
                    return;
                }
            });
        });

        $('#btn_restore_objective').on( "click", function() {
            event.preventDefault();
            let objectiveId = $('#objective_id').serialize();

            $.ajax({
                url: '/objective/restore',
                type: 'POST',
                data: objectiveId,
                success: function (data) {
                    let response = JSON.parse(data);
                    $("#response").empty();
                    if (response.result === 'error') {
                        $("#response").removeClass('d-none');
                        $("#response").addClass('bg-danger');
                        $("#response").append(response.message);
                        return;
                    }

                    window.location.href = '/objective';
                    return;
                }
            });
        });

        $('#btn_finish_objective').on( "click", function() {
            event.preventDefault();
            let objectiveId = $('#objective_id').serialize();

            $.ajax({
                url: '/objective/finish',
                type: 'POST',
                data: objectiveId,
                success: function (data) {
                    let response = JSON.parse(data);
                    $("#response").empty();
                    if (response.result === 'error') {
                        $("#response").removeClass('d-none');
                        $("#response").addClass('bg-danger');
                        $("#response").append(response.message);
                        return;
                    }

                    window.location.href = '/objective';
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