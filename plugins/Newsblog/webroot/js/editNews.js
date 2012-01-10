$(document).ready(function () {
	$('#editNewsTextEditor').ckeditor(
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
	
	$('#nbSaveChangesButton').click(function(){
		var months = new Array('01','02','03','04','05','06','07','08','09','10','11','12');
		
		var newText = $('#editNewsTextEditor').val();
		var newTitle = $('#nbTitleTextfield').val();
		
		var newValidFrom = $('#nbValidFromDatepicker').datepicker( "getDate" );
		if (newValidFrom == null){
			newValidFrom = new Date();
		}
		var dayFrom = newValidFrom.getDate();
		var dayFromOutput = ((dayFrom < 10) ? "0" + dayFrom : dayFrom);
		var newValidFromDB = newValidFrom.getFullYear() + '-' + months[newValidFrom.getMonth()] + '-' + dayFromOutput;
		
		var newValidTo = $('#nbValidToDatepicker').datepicker( "getDate" );
		var newValidToDB = '9999-12-31 23:59:59';
		if (newValidTo != null){
			var dayTo = newValidTo.getDate();
			var dayToOutput = ((dayTo < 10) ? "0" + dayTo : dayTo);
			newValidToDB = newValidTo.getFullYear() + '-' + months[newValidTo.getMonth()] + '-' + dayToOutput;
		}
		var webroot = window.app.webroot;
		var newsEntryId = window.app.newsentryid;
		
		var request = $.ajax({
			url:webroot + 'plugin/Newsblog/ShowNews/saveNewsData',
			type:'POST',
			context:document.body,
			data: {action: 'editNews', id: newsEntryId, title: newTitle, text: newText, validFrom: newValidFromDB, validTo: newValidToDB},
			error:function () {
				
			},
			success:function (data) {
				
			}
		});
	});
});