$(document).ready(function () {
    $('ol.nav').nestedSortable({
        forcePlaceholderSize:true,
        handle:'div',
        helper:'clone',
        items:'li',
        maxLevels:0,
        opacity:.6,
        placeholder:'placeholder',
        revert:250,
        tabSize:25,
        tolerance:'pointer',
        toleranceElement:'> div'
    });

    $('.saveButton').click(function (e) {
        var menu = $('ol.nav').nestedSortable('serialize');
        var request = $.ajax({
            url:window.app.webroot+"menuentries/sort",
            type:"POST",
            context:document.body,
            data:menu,
            error:function () {
                alert('The sorting could not be saved');
            },
            success:function () {
               alert('New sorting successfully saved');
            }
        });
    })
});

