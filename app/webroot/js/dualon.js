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
    initAdmin();
    
    $(".plugin_administration a", this).css("display", "none");
    
	$(".plugin_content").mouseenter(function () {
		$(".plugin_administration a", this).css("display", "inline");
		});
		$(".plugin_content").mouseleave(function () {
		$(".plugin_administration a", this).css("display", "none");
		});
});


function setSettingOptions(container, id) {
	$(".plugin_content").mouseenter(function () {
	$(".plugin_administration a", this).css("display", "inline");
	});
	$(".plugin_content").mouseleave(function () {
	$(".plugin_administration a", this).css("display", "none");
	});
	} 

function initAdmin() {
    $(".plugin_administration a").fancybox({
        'type':'iframe',
        width:'90%',
        height:'90%',
        'onClosed':function () {
            window.location.reload(true);
        }
    });
}