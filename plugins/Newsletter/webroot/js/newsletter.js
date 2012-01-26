$(document).ready(function () {
	$('input#search_recipient').quicksearch('table#recipients tbody tr');
	$('input#search_newsletter').quicksearch('table#newsletters tbody tr');
});