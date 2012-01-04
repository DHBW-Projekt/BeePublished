$(document).ready(function () {
    $('#sidebar-opener').click(function () {
            if ($(this).attr('class') == 'closed') {
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
                $(this).attr('class', 'opened');
            } else {
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
                $(this).attr('class', 'closed');
            }
        }
    );

    $(".signin").click(function (e) {
        e.preventDefault();
        $("fieldset#signin_menu").toggle();
        $(".signin").toggleClass("menu-open");
    });

    $("fieldset#signin_menu").mouseup(function () {
        return false
    });
    $(document).mouseup(function (e) {
        if ($(e.target).parent("a.signin").length == 0) {
            $(".signin").removeClass("menu-open");
            $("fieldset#signin_menu").hide();
        }
    });

    initMenu();
});

function initMenu() {
    $("ol.subnav").parent().append("<span></span>");

    $("ol.nav li").hover(
        function () {
            $(this).children("ol.subnav").show();
        },
        function () {
            $(this).children("ol.subnav").hide();
        }
    );
}