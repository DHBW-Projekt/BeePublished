function callPages() {
    var id = window.app.pageid;
    if (id == undefined) {
        return;
    }
    var request = $.ajax({
        url:window.app.webroot+"pages/json/" + id,
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
	