
$("button.follow_category_button").click(function (e) {

    e.preventDefault();
    $button = $(this);

    var api_key = $.cookie('u_api_key');

    $button.addClass('disabled');

    var form_data = {
        "api_key": api_key,
    };

    var lang = $('html').attr('lang');
    var categoryID = $(this).data("category-id");
    var request_type = ($button.hasClass('followed') ? "DELETE" : "POST");
    var request_url = '/api/v1/' + lang + '/categories/' + categoryID + '/follow.json';

    console.log("request_type: " + request_type + "\n");
    console.log("request_url: " + request_url + "\n");

    $.ajax({
        type: request_type,
        url: request_url,
        data: form_data,
        dataType: 'json',
        encode: true
    })
        .done(function (data) {
            $button.removeClass('disabled');

            if (data.error_code || data.error_message) {
                console.log("DONE error: " + JSON.stringify(data, undefined, 2));
            } else {
                if ($button.hasClass('followed')) {
                    console.log("DONE succes unfollow\n");
                    $button.removeClass('followed');
                    $button.removeClass('btn-danger').addClass('btn-outline-primary');
                    var follow_title = $(this).data("follow-title");
                    $button.html(follow_title);
                    $button.blur();
                } else {
                    console.log("DONE succes follow\n");
                    $button.addClass('followed');
                    $button.removeClass('btn-outline-primary').addClass('btn-success');
                    var followed_title = $(this).data("followed-title");
                    $button.text(followed_title);
                    $button.blur();
                }
            }
        })
        .fail(function (data) {
            $button.removeClass('disabled');
            console.log("\nFAIL: " + JSON.stringify(data, undefined, 2));
        });
});

$("button.follow_category_button")
    .mouseenter(function () {
        $button = $(this);
        if ($button.hasClass('followed')) {
            var unfollow_title = $(this).data("unfollow-title");
            $button.removeClass('btn-success').addClass('btn-danger');
            $button.text(unfollow_title);
        }
    })
    .mouseleave(function () {
        $button = $(this);
        if ($button.hasClass('followed')) {
            var followed_title = $(this).data("followed-title");
            $button.removeClass('btn-danger').addClass('btn-success');
            $button.text(followed_title);
        } else {
            var follow_title = $(this).data("follow-title");
            $button.text(follow_title);
        }
    });
