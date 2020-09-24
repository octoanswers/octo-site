
$("button.follow_user_button").click(function(e){

    e.preventDefault();
    $button = $(this);

    var lang = $('html').attr('lang');
    var api_key = $.cookie('u_api_key');

    $button.addClass('disabled');

    var form_data = {
        "api_key" : api_key,
    };

    var user_id = $(this).data("user-id");
    var request_type = ($button.hasClass('followed') ? "DELETE" : "POST");
    var request_url = '/api/v1/' + lang + '/users/' + user_id + '/follow.json';

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
                $button.removeClass('btn-danger').addClass('btn-outline-primary');
                var follow_title = $(this).data("follow-title");
                $button.html(follow_title);
                $button.blur();
            } else {
                console.log("Succes follow\n");
                $button.addClass('followed');
                $button.removeClass('btn-outline-primary').addClass('btn-success');
                var followed_title = $(this).data("followed-title");
                $button.text(followed_title);
                $button.blur();
            }
        }
    })
    .fail(function(data) {
        $button.removeClass('disabled');
        console.log("Error: " + JSON.stringify(data, undefined, 2));
    });
});

$("button.follow_user_button")
.mouseenter(function(){
    $button = $(this);
    if($button.hasClass('followed')){
        var unfollow_title = $(this).data("unfollow-title");
        $button.removeClass('btn-success').addClass('btn-danger');
        $button.text(unfollow_title);
    }
})
.mouseleave(function(){
    $button = $(this);
    if($button.hasClass('followed')){
        var followed_title = $(this).data("followed-title");
        $button.removeClass('btn-danger').addClass('btn-success');
        $button.text(followed_title);
    } else {
        var follow_title = $(this).data("follow-title");
        $button.text(follow_title);
    }
});
