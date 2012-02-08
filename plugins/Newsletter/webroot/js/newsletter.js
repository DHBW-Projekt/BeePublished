$(document).ready(function () {
	$('#newsletters').dataTable({
		"sPaginationType": "full_numbers",
		"aLengthMenu": [[5, 10, 15, 20, 25], [5, 10, 15, 20, 25]],
        "oLanguage": {
            "sUrl" : window.app.language_path
        }
	});
	$('#recipients').dataTable({
		"sPaginationType": "full_numbers",
		"aLengthMenu": [[5, 10, 15, 20, 25], [5, 10, 15, 20, 25]],
        "oLanguage": {
            "sUrl" : window.app.language_path
        }
	});
});