$(document).ready(function () {
	$(".newsletter-overlay").fancybox({
        'type':'iframe',
        'onClosed':function () {
            window.location.reload(true);
        }
    });
}