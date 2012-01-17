$(document).ready(function () {
    $("#ConfigurationIndexForm").relatedSelects({
        onChangeLoad:window.app.webroot+'configuration/designs',
        selects:['data[Configuration][active_template]', 'data[Configuration][active_design]']
    });
    $('#ConfigurationStatus-text').ckeditor(function () {},{});
});