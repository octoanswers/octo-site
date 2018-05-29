
$('#form__signup').submit(function(e) {
    e.preventDefault();

    $('#form__signup__error').remove();
    $('#form__signup__submit').addClass('disabled');

    var lang = $('html').attr('lang');

    var formData = {
        'username' : $('input#form__signup__username').val(),
        'email'    : $('input#form__signup__email').val(),
        'password' : $('input#form__signup__password').val()
    };

    $.ajax({
        type     : 'POST',
        url      : '/api/v1/' + lang + '/signup.json',
        data     : formData,
        dataType : 'json',
        encode   : true
    })
    .done(function(data) {
        if (data.error_code || data.error_message) {
            $('#form__signup__submit').removeClass('disabled');
            $('#form__signup').append('<div id="form__signup__error" class="alert alert-warning" role="alert"><strong>Warning!</strong> ' + data.error_message + '</div>');
        } else {
            console.log("OK: " + JSON.stringify(data, undefined, 2));
            window.location = data.destination_url;
        }
    })
    .fail(function(data) {
        $('#form__signup__submit').removeClass('disabled');
        $('#form__signup').append('<div id="form__signup__error" class="alert alert-warning" role="alert"><strong>Error!</strong> Service is temporarily unavailable, please try again later.</div>');
        console.log("Error: " + JSON.stringify(data, undefined, 2));
    });

});
