/*
* This file is part of BeePublished which is based on CakePHP.
* BeePublished is free software: you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation, either version 3
* of the License, or any later version.
* BeePublished is distributed in the hope that it will be useful, but
* WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* You should have received a copy of the GNU General Public
* License along with BeePublished. If not, see
* http://www.gnu.org/licenses/.
*
* @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
* @author Philipp Scholl
*
* @description JavaScript to configure ckeditor and jQuery UI Datetimepicker
*/

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