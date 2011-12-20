$(document).ready(function () {
	$("a#overlay").fancybox({
			'type' : 'iframe',
			'onClosed'	:	function() {
				window.location.reload(true);
			}
	});
	
	$(".plugin_content").mouseenter(function(){
		$(".setting_button", this).css("display", "inline");
	});
	$(".plugin_content").mouseleave(function(){
		$(".setting_button", this).css("display", "none");
	});
});