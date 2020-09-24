
$(document).ready(function() {
    var resetPasswordLaddaButton = Ladda.create(document.querySelector('#form_user_reset_password-submit_button'));
    $('#form_user_reset_password-submit_button').click(function(e) {
        e.preventDefault();
        resetPasswordLaddaButton.start();

        var formData = {
            'user_email' : $('input[name=form_user_reset_password-email]').val(),
        };
        $.ajax({
            type     : 'POST',
            url      : '/app/actions/user/reset_password.action.php',
            data     : formData,
            dataType : 'json',
            encode   : true
        })
        .done(function(data) {
            resetPasswordLaddaButton.stop();
            if (data.success) {
                $('#userResetPasswordModal').modal('hide')
                alert("Письмо для сброса пароля отправлено на email.");
            } else {
                if (data.errors.email) {
                    $('#form_user_reset_password-email-group').addClass('has-error');
                    $('#form_user_reset_password-email-group').append('<div class="help-block">' + data.errors.email + '</div>');
                } else {
                    console.log("Error: " + JSON.stringify(data, undefined, 2));
                    alert("Error: Failed to send email.");
                }
            }
        })
        .fail(function(data) {
            resetPasswordLaddaButton.stop();
            console.log(".fail: " + JSON.stringify(data, undefined, 2));
            alert("Error: Failed to send email.");
        });
    });
});
