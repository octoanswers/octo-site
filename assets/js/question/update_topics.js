
$('#form__update_hashtags').submit(function (e) {
    e.preventDefault();

    $('#form__update_hashtags__error').remove();
    $('#form__update_hashtags__submit').addClass('disabled');

    var lang = $('html').attr('lang');
    var question_id = $('#form__update_hashtags').data("question-id");
    var new_hashtags = $('input#new_hashtags').val();
    var api_key = $.cookie('u_api_key');
    var url = '/api/v1/' + lang + '/questions/' + question_id + '/hashtags.json';

    console.log("question_id: " + question_id + "\n");
    console.log("new_hashtags: " + new_hashtags + "\n");
    console.log("PUT url: " + url + "\n");

    var form_data = {
        'api_key': api_key,
        'question_id': question_id,
        'new_hashtags': new_hashtags,
    };

    $.ajax({
        type: 'PUT',
        url: url,
        data: form_data,
        dataType: 'json',
        encode: true
    })
        .done(function (data) {
            if (data.error_code || data.error_message) {
                $('#form__update_hashtags__submit').removeClass('disabled');
                $('#form__update_hashtags').append('<div id="form__update_hashtags__error" class="alert alert-warning" role="alert"><strong>Warning!</strong> ' + data.error_message + '</div>');
            } else {
                window.location = data.question.url;
                //console.log("OK: " + JSON.stringify(data, undefined, 2));
            }
        })
        .fail(function (data) {
            $('#form__update_hashtags__submit').removeClass('disabled');
            $('#form__update_hashtags').append('<div id="form__update_hashtags__error" class="alert alert-warning" role="alert"><strong>Error!</strong> Service is temporarily unavailable, please try again later.</div>');
            console.log("Error: " + JSON.stringify(data, undefined, 2));
        });

});
