$(document).ready(function () {
    callMenu();
    callLayouts();
    callPlugins();
    $("#sidebar-menu").accordion({ autoHeight:true });
    callPages();
    $('.sort a').fancybox({
        'onClosed':function () {
            callMenu();
        }
    });
    $('#content').attr('class', 'dropzone');
});

$(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);