
$('#navbar_search_form').submit(function (e) {
    e.preventDefault();

    var lang = $('html').attr('lang');
    console.log("lang: " + lang + "\n");

    var query = $('input#navbar_search_form_query').val();
    console.log("query: " + query + "\n");

    // Replace underscores with double underscores


    // Replace spaces with underscores
    query = query.replace(/\s/gi, "_");
    console.log("query: " + query + "\n");

    // Remove all question marks
    query = query.replace(/\?/g, '');
    console.log("query: " + query + "\n");

    var url = '/' + lang + '/' + query;
    console.log("url: " + url + "\n");

    window.location = url;
});
