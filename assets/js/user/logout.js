
$('#logout_btn').click(function(e) {
    e.preventDefault();

    $('#div__logout_error').remove();

    var lang = $('html').attr('lang');
    var api_key = $.cookie('u_api_key');
    console.log("\nuser__api_key: " + api_key);

    var formData = {
        'logout' : 'yes',
        "api_key" : api_key,
    };

    $.ajax({
        type     : 'POST',
        url      : '/api/v1/' + lang + '/logout.json',
        data     : formData,
        dataType : 'json',
        encode   : true
    })
    .done(function(data) {
        if (data.error_code || data.error_message) {
            $('#modal__logout__body').append('<div id="div__logout_error" class="alert alert-warning" role="alert"><strong>Внимание!</strong> ' + data.error_message + '</div>');
        } else {
            window.location = data.destination_url;
            //console.log("\nERROR: " + JSON.stringify(data, undefined, 2));
        }
    })
    .fail(function(data) {
        $('#modal__logout__body').append('<div id="div__logout_error" class="alert alert-warning" role="alert"><strong>Ошибка!</strong> Сервер временно недоступен.</div>');
        console.log("\nFAIL: " + JSON.stringify(data, undefined, 2));
    });
});
