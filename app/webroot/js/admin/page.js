function callPages() {

    var request;
    var pages;

    request = $.ajax({
        url:"../../DualonCMS/PageManager/getPages",
        type:"POST",
        context:document.body,
        beforeSend:function () {
        },
        error:function () {
        },
        success:function () {
            pages = $.parseJSON(request.responseText);
            createPages(pages);

        }
    });


} // function callPages

function createPages(pages) {
    //alert(pages.length);
    for (var i = 0; i < pages.length; i++) {
        $('#content').append($('<div></div>')
            .attr({id:"page_" + pages[i]['Page']['id']})
            .addClass("dropzone page inactive")
        );
    } //for

    $('#menulist').find('span').get(0).style.background = "#FFCC00";
    $($('#content').find('div').get(0)).addClass('active');
    $($('#content').find('div').get(0)).removeClass('inactive');

    callPageLayout();
    dnd('dropzone');

} // function createPages

function openPage(id) {

    $('#content > [id*="page_"]').addClass('inactive');
    $('#content > [id*="page_"]').removeClass('active');
    $('#' + id).addClass('active');
    $('#' + id).removeClass('inactive');
    callPageLayout();

} // function openPage

function savePage() {

    saveMenu();
    getContainerID();

} // function savePage
	