function callPages() {
    var id = $('head').find('meta[id]').attr('id');
    var request = $.ajax({
        url:"/pages/json/" + id,
        type:"POST",
        context:document.body,
        success:function () {
            var page = $.parseJSON(request.responseText);
            createPage(page);
        }
    });
} // function callPages

function createPage(page) {
    var id = page['Page']['id'];
    $('#content').empty();
    callPageLayout(id);
} // function createPages
	