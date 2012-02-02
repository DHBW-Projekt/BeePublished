/*
 Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    config.extraPlugins = 'bbcode';
    config.removePlugins = 'bidi,button,dialogadvtab,div,flash,format,forms,horizontalrule,iframe,indent,justify,liststyle,pagebreak,showborders,stylescombo,table,tabletools,templates';
    config.disableObjectResizing = true;
    config.fontSize_sizes = "30/30%;50/50%;100/100%;120/120%;150/150%;200/200%;300/300%";
    config.toolbar = [
        ['Undo', 'Redo'],
        ['Bold', 'Italic', 'Underline'],
        ['FontSize'],
        ['TextColor'],
        ['Link', 'Unlink', 'Image', 'Smiley', 'SpecialChar'],
        ['NumberedList', 'BulletedList', '-', 'Blockquote'],
        ['Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'],
        ['Maximize', '-', 'Source']
    ];
    config.smiley_images = [
        'regular_smile.gif', 'sad_smile.gif', 'wink_smile.gif', 'teeth_smile.gif', 'tounge_smile.gif',
        'embaressed_smile.gif', 'omg_smile.gif', 'whatchutalkingabout_smile.gif', 'angel_smile.gif', 'shades_smile.gif',
        'cry_smile.gif', 'kiss.gif'
    ];
    config.smiley_descriptions = [
        'smiley', 'sad', 'wink', 'laugh', 'cheeky', 'blush', 'surprise',
        'indecision', 'angel', 'cool', 'crying', 'kiss'
    ];
    config.filebrowserBrowseUrl = window.app.webroot+'/kcfinder/browse.php?type=files&cms=beepublished';
    config.filebrowserImageBrowseUrl = window.app.webroot+'kcfinder/browse.php?type=images&cms=beepublished';
    config.filebrowserFlashBrowseUrl = window.app.webroot+'kcfinder/browse.php?type=flash&cms=beepublished';
    config.filebrowserUploadUrl = window.app.webroot+'kcfinder/upload.php?type=files&cms=beepublished';
    config.filebrowserImageUploadUrl = window.app.webroot+'kcfinder/upload.php?type=images&cms=beepublished';
    config.filebrowserFlashUploadUrl = window.app.webroot+'kcfinder/upload.php?type=flash&cms=beepublished';
};
