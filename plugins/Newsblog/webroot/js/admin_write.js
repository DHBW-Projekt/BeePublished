$(document).ready(function () {
	//create news tab
	$('#writeNewsTextEditor').ckeditor(
		function() { /* callback code */ },
		{ 
			
		}
	);
	$('#nbValidFromDatepicker').datetimepicker({
		minDate: new Date(),
		showOn: "button",
		buttonImage: window.app.webroot+"img/calendar.png",
		buttonImageOnly: true,
		buttonText: window.app.validFromAltText,
		showOptions: {direction: 'up'},
		onClose: function(dateText, inst){
			var dateTimeInput = dateText.split(" ");
			var dateInput = dateTimeInput[0].split("/");
			var timeInput = dateTimeInput[1].split(":");
			var datetimedb = dateInput[2] + '-' + dateInput[0] + '-' + dateInput[1] + ' ' + timeInput[0] + ':' + timeInput[1] + ':00';
			$('#validFromDB').attr('value', datetimedb);
		}
	});
	$('#nbValidToDatepicker').datetimepicker({
		minDate: new Date(),
		showOn: "button",
		buttonImage: window.app.webroot+"img/calendar.png",
		buttonImageOnly: true,
		buttonText: window.app.validFromAltText,
		showOptions: {direction: 'up'},
		onClose: function(dateText, inst){
			var dateTimeInput = dateText.split(" ");
			var dateInput = dateTimeInput[0].split("/");
			var timeInput = dateTimeInput[1].split(":");
			var datetimedb = dateInput[2] + '-' + dateInput[0] + '-' + dateInput[1] + ' ' + timeInput[0] + ':' + timeInput[1] + ':59';
			$('#validToDB').attr('value', datetimedb);
		}
	});
});