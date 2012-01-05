$(document).ready(function () {
	$(".newsblog_entry").mouseenter(function(){
		$('.newsblog_entry_buttons', this).show();
	});
	$(".newsblog_entry").mouseleave(function(){
		$('.newsblog_entry_buttons', this).hide();
	});
	
	$(".newsentry_delete_button_icon" ,this).click(function(){
		
	})
	
	$(".newsblog_overlay").fancybox({
		'type':'inline',
		'onClosed':function () {
			window.location.reload(true);
		}
	});
});