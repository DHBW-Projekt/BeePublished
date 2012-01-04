$(document).ready(function () {
	$('#editNewsTextEditor').ckeditor(
		function() { /* callback code */ },
		{ 
			toolbar: 'Basic'
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
		var newText = $('#editNewsTextEditor').val();
		var newTitle = $('#nbTitleTextfield').val();
		var newValidFrom = $('#nbValidFromDatepicker').datepicker( "getDate" );
		var newValidFromDB = newValidFrom.getFullYear() + '-' + newValidFrom.getMonth() + '-' + newValidFrom.getDate();
		var newValidTo = $('#nbValidToDatepicker').datepicker( "getDate" );
		var newValidToDB = '9999-12-31 23:59:59';
		if (newValidTo != null){
			newValidToDB = newValidTo.getFullYear() + '-' + newValidTo.getMonth() + '-' + newValidTo.getDate();
		}
		var webroot = window.app.webroot;
		var newsEntryId = window.app.newsentryid;
		
		var request = $.ajax({
			url:webroot + 'plugin/Newsblog/ShowNews/saveNewsData',
			type:'POST',
			context:document.body,
			data: {action: 'editNews', id: newsEntryId, title: newTitle, text: newText, validFrom: newValidFromDB, validTo: newValidToDB},
			error:function () {
				alert(request.responseText);
			},
			success:function (data) {
				alert(data);
			}
		});
	});
});