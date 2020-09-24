<script type="text/javascript">
    $('#form__request_answer').submit(function(e) {
        e.preventDefault();

        $('#form__request_answer__error').remove();
        $('#form__request_answer__btn_submit').addClass('disabled');

        // validate email zero-length
        if ($('input#form__request_answer__email').val().length === 0) {
            $('#form__request_answer').append('<div id="form__request_answer__error" class="alert alert-warning" role="alert"><strong>Внимание!</strong> Введите email</div>');
            $('#form__request_answer__btn_submit').removeClass('disabled');
            return;
        }

        var formData = {
            'question_id' : <?= $data['question']['id'] ?>,
            'email'    : $('input#form__request_answer__email').val(),
        };

        $.ajax({
            type     : 'POST',
            url      : '/<?= $data['page']['lang'] ?>/api/v1/answer/request',
            data     : formData,
            dataType : 'json',
            encode   : true
        })
        .done(function(data) {
            $('#form__request_answer__btn_submit').removeClass('disabled');
            if (data.error_code || data.error_message) {
                //console.log("Error: " + JSON.stringify(data, undefined, 2));
                $('#form__request_answer').append('<div id="form__request_answer__error" class="alert alert-warning" role="alert"><strong>Внимание!</strong> ' + data.error_message + '</div>');
            } else {
                $('#form__request_answer').append('<div class="alert alert-success" role="alert"><strong>Поехали!</strong> Система начала поиск специалиста...</div>');
                //$('#form__request_answer').remove();
            }
        })
        .fail(function(data) {
            $('#form__request_answer__btn_submit').removeClass('disabled');
            $('#form__request_answer').append('<div id="form__request_answer__error" class="alert alert-warning" role="alert"><strong>Ошибка!</strong> Сервер временно недоступен, попробуйте отправить запрос позднее.</div>');
        });
    });
</script>
