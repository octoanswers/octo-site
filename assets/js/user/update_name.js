
$('#form__update_name').submit(function (e) {
    e.preventDefault();

    $('#form__update_name__error').remove();
    $('#form__update_name__ok').remove();
    $('#form__update_name__submit').addClass('disabled');

    var lang = $('html').attr('lang');
    var api_key = $.cookie('u_api_key');
    var user_id = $(this).data("user-id");
    var name = $('input#form__update_name__name').val();
    var url = '/api/v1/' + lang + '/users/' + user_id + '/name.json'

    console.log("name: " + name + "\n");
    console.log("api_key: " + api_key + "\n");
    console.log("PATCH url: " + url + "\n");

    var form_data = {
        'name': name,
        'api_key': api_key,
    };

    $.ajax({
        type: 'PATCH',
        url: url,
        data: form_data,
        dataType: 'json',
        encode: true
    })
        .done(function (data) {
            if (data.error_code || data.error_message) {
                $('#form__update_name__submit').removeClass('disabled');
                $('#form__update_name').append('<div id="form__update_name__error" class="alert alert-warning" role="alert"><strong>Warning!</strong> ' + data.error_message + '</div>');
            } else {
                $.cookie('u_name', data.user.name, { expires: 365, path: '/' });
                $('#form__update_name__submit').removeClass('disabled');
                $('#form__update_name').append('<div id="form__update_name__ok" class="alert alert-warning" role="alert">' + data.message + '</div>');

                //console.log("OK: " + JSON.stringify(data, undefined, 2));
            }
        })
        .fail(function (data) {
            $('#form__update_name__submit').removeClass('disabled');
            $('#form__update_name').append('<div id="form__update_name__error" class="alert alert-warning" role="alert"><strong>Error!</strong> Service is temporarily unavailable, please try again later.</div>');
            console.log("Error: " + JSON.stringify(data, undefined, 2));
        });

});
