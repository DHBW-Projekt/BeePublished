$(document).ready(function () {
    $("#ConfigurationLayoutForm").relatedSelects({
        onChangeLoad:window.app.webroot + 'configuration/designs',
        selects:['data[Configuration][active_template]', 'data[Configuration][active_design]'],
        onLoadingEnd: updatePreviewImage
    });
    $('#ConfigurationActiveDesign').change(updatePreviewImage);
    $('#ConfigurationStatusText').ckeditor(function () {
    }, {});
});

function updatePreviewImage() {
    $('#layout-preview').attr('src', window.app.webroot + 'configuration/themePreview/' + $('#ConfigurationActiveTemplate').val() + '/' + $('#ConfigurationActiveDesign').val());
}