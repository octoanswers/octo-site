

var categoriesAPI = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    // prefetch: '/api/v1/ru/search/categories.json',
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
    typeaheadjs: {
        name: 'bestPictures',
        displayKey: 'value',
        valueKey: 'value',
        source: categoriesAPI.ttAdapter()
    },
    confirmKeys: [enterKeyCode, commaKeyCode]
});
