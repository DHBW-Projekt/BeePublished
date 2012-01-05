$(document).ready(function () {
	$(".newsletter-overlay").fancybox({
        'type':'iframe',
        'width':'90%',
        'height':'90%',
        'onClosed':function () {
            window.location.reload(true);
        }
    });
});
