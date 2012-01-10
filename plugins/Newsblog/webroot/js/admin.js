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
			altFormat: 'yyyy-mm-dd',
			showOptions: {direction: 'down'}
		}
	);
	
	$('#nbValidToDatepicker').datepicker(
		{
			autoSize: true,
			altFormat: 'yyyy-mm-dd',
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