$(document).ready(function () {
    $('a.calendar_add_entry').fancybox({
        type: 'iframe',
        width: '90%',
        height: '90%'
    });
});

function newEntrySaved() {
    $.fancybox.close();
    window.location.reload(true);
}