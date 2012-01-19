function newEntrySaved() {
    $.fancybox.close();
    window.location.reload(true);
}

$(document).ready(function(){
	$('#reg').click(function(){
		if($("#regdiv").css("display") == "true") {
			$('#regdiv').hide();
		} else {
			$('#regdiv').show();
		}
	});
});