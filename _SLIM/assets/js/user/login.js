
$('#form__login').submit(function(e) {
    e.preventDefault();

    $('#form__login__error').remove();
    $('#form__login__submit').addClass('disabled');

    var lang = $('html').attr('lang');
    var url = '/api/v1/' + lang + '/login.json';

    var formData = {
        'email'    : $('input#form__login__email').val(),
        'password' : $('input#form__login__password').val()
    };

    $.ajax({
        type     : 'POST',
        url      : url,
        data     : formData,
        dataType : 'json',
        encode   : true
    })
    .done(function(data) {
        if (data.error_code || data.error_message) {
            $('#form__login__submit').removeClass('disabled');
            $('#form__login').append('<div id="form__login__error" class="alert alert-warning" role="alert"><strong>Warning!</strong> ' + data.error_message + '</div>');
        } else {
            window.location = data.destination_url;
        }
    })
    .fail(function(data) {
        $('#form__login__submit').removeClass('disabled');
        $('#form__login').append('<div id="form__login__error" class="alert alert-warning" role="alert"><strong>Error!</strong> Service is temporarily unavailable, please try again later.</div>');
        console.log("Error: " + JSON.stringify(data, undefined, 2));
    });
});
