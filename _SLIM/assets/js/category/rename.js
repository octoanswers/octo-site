
$('#form__rename_category').submit(function (e) {
    e.preventDefault();

    $('#form__rename_category__error').remove();
    $('#form__rename_category__submit').addClass('disabled');

    var lang = $('html').attr('lang');
    var category_id = $('#form__rename_category').data("category-id");
    var new_title = $('#new_title').val();
    var save_redirect = $('#save_redirect').is(':checked');
    var api_key = $.cookie('u_api_key');
    var url = '/api/v1/' + lang + '/categories/' + category_id + '/rename.json';

    console.log("category_id: " + category_id + "\n");
    console.log("new_title: " + new_title + "\n");
    console.log("save_redirect: " + save_redirect + "\n");
    console.log("PUT url: " + url + "\n");

    var form_data = {
        'api_key': api_key,
        'category_id': category_id,
        'new_title': new_title,
        'save_redirect': save_redirect,
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
                $('#form__rename_category__submit').removeClass('disabled');
                $('#form__rename_category').append('<div id="form__rename_category__error" class="alert alert-warning" role="alert"><strong>Warning!</strong> ' + data.error_message + '</div>');
            } else {
                window.location = data.category.url;
                //console.log("OK: " + JSON.stringify(data, undefined, 2));
            }
        })
        .fail(function (data) {
            $('#form__rename_category__submit').removeClass('disabled');
            $('#form__rename_category').append('<div id="form__rename_category__error" class="alert alert-warning" role="alert"><strong>Error!</strong> Service is temporarily unavailable, please try again later.</div>');
            console.log("Error: " + JSON.stringify(data, undefined, 2));
        });

});
