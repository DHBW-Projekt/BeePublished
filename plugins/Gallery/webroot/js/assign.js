$(document).ready(function () {
    $('.users')
        .sortable({
            appendTo:'body',
            connectWith:'.users',
            opacity: '0.6',
            handler:'.user_detail',
            tolerance:'pointer',
            placeholder:"users-placeholder",
            forcePlaceholderSize:true,
            receive:function (event, ui) {
                var roleId = $(ui.item).parent().attr('rel');
                var userId = $(ui.item).attr('rel');
                updateUserRole(roleId, userId);
            }
        });
    $('input#search-users').quicksearch('.user_detail');
    $("a.user_edit").fancybox({
        'type':'iframe',
        width:'90%',
        height:'90%'
    });
    $('a.user_delete').click(function () {
        return confirm('Are you sure?');
    });
});

function updateUserRole(galleryId, pictureId) {
	var test = window.app.webroot;
	
    var request = $.ajax({
        url:window.app.webroot + "plugin/gallery/manage_galleries/assignImage/"+ galleryId+ "/" + pictureId,
        type:"POST",
        context:document.body
    });
}