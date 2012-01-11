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
			formatDate: 'yyyy-mm-dd',
			showOn: "button",
			buttonImage: "calendar.png",
			buttonImageOnly: true,
			showOptions: {direction: 'down'}
		}
	);
	
	$('#nbValidToDatepicker').datepicker(
		{
			autoSize: true,
			formatDate: 'yyyy-mm-dd',
			showOn: "button",
			buttonImage: "calendar.png",
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