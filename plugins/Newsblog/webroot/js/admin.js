$(document).ready(function () {
	$("#admin_newsblog" ).tabs({
		cookie: {}
	});
	
	//create news tab
	$('#writeNewsTextEditor').ckeditor(
		function() { /* callback code */ },
		{ 
			
		}
	);
	
	$('#nbValidFromDatepicker').datepicker(
		{
			autoSize: true,
			altField: '#validFromDB',
			altFormat: 'yy-mm-dd',
			showOn: 'button',
			defaultDate: new Date(),
			minDate: new Date(),
			buttonImage: window.app.webroot+"img/calendar.png",
			buttonImageOnly: true,
			showOptions: {direction: 'down'}
		}
	);
	
	$('#nbValidToDatepicker').datepicker(
		{
			autoSize: true,
			altField: '#validToDB',
			altFormat: 'yy-mm-dd',
			minDate: new Date(),
			showOn: "button",
			buttonImage: window.app.webroot+"img/calendar.png",
			buttonImageOnly: true,
			showOptions: {direction: 'down'}
		}
	);
	
	
	//publish news tab
	$(".unpublished_newsentry").mouseenter(function(){
		$(".newsentry_publish_buttons", this).show();
	});
	$(".unpublished_newsentry").mouseleave(function(){
		$(".newsentry_publish_buttons", this).hide();
	});
	
		
});