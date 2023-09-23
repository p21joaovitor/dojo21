let Objective = (() => {
    let handleForm = () => {
        $('#btn_register_objective').on( "click", function() {
            event.preventDefault();
            let objectiveForm = $('#objective_form').serialize();
            let responseDiv = $("#response");

            $.ajax({
                url: '/objective/save',
                type: 'POST',
                data: objectiveForm,
                success: function (data) {
                    let response = JSON.parse(data);
                    responseDiv.empty();

                    if (response.result === 'error') {
                        responseDiv.removeClass('d-none');
                        responseDiv.addClass('bg-danger');
                        responseDiv.append(response.message);
                        return;
                    }
                    window.location.href = '/objective-views';
                }
            });
        });

        $('#btn_edit_objective').on( "click", function() {
            event.preventDefault();
            let objectiveForm = $('#objective_form').serialize();
            let responseDiv = $("#response");

            $.ajax({
                url: '/objective/update',
                type: 'POST',
                data: objectiveForm,
                success: function (data) {
                    let response = JSON.parse(data);
                    responseDiv.empty();

                    if (response.result === 'error') {
                        responseDiv.removeClass('d-none');
                        responseDiv.addClass('bg-danger');
                        responseDiv.append(response.message);
                        return;
                    }

                    responseDiv.removeClass('d-none');
                    responseDiv.addClass('bg-success');
                    responseDiv.append(response.message);
                    return;
                }
            });
        });

        $('#btn_remove_objective').on( "click", function() {
            event.preventDefault();
            let objectiveId = $('#objective_id').serialize();
            let responseDiv = $("#response");

            $.ajax({
                url: '/objective/delete',
                type: 'POST',
                data: objectiveId,
                success: function (data) {
                    let response = JSON.parse(data);
                    responseDiv.empty();

                    if (response.result === 'error') {
                        responseDiv.removeClass('d-none');
                        responseDiv.addClass('bg-danger');
                        responseDiv.append(response.message);
                        return;
                    }

                    window.location.href = '/objective-views';
                }
            });
        });

        $('#btn_restore_objective').on( "click", function() {
            event.preventDefault();
            let objectiveId = $('#objective_id').serialize();
            let responseDiv = $("#response");

            $.ajax({
                url: '/objective/restore',
                type: 'POST',
                data: objectiveId,
                success: function (data) {
                    let response = JSON.parse(data);
                    responseDiv.empty();

                    if (response.result === 'error') {
                        responseDiv.removeClass('d-none');
                        responseDiv.addClass('bg-danger');
                        responseDiv.append(response.message);
                        return;
                    }

                    window.location.href = '/objective-views';
                }
            });
        });

        $('#btn_finish_objective').on( "click", function() {
            event.preventDefault();
            let objectiveId = $('#objective_id').serialize();
            let responseDiv = $("#response");

            $.ajax({
                url: '/objective/finish',
                type: 'POST',
                data: objectiveId,
                success: function (data) {
                    let response = JSON.parse(data);
                    responseDiv.empty();

                    if (response.result === 'error') {
                        responseDiv.removeClass('d-none');
                        responseDiv.addClass('bg-danger');
                        responseDiv.append(response.message);
                        return;
                    }

                    window.location.href = '/objective-views';
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