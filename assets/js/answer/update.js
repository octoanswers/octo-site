
$('#form__update_answer').submit(function(e) {
    e.preventDefault();

    $('#form__update_answer__error').remove();
    $('#form__update_answer__submit').addClass('disabled');

    var lang = $('html').attr('lang');
    var answer_id = $('#form__update_answer').data("answer-id");
    var answer_text = simplemde.value();
    var changes_comment = $('input#form__update_answer__changes_comment').val();
    var api_key = $.cookie('u_api_key');
    var url = '/api/v1/' + lang + '/answers/' + answer_id + '.json';

    // console.log("answer_id: " + answer_id + "\n");
    //console.log("answer_text: " + answer_text + "\n");
    // console.log("changes_comment: " + changes_comment + "\n");
    console.log("api_key: " + api_key + "\n");
    console.log("PUT url: " + url + "\n");

    var form_data = {
        'answer_id' : answer_id,
        'answer_text' : answer_text,
        'changes_comment': changes_comment,
        'user_api_key'   : api_key,
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
            $('#form__update_answer__submit').removeClass('disabled');
            $('#form__update_answer').append('<div id="form__update_answer__error" class="alert alert-warning" role="alert"><strong>Warning!</strong> ' + data.error_message + '</div>');
        } else {
            window.location = data.question_url;
            //console.log("OK: " + JSON.stringify(data, undefined, 2));
        }
    })
    .fail(function(data) {
        $('#form__update_answer__submit').removeClass('disabled');
        $('#form__update_answer').append('<div id="form__update_answer__error" class="alert alert-warning" role="alert"><strong>Error!</strong> Service is temporarily unavailable, please try again later.</div>');
        console.log("Error: " + JSON.stringify(data, undefined, 2));
    });

});
