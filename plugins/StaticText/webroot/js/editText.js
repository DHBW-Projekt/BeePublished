$(document).ready(function () {
    $('#nullText').ckeditor(function () {
        },
        {

        });
});

function newTextSaved() {
    window.location.reload(true);
}