
$('#form__question_subscribe').submit(function(e) {
    e.preventDefault();

    $('#question_subscribe_error').remove();
    $('#form__question_subscribe__submit_btn').addClass('disabled');

    var lang = $('html').attr('lang');
    var email = $('#email').val();
    var question_id = $('#question_id').val();

    var errorAlert = '<div id="question_subscribe_error" class="alert alert-warning mt-4" role="alert">%msg%</div>';

    $.ajax({
        type     : 'POST',
        url      : '/api/v1/' + lang + '/questions/' + question_id +'/subscribe.json',
        data     : { 'email'  : email },
        dataType : 'json',
        encode   : true
    })
    .done(function(data) {
        if (data.error_code || data.error_message) {
            $('#form__question_subscribe__submit_btn').removeClass('disabled');
            errorAlert = errorAlert.replace('%msg%', data.error_message);
            $('#form__question_subscribe').append(errorAlert);
            console.log("ERROR: " + JSON.stringify(data, undefined, 2));
        } else {
            $('#form__question_subscribe').append('<div class="alert alert-warning mt-4" role="alert">Вы успешно подписались!</div>');
        }
    })
    .fail(function(data) {
        $('#form__question_subscribe__submit_btn').removeClass('disabled');
        errorAlert = errorAlert.replace('%msg%', 'Server temporarily unavailable');
        $('#form__question_subscribe').append(errorAlert);
        console.log("FAIL: " + JSON.stringify(data, undefined, 2));
    });
});
