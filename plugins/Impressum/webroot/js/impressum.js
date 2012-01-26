function newEntrySaved() {
    $.fancybox.close();
    window.location.reload(true);
}

$(document).ready(function(){
	$('#box').click(function(){
		if($("#datadiv").css("display") == "block") {
			$('#datadiv').hide();
		} else {
			$('#datadiv').show();
		}
	});
});