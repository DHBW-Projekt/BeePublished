$(document).ready(function () {
    $('#NewsletterLetterContentPreview').ckeditor(function () {
        },
        {
         readOnly : 'true',
         toolbar : [],
         resize_enabled : false,
         toolbarCanCollapse : false
        });
    $('#NewsletterLetterContentEdit').ckeditor(function () {
    	},
    	{
    });
});