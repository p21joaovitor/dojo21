let KeyResult = (() => {
    let handleForm = () => {
        $('#btn_register_key_result').on( "click", function() {
            event.preventDefault();
            let keyResultForm = $('#key_result_form').serialize();
            let responseDiv = $("#response");

            $.ajax({
                url: '/key-result/save',
                type: 'POST',
                data: keyResultForm,
                success: function (data) {
                    let response = JSON.parse(data);
                    responseDiv.empty();

                    if (response.result === 'error') {
                        responseDiv.removeClass('d-none');
                        responseDiv.addClass('bg-danger');
                        responseDiv.append(response.message);
                        return;
                    }
                    window.location.href = '/key-result-views/list/' + response.objectiveId;
                }
            });
        });

        $('#btn_edit_key_result').on( "click", function() {
            event.preventDefault();
            let keyResultForm = $('#key_result_form').serialize();
            let responseDiv = $("#response");

            $.ajax({
                url: '/key-result/update',
                type: 'POST',
                data: keyResultForm,
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
                }
            });
        });

        $('#btn_remove_key_result').on( "click", function() {
            event.preventDefault();
            let keyResultId = $('#key_result_id').serialize();
            let responseDiv = $("#response");

            $.ajax({
                url: '/key-result/delete',
                type: 'POST',
                data: keyResultId,
                success: function (data) {
                    let response = JSON.parse(data);
                    responseDiv.empty();

                    if (response.result === 'error') {
                        responseDiv.removeClass('d-none');
                        responseDiv.addClass('bg-danger');
                        responseDiv.append(response.message);
                        return;
                    }

                    window.location.href = '/key-result-views/list/' + response.objectiveId;
                }
            });
        });

        $('#btn_restore_key_result').on( "click", function() {
            event.preventDefault();
            let keyResultId = $('#key_result_id').serialize();
            let responseDiv = $("#response");

            $.ajax({
                url: '/key-result/restore',
                type: 'POST',
                data: keyResultId,
                success: function (data) {
                    let response = JSON.parse(data);
                    responseDiv.empty();

                    if (response.result === 'error') {
                        responseDiv.removeClass('d-none');
                        responseDiv.addClass('bg-danger');
                        responseDiv.append(response.message);
                        return;
                    }

                    window.location.href = '/key-result-views/list/' + response.objectiveId;
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