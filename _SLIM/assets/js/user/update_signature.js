
$('#form__update_signature').submit(function(e) {
    e.preventDefault();

    $('#form__update_signature__error').remove();
    $('#frm_update_signature__ok').remove();
    $('#form__update_signature__submit').addClass('disabled');

    var lang = $('html').attr('lang');
    var api_key = $.cookie('u_api_key');
    var user_id = $(this).data("user-id");
    var signature = $('input#form__update_signature__signature').val();
    var url = '/api/v1/' + lang + '/users/' + user_id + '/signature.json'

    console.log("signature: " + signature + "\n");
    console.log("api_key: " + api_key + "\n");
    console.log("POST url: " + url + "\n");

    var form_data = {
        'signature' : signature,
        'api_key'   : api_key,
    };

    $.ajax({
        type     : 'PATCH',
        url      : url,
        data     : form_data,
        dataType : 'json',
        encode   : true
    })
    .done(function(data) {
        if (data.error_code || data.error_message) {
            $('#form__update_signature__submit').removeClass('disabled');
            $('#form__update_signature').append('<div id="form__update_signature__error" class="alert alert-warning" role="alert"><strong>Warning!</strong> ' + data.error_message + '</div>');
        } else {
            $.cookie('u_signature', data.user.signature_new, { expires: 365, path: '/' });
            $('#form__update_signature__submit').removeClass('disabled');
            $('#form__update_signature').append('<div id="frm_update_signature__ok" class="alert alert-warning" role="alert">' + data.message + '</div>');

            //console.log("OK: " + JSON.stringify(data, undefined, 2));
        }
    })
    .fail(function(data) {
        $('#form__update_signature__submit').removeClass('disabled');
        $('#form__update_signature').append('<div id="form__update_signature__error" class="alert alert-warning" role="alert"><strong>Error!</strong> Service is temporarily unavailable, please try again later.</div>');
        console.log("Error: " + JSON.stringify(data, undefined, 2));
    });

});
