
$('#form__update_topics').submit(function(e) {
    e.preventDefault();

    $('#form__update_topics__error').remove();
    $('#form__update_topics__submit').addClass('disabled');

    var lang = $('html').attr('lang');
    var question_id = $('#form__update_topics').data("question-id");
    var new_topics = $('input#new_topics').val();
    var api_key = $.cookie('u_api_key');
    var url = '/api/v1/' + lang + '/questions/' + question_id + '/topics.json';

    console.log("question_id: " + question_id + "\n");
    console.log("new_topics: " + new_topics + "\n");
    console.log("PUT url: " + url + "\n");

    var form_data = {
        'api_key' : api_key,
        'question_id' : question_id,
        'new_topics' : new_topics,
    };

    $.ajax({
        type     : 'PUT',
        url      : url,
        data     : form_data,
        dataType : 'json',
        encode   : true
    })
    .done(function(data) {
        if (data.error_code || data.error_message) {
            $('#form__update_topics__submit').removeClass('disabled');
            $('#form__update_topics').append('<div id="form__update_topics__error" class="alert alert-warning" role="alert"><strong>Warning!</strong> ' + data.error_message + '</div>');
        } else {
            window.location = data.question.url;
            //console.log("OK: " + JSON.stringify(data, undefined, 2));
        }
    })
    .fail(function(data) {
        $('#form__update_topics__submit').removeClass('disabled');
        $('#form__update_topics').append('<div id="form__update_topics__error" class="alert alert-warning" role="alert"><strong>Error!</strong> Service is temporarily unavailable, please try again later.</div>');
        console.log("Error: " + JSON.stringify(data, undefined, 2));
    });

});
