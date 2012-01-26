$(document).ready(function () {
	$( "#datepicker" ).datepicker( {
	  showOn: "button", 
	  buttonImage: window.app.webroot+"img/calendar.png",
	  buttonImageOnly: true, 
	  showOptions: {direction: 'down'}
	  } );
});