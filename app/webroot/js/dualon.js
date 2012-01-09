$(document).ready(function () {

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