$(document).ready(function () {
    initSidebar();
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

function initSidebar() {
    if ($.cookie("beeSidebar") == "opened") {
        $('body').attr('class', 'sidebar-open');
        $('#sidebar, #sidebar-opener').attr('class', 'opened');
    }
    $('#sidebar-opener').click(function () {
            if ($(this).attr('class') == 'closed') {
                $.cookie("beeSidebar", "opened", { path: '/' });
                $('#sidebar').stop(true, true).animate({
                    left:'0'
                }, {
                    queue:true,
                    duration:'fast'
                });
                $('#sidebar-opener').stop(true, true).animate({
                    left:'200'
                }, {
                    queue:true,
                    duration:'fast'
                });
                $('body').stop(true, true).animate({
                    'margin-left':'200'
                }, {
                    queue:true,
                    duration:'fast'
                });
            } else {
                $.cookie("beeSidebar", null, { path: '/' });
                $('#sidebar').stop(true, true).animate({
                    left:'-200'
                }, {
                    queue:true,
                    duration:'fast'
                });
                $('#sidebar-opener').stop(true, true).animate({
                    left:'0'
                }, {
                    queue:true,
                    duration:'fast'
                });
                $('body').stop(true, true).animate({
                    'margin-left':'0'
                }, {
                    queue:true,
                    duration:'fast'
                });
            }
        }
    );
}