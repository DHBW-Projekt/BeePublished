$(document).ready(function () {
    $('#NewsletterLetterContentPreview').ckeditor(function () {
        },
        {
         readOnly : 'true',
         toolbar : [],
         resize_enabled : false,
         toolbarCanCollapse : false,
         height : 250,
         width: 650
        });
    $('#NewsletterLetterContentEdit').ckeditor(function () {
    	},
    	{
    		height : 250,
    		width: 650
    	});
    $('#PluginTextText').ckeditor(function () {
		},
		{
			height : 100,
			width: 650
		});
});