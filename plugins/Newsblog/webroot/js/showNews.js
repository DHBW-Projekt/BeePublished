$(document).ready(function () {
	$(".newsblog_entry").mouseenter(function(){
		$('.newsblog_entry_buttons', this).show();
	});
	$(".newsblog_entry").mouseleave(function(){
		$('.newsblog_entry_buttons', this).hide();
	});
	
	$(".newsentry_delete_button_icon" ,this).click(function(){
		
	})
	
	$(".overlay").fancybox({
		'type':'iframe',
		'width':'90%',
		'height':'90%',
		'onClosed':function () {
			window.location.reload(true);
		}
	});
	
	$('.newsblogreadconfig_button').click(function(){
		var items = $('.newsblogreadconfig_items');
		items.toggle('slow');
	});
	
	$('.newsblogcontainer').jPaginate({
		items: window.app.itemsPerPage,
		minimize: true,
		nav_items: 5,
		next: '>>',
		previous: '<<',
		equal: false
	});
});