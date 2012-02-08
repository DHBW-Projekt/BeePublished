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