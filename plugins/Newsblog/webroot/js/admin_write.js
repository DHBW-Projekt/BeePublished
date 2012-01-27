$(document).ready(function () {
	//create news tab
	$('#writeNewsTextEditor').ckeditor(
		function() { /* callback code */ },
		{ 
			
		}
	);
	
	$('#nbValidFromDatepicker').datepicker(
		{
			autoSize: true,
			formatDate: 'ISO_8601',
			altField: '#validFromDB',
			altFormat: 'yy-mm-dd',
			minDate: new Date(),
			showOn: "button",
			buttonImage: window.app.webroot+"img/calendar.png",
			buttonImageOnly: true,
			buttonText: window.app.validFromAltText,
			showOptions: {direction: 'down'}
		}
	);
	
	$('#nbValidToDatepicker').datepicker(
		{
			autoSize: true,
			formatDate: 'ISO_8601',
			altField: '#validToDB',
			altFormat: 'yy-mm-dd',
			minDate: new Date(),
			showOn: "button",
			buttonImage: window.app.webroot+"img/calendar.png",
			buttonImageOnly: true,
			button: window.app.validToAltText,
			showOptions: {direction: 'down'}
		}
	);
});