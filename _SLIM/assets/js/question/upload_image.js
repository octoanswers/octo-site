
$('#upload_image_form').submit(function(e) {
    e.preventDefault();

    $('#upload_image_form__error').remove();
    $('#upload_image_form__submit_btn').addClass('disabled');

    var form_data = new FormData(this);

    var lang = $('html').attr('lang');
    var question_id = $(this).data("question-id");

    var api_key = $.cookie('u_api_key');

    form_data.append('api_key', api_key);

    var request_url = '/api/v1/' + lang + '/questions/' + question_id + '/image.json';

    console.log("\nPOST: " + request_url);

    $.ajax({
        type     : 'POST',
        url      : request_url,
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
            $('#upload_image_form').append('<div id="upload_image_form__error" class="alert alert-warning" role="alert"><strong>Warning!</strong> ' + data.error_message + '</div>');
        } else {
          $('#upload_image_form__submit_btn').removeClass('disabled');

          // var randomNumber = randomNumberFromRange(1, 1000);
          // var image_url_md = data.image_url_md + '?v=' + randomNumber;
          // console.log("\nNew image: " + image_url_md);

          // close modal & reload page
          $('#modal_upload_image').modal('hide');
          location.reload();

          //$("#question_image").attr('src', image_url_md);
        }
    })
    .fail(function(data) {
      $('#upload_image_form__submit_btn').removeClass('disabled');
      $('#upload_image_form').append('<div id="upload_image_form__error" class="alert alert-warning" role="alert"><strong>Error!</strong> Service is temporarily unavailable, please try again later.</div>');
      console.log("\nfail: " + JSON.stringify(data, undefined, 2));
    });
});

function randomNumberFromRange(min,max)
{
    return Math.floor(Math.random()*(max-min+1)+min);
}
