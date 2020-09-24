
$('#form__upload_avatar').submit(function(e) {
    e.preventDefault();

    $('#form__upload_avatar__error').remove();
    $('#form__upload_avatar__submit_btn').addClass('disabled');

    var form_data = new FormData(this);

    var lang = $('html').attr('lang');
    var api_key = $.cookie('u_api_key');
    form_data.append('api_key', api_key);

    console.log("\napi_key: " + api_key);

    $.ajax({
        type     : 'POST',
        url      : '/api/v1/' + lang + '/avatar.json',
        data     : form_data,
        dataType : 'json',
        //async: false,
        cache: false,
        contentType: false,
        processData: false,
        //encode   : true
    })
    .done(function(data) {
        console.log("\nDONE: " + JSON.stringify(data, undefined, 2));
        if (data.error_code || data.error_message) {
            $('#form__upload_avatar').append('<div id="form__upload_avatar__error" class="alert alert-warning" role="alert"><strong>Warning!</strong> ' + data.error_message + '</div>');
        } else {
          $('#form__upload_avatar__submit_btn').removeClass('disabled');

          // update avatar URL`s cookies
          $.cookie('user__avatar__m_url', data.avatar_url_medium, { expires: 365, path: '/' });
          $.cookie('user__avatar__s_url', data.avatar_url_small, { expires: 365, path: '/' });
          $.cookie('user__avatar__xs_url', data.avatar_url_extra_small, { expires: 365, path: '/' });

          var randomNumber = randomNumberFromRange(1, 1000);
          var avatar_url = data.avatar_url_small + '?v=' + randomNumber;
          console.log("\nNew image: " + avatar_url);

          $("#settings_pg__user_avatar").attr('src', avatar_url);
        }
    })
    .fail(function(data) {
      $('#form__upload_avatar__submit_btn').removeClass('disabled');
      $('#form__upload_avatar').append('<div id="form__upload_avatar__error" class="alert alert-warning" role="alert"><strong>Error!</strong> Service is temporarily unavailable, please try again later.</div>');
      console.log("\nfail: " + JSON.stringify(data, undefined, 2));
    });
});

function randomNumberFromRange(min,max)
{
    return Math.floor(Math.random()*(max-min+1)+min);
}
