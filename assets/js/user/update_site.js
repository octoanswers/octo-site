
$('#frm__update_site').submit(function(e) {
    e.preventDefault();

    $('#frm__update_site__error').remove();
    $('#frm__update_site__ok').remove();
    $('#frm__update_site__submit').addClass('disabled');

    var lang = $('html').attr('lang');
    var api_key = $.cookie('u_api_key');
    var user_id = $(this).data("user-id");
    var site = $('input#frm__update_site__site').val();
    var url = '/api/v1/' + lang + '/users/' + user_id + '/site.json'

    console.log("site: " + site + "\n");
    console.log("api_key: " + api_key + "\n");
    console.log("POST url: " + url + "\n");

    var form_data = {
        'site' : site,
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
            $('#frm__update_site__submit').removeClass('disabled');
            $('#frm__update_site').append('<div id="frm__update_site__error" class="alert alert-warning" role="alert"><strong>Warning!</strong> ' + data.error_message + '</div>');
        } else {
            $.cookie('u_site', data.user.site_new, { expires: 365, path: '/' });
            $('#frm__update_site__submit').removeClass('disabled');
            $('#frm__update_site').append('<div id="frm__update_site__ok" class="alert alert-warning" role="alert">' + data.message + '</div>');

            //console.log("OK: " + JSON.stringify(data, undefined, 2));
        }
    })
    .fail(function(data) {
        $('#frm__update_site__submit').removeClass('disabled');
        $('#frm__update_site').append('<div id="frm__update_site__error" class="alert alert-warning" role="alert"><strong>Error!</strong> Service is temporarily unavailable, please try again later.</div>');
        console.log("Error: " + JSON.stringify(data, undefined, 2));
    });

});
