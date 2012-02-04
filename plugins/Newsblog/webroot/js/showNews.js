$(document).ready(function () {
	$(".newsblog_entry").mouseenter(function(){
		$('.newsblog_entry_buttons', this).show();
	});
	$(".newsblog_entry").mouseleave(function(){
		$('.newsblog_entry_buttons', this).hide();
	});
	
	$(".overlay").fancybox({
		'type':'iframe',
		'width':'90%',
		'height':'90%',
		'onClosed':function () {
			window.location.reload(true);
		}
	});
	
	$('.newsblogreadconfig_button').click(function(){
		$('.newsblogreadconfig_items').slideToggle('slow', function(){
			var isVisible = $('.newsblogreadconfig_items').is(':visible');
			var isHidden = $('.newsblogreadconfig_items').is(':hidden');
			if( isVisible ){
				$('.newsblogreadconfig_button a').html(window.app.hideConfigText);
			} else if( isHidden ){
				$('.newsblogreadconfig_button a').html(window.app.showConfigText);
			}
		});
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