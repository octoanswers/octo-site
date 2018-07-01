
$('#form__question_create_from_main').submit(function(e) {
    e.preventDefault();

    $('#question_create_error').remove();
    $('#form__question_create_from_main__submit_btn').addClass('disabled');

    if ($('#form__question_create_from_main__title').length) {
        var question_title = $('#form__question_create_from_main__title').val();
    } else {
        var question_title = $('#form__question_create_from_main').data("question-title");
    }

    var lang = $('html').attr('lang');

    var errorAlert = '<div id="question_create_error" class="alert alert-warning" role="alert">%msg%</div>';
    console.log("\nquestion_lang: " + lang);
    console.log("\nquestion_title: " + question_title);

    var data = {
        'title' : question_title,
    };

    $.ajax({
        type     : 'POST',
        url      : '/api/v1/' + lang + '/questions.json',
        data     : data,
        dataType : 'json',
        encode   : true
    })
    .done(function(data) {
        if (data.error_code || data.error_message) {
            $('#form__question_create_from_main__submit_btn').removeClass('disabled');
            errorAlert = errorAlert.replace('%msg%', data.error_message);
            $('#form__question_create_from_main').append(errorAlert);
            console.log("ERROR: " + JSON.stringify(data, undefined, 2));
        } else {
            console.log("OK: " + JSON.stringify(data, undefined, 2));
            window.location = data.url;
        }
    })
    .fail(function(data) {
        $('#form__question_create_from_main__submit_btn').removeClass('disabled');
        errorAlert = errorAlert.replace('%msg%', 'Server temporarily unavailable');
        $('#form__question_create_from_main').append(errorAlert);
        console.log("FAIL: " + JSON.stringify(data, undefined, 2));
    });
});

// Ctrl-Enter pressed
$('#form__question_create_from_main__title').keydown(function (e) {
    if (e.ctrlKey && e.keyCode == 13) {
        $('#form__question_create_from_main').submit()
    }
});
