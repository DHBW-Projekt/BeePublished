$(document).ready(function () {
    $('#EmailTemplatesPreview').ckeditor(function () {
        },
        {
         customConfig : '',
         readOnly : 'true',
         toolbar : [],
         resize_enabled : false,
         toolbarCanCollapse : false
        });
    $('#EmailTemplateContent').ckeditor(function () {
    	},
    	{   customConfig : '',
    	    filebrowserBrowseUrl : '/kcfinder/browse.php?type=files&cms=beepublished',
        	filebrowserImageBrowseUrl : '/kcfinder/browse.php?type=images&cms=beepublished',
        	filebrowserFlashBrowseUrl : '/kcfinder/browse.php?type=flash&cms=beepublished',
        	filebrowserUploadUrl : '/kcfinder/upload.php?type=files&cms=beepublished',
        	filebrowserImageUploadUrl : '/kcfinder/upload.php?type=images&cms=beepublished',
        	filebrowserFlashUploadUrl : '/kcfinder/upload.php?type=flash&cms=beepublished',
    });
});