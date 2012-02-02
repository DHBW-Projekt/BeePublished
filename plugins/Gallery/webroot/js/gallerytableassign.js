$(document).ready(function(){
	if ($(".Gallery_row").length > 0) {
		$(".Gallery_row").mouseenter(function () {
	        $(".set_gallery_link", this).css("display", "inline");
	    });
	
		$(".Gallery_row").mouseleave(function () {
		    $(".set_gallery_link", this).css("display", "none");
		});
	}
});