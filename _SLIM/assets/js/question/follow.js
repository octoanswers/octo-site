
$("button.follow_question_button").click(function(e){

    e.preventDefault();
    $button = $(this);

    var api_key = $.cookie('u_api_key');

    $button.addClass('disabled');

    var form_data = {
        "api_key" : api_key,
    };

    var lang = $('html').attr('lang');
    var question_id = $(this).data("question-id");
    var request_type = ($button.hasClass('followed') ? "DELETE" : "POST");
    var request_url = '/api/v1/' + lang + '/questions/' + question_id + '/follow.json';

    console.log("request_type: " + request_type + "\n");
    console.log("request_url: " + request_url + "\n");

    $.ajax({
        type     : request_type,
        url      : request_url,
        data     : form_data,
        dataType : 'json',
        encode   : true
    })
    .done(function(data) {
        $button.removeClass('disabled');

        if (data.error_code || data.error_message) {
            console.log("Error: " + JSON.stringify(data, undefined, 2));
        } else {
            if($button.hasClass('followed')){
                console.log("Succes unfollow\n");
                $button.removeClass('followed');
                $button.removeClass('btn-danger').addClass('btn-primary');
                var follow_title = $(this).data("follow-title");
                $(this).find('span').text(follow_title);
                $button.blur();
            } else {
                console.log("Succes follow\n");
                $button.addClass('followed');
                $button.removeClass('btn-primary').addClass('btn-success');
                var followed_title = $(this).data("followed-title");
                $(this).find('span').text(followed_title);
                $button.blur();
            }
        }
    })
    .fail(function(data) {
        $button.removeClass('disabled');
        console.log("Error: " + JSON.stringify(data, undefined, 2));
    });
});

$("button.follow_question_button")
.mouseenter(function(){
    if($(this).hasClass('followed')){
        var unfollow_title = $(this).data("unfollow-title");
        $(this).removeClass('btn-success').addClass('btn-danger');
        $(this).find('span').text(unfollow_title);
    }
})
.mouseleave(function(){
    if($(this).hasClass('followed')){
        var followed_title = $(this).data("followed-title");
        $(this).removeClass('btn-danger').addClass('btn-success');
        $(this).find('span').text(followed_title);
    } else {
        var follow_title = $(this).data("follow-title");
        $(this).find('span').text(follow_title);
    }
});
