$("textarea#question_title").keyup(function(e){
    e.preventDefault();
    var charactersLeft = 140 - $(this).val().length;
    if (charactersLeft >= 0) {
        $('p#characters_count').removeClass('text-danger').addClass('text-secondary');
    } else {
        $('p#characters_count').removeClass('text-secondary').addClass('text-danger');
    }
    $("span#characters_count_num").text(charactersLeft);
});
