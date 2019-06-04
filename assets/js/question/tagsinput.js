

var bestPictures = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    //prefetch: '../data/films/post_1960.json',
    remote: {
        url: '/api/v1/ru/search/categories.json?query=%QUERY',
        wildcard: '%QUERY'
    }
});

var commaKeyCode = 44;
var enterKeyCode = 13;
var spaceKeyCode = 32;

$('#new_categories').tagsinput({
    trimValue: true,
    // itemValue: 'value',
    // itemText: 'text',
    typeaheadjs: {
        name: 'bestPictures',
        displayKey: 'value',
        valueKey: 'value',
        source: bestPictures.ttAdapter()
    },
    confirmKeys: [enterKeyCode, commaKeyCode]
});



//WORKS
// var commaKeyCode = 44;
// var enterKeyCode = 13;
// var spaceKeyCode = 32;

// $('#new_categories').tagsinput({
//     trimValue: true,
//     confirmKeys: [enterKeyCode, commaKeyCode]
// });

//WORKS
// var bestPictures = new Bloodhound({
//     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
//     queryTokenizer: Bloodhound.tokenizers.whitespace,
//     prefetch: '../data/films/post_1960.json',
//     remote: {
//         url: '/api/v1/ru/search/categories.json?query=%QUERY',
//         wildcard: '%QUERY'
//     }
// });

// $('#remote .typeahead').typeahead(null, {
//     name: 'best-pictures',
//     display: 'value',
//     source: bestPictures
// });