function callMenu() {
    var request = $.ajax({
        url:window.app.webroot+"menuentries/json",
        type:"POST",
        context:document.body,
        success:function () {
            var menu = $.parseJSON(request.responseText);
            $('.nav').empty();
            menuCounter = 1;
            createMenu(menu, $('.nav'), '0');
            initMenu();
            //menuSetup();
        }
    });
}

function createMenu(menuData, append, parentid) {

    if (menuData == null) {
        menuData = "";
    } // if

    if (menuData.length > 0) {
        for (var i = 0; i < menuData.length; i++) {
            var content;

            if (menuData[i]['link'] != null) {
                var link = $('<a></a>')
                    .attr('href', menuData[i]['link'])
                    .html(menuData[i]['name']);
                content = $('<li></li>').html(link);
            } else {
                content = $('<li></li>').html(menuData[i]['name']);
            }
            content.attr({id:"menu_entry_" + menuData[i]['id']});

            var edit = $('<a href="'+window.app.webroot+'menuentries/edit/' + menuData[i]['id'] + '"><img src="'+window.app.webroot+'img/edit.png" width="16" height="16"></a>');
            edit.attr('class', 'iframe');
            edit.fancybox({
                width:'90%',
                height:'90%'
            });
            var del = $('<img src="'+window.app.webroot+'img/delete.png" width="16" height="16">');
            del.click({'id':menuData[i]['id'], 'page':menuData[i]['page']}, deleteEntry);

            var control = $('<div></div>');
            control.append(edit);
            control.append(del);
            control.attr('class', 'editIconContainer');
            content.append(control);

            var subcontent = $('<ol></ol>');
            var id = menuData[i]['id'];
            subcontent.attr({class:'subnav'});
            if (typeof(menuData[i]['submenu']) != 'undefined') {
                createMenu(menuData[i]['submenu'], subcontent, id);
            } else {
                createMenu(null, subcontent, id);
            }
            content.append(subcontent);
            append.append(content);
        }
    } // if

    if (window.app.language == 'de'){
    	var text = 'Eintrag hinzuf&uuml;gen'
    } else {
    	var text = 'Add entry'
    }
    
    var link = $('<a></a>')
        .html(text)
        .attr('href', window.app.webroot+'menuentries/add/' + parentid)
        .attr('class', 'iframe')
        .fancybox({
            width:'90%',
            height:'90%'
        });

    append.append($('<li></li>')
        .html(link)
    );

} // function createMenu

function closeAfterSave() {
    callMenu();
    $.fancybox.close();
}

function deleteEntry(data) {
    if (confirm('Do you really want to delete this entry?')) {
        var request = $.ajax({
            url:window.app.webroot+"menuentries/delete/" + data['data']['id'],
            type:"POST",
            context:document.body,
            error:function () {
                alert(request.responseText);
            },
            success:function () {
                callMenu();
            }
        });
    }
}