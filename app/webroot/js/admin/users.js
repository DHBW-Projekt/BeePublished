$(document).ready(function () {
    $('.users')
        .sortable({
            appendTo:'body',
            connectWith:'.users',
            handler:'.user_detail',
            tolerance:'pointer',
            placeholder:"users-placeholder",
            forcePlaceholderSize:true,
            receive:function (event, ui) {
                var roleId = $(ui.item).parent().attr('rel');
                var userId = $(ui.item).attr('rel');
                updateUserRole(userId, roleId);
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

function updateUserRole(userId, roleId) {
    var request = $.ajax({
        url:window.app.webroot + "users/changeRole/" + userId + "/" + roleId,
        type:"POST",
        context:document.body
    });
}