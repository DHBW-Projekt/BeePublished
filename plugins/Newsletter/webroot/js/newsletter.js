$(document).ready(function () {
	$('#newsletters').dataTable({
		"sPaginationType": "full_numbers",
		"aLengthMenu": [[5, 10, 15, 20, 25, -1], [5, 10, 15, 20, 25, "All"]],
        "oLanguage": {
            "sUrl" : window.app.language_path
        }
	});
	$('#recipients').dataTable({
		"sPaginationType": "full_numbers",
		"aLengthMenu": [[5, 10, 15, 20, 25, -1], [5, 10, 15, 20, 25, "All"]],
        "oLanguage": {
            "sUrl" : window.app.language_path
        }
	});
});