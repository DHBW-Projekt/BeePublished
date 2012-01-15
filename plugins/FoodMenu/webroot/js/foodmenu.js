function setToday() {
	// Make sure browser supports getElementById  
	 if(!document.getElementById ) return; 
	 // Find the input by it's id 
	 var inputObj = document.getElementById( 'datepicker' ); 
	 if( inputObj ) { 
	 // Update the value 
		 var today = new Date();
		 var month = today.getMonth()+1;
		 var year = today.getFullYear();
		 var day = today.getDate();
		 if(day<10) day = "0" + day;
		 if(month<10) month= "0" + month;

		 inputObj.value = month + "/" + day + "/" + year; 
	 } 
}

function setTomorrow() {
	// Make sure browser supports getElementById  
	 if(!document.getElementById ) return; 
	 // Find the input by it's id 
	 var inputObj = document.getElementById( 'datepicker' ); 
	 if( inputObj ) { 
	 // Update the value 
		 var tomorrow = new Date();
		 tomorrow.setTime(tomorrow.getTime() + (1000*3600*24));
		 var month = tomorrow.getMonth()+1;
		 var year = tomorrow.getFullYear();
		 var day = tomorrow.getDate();
		 if(day<10) day = "0" + day;
		 if(month<10) month= "0" + month;

		 inputObj.value = month + "/" + day + "/" + year; 
	 } 
}
$(document).ready(function () {
	
	$('input#search').quicksearch('table#tableEntries tbody tr');
	
	
});
		