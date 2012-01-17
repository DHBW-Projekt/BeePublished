$(document).ready(function () {
    $('#EmailTemplatesPreview').ckeditor(function () {
        },
        {
         readOnly : 'true',
         toolbar : [],
         resize_enabled : false,
         toolbarCanCollapse : false
        });
    $('#EmailTemplateContent').ckeditor(function () {
    	},
    	{
    });
});