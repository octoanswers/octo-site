
var tagsInputField = $('#new_hashtags');

var commaKeyCode = 44;
var enterKeyCode = 13;
var spaceKeyCode = 32;

tagsInputField.tagsinput({
    trimValue: true,
    confirmKeys: [enterKeyCode, commaKeyCode]
});
