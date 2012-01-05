// Assign the value to the input with the id passed in 
function changeDate( val ) { 
 // Make sure browser supports getElementById  
 if(!document.getElementById ) return; 
 // Find the input by it's id 
 var inputObj = document.getElementById( 'datepicker' ); 
 if( inputObj ) { 
 // Update the value 
 inputObj.value = val; 
 } 
} 
// Attach all of the behaviors requiured on the page 
function attachBehaviors() { 
 // Make sure browser supports getElementById  
 if(!document.getElementById ) return; 
 // Find the link by it's id 
 var linkObj = document.getElementById( 'today' ); 
 if( linkObj ) { 
 // Attach the onclick handler 
 linkObj.onclick = function() { 
  changeDate( now.getMonth() + "/" + now.getDay() + "/" + now.getFullYear() ); 
 }; 
 } 
} 