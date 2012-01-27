$(document).ready(function () {
	$('#editNewsTextEditor').ckeditor(
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
				showOn: "button",
				buttonImage: window.app.webroot+"img/calendar.png",
				buttonImageOnly: true,
				buttonText: window.app.validToAltText,
				showOptions: {direction: 'down'}
			}
	);
});