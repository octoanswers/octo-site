
$('#form__question_create').submit(function(e) {
  e.preventDefault();

  $('#question_create_error').remove();
  $('#form__question_create__submit_btn').addClass('disabled');

  if ($('#form__question_create__question_title').length) {
    var question_title = $('#form__question_create__question_title').val();
  } else {
    var question_title = $('#form__question_create').data("question-title");
  }

  var answer_text = null;
  if ($('#form__question_create__answer_text').length) {
    var answer_text = $('#form__question_create__answer_text').val();
  }

  var errorAlert = '<div id="question_create_error" class="alert alert-warning" role="alert">%msg%</div>';
  console.log("question_title: " + question_title);
  console.log("answer_text: " + answer_text);

  var data = {
    'question_title' : question_title,
    'answer_text' : answer_text,
  };

  $.ajax({
    type     : 'POST',
    url      : '/api/v1/questions.json',
    data     : data,
    dataType : 'json',
    encode   : true
  })
  .done(function(data) {
    if (data.error_code || data.error_message) {
      $('#form__question_create__submit_btn').removeClass('disabled');
      errorAlert = errorAlert.replace('%msg%', data.error_message);
      $('#form__question_create').append(errorAlert);
      console.log("ERROR: " + JSON.stringify(data, undefined, 2));
    } else {
      console.log("OK: " + JSON.stringify(data, undefined, 2));
      window.location = data.url;
    }
  })
  .fail(function(data) {
    $('#form__question_create__submit_btn').removeClass('disabled');
    errorAlert = errorAlert.replace('%msg%', 'Server temporarily unavailable');
    $('#form__question_create').append(errorAlert);
    console.log("FAIL: " + JSON.stringify(data, undefined, 2));
  });
});
