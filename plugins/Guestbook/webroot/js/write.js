
$(document).ready(function () {
    $('#GuestbookPostText').ckeditor(function () {
        },
        {
        	toolbar : [
        	           ['Undo', 'Redo'],
        	           ['Bold', 'Italic', 'Underline'],
        	           ['Link', 'Unlink', 'Image', 'Smiley', 'SpecialChar'],
        	           ['NumberedList', 'BulletedList', '-', 'Blockquote'],
        	       ],
        });
});