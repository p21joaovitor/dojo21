let KeyResult = (() => {
    let handleForm = () => {
        $('#btn_register_key_result').on( "click", function() {
            event.preventDefault();
            let keyResultForm = $('#key_result_form').serialize();

            $.ajax({
                url: '/key-result/save',
                type: 'POST',
                data: keyResultForm,
                success: function (data) {
                    let response = JSON.parse(data);
                    $("#response").empty();
                    if (response.result === 'error') {
                        $("#response").removeClass('d-none');
                        $("#response").addClass('bg-danger');
                        $("#response").append(response.message);
                        return;
                    }
                    window.location.href = '/key-result/list/' + response.objectiveId;
                    return;
                }
            });
        });

        $('#btn_edit_key_result').on( "click", function() {
            event.preventDefault();
            let keyResultForm = $('#key_result_form').serialize();

            $.ajax({
                url: '/key-result/update',
                type: 'POST',
                data: keyResultForm,
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

        $('#btn_remove_key_result').on( "click", function() {
            event.preventDefault();
            let keyResultId = $('#key_result_id').serialize();

            $.ajax({
                url: '/key-result/delete',
                type: 'POST',
                data: keyResultId,
                success: function (data) {
                    let response = JSON.parse(data);
                    $("#response").empty();
                    if (response.result === 'error') {
                        $("#response").removeClass('d-none');
                        $("#response").addClass('bg-danger');
                        $("#response").append(response.message);
                        return;
                    }

                    window.location.href = '/key-result/list/' + response.objectiveId;
                    return;
                }
            });
        });

        $('#btn_restore_key_result').on( "click", function() {
            event.preventDefault();
            let keyResultId = $('#key_result_id').serialize();

            $.ajax({
                url: '/key-result/restore',
                type: 'POST',
                data: keyResultId,
                success: function (data) {
                    let response = JSON.parse(data);
                    $("#response").empty();
                    if (response.result === 'error') {
                        $("#response").removeClass('d-none');
                        $("#response").addClass('bg-danger');
                        $("#response").append(response.message);
                        return;
                    }

                    window.location.href = '/key-result/list/' + response.objectiveId;
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
    KeyResult.init();
});