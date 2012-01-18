function callLayouts() {
    var request = $.ajax({
        url:window.app.webroot + "layouts/json",
        type:"POST",
        context:document.body,
        success:function () {
            createLayouts($.parseJSON(request.responseText));
        }
    });

} //fertig

function createLayouts(layouts) {
    for (var i = 0; i < layouts.length; i++) {
        $('#layouts').append($('<div></div>')
            .addClass("layout")
            .attr("id", "lt_" + layouts[i].id)
            .attr('rel',layouts[i].weight)
            .attr('class', 'sidebar-object sublayout')
            .html('<img src="'+window.app.webroot+'img/layouts/'+layouts[i].weight.replace(':','').replace(':','')+'.png" width="100%" />')
        );

    } // for

    dnd("dropzone");
} //fertig

function callPlugins() {
    var request = $.ajax({
        url:window.app.webroot + "pluginviews/json",
        type:"POST",
        context:document.body,
        success:function () {
            createPlugins($.parseJSON(request.responseText));
        }
    });
} //fertig

function createPlugins(plugins) {
    $(plugins).each(function () {
        $('#plugins').append($('<div></div>')
                        .attr("id", "pl_" + this.id)
                        .attr('rel',this.plugin + ' - ' + this.name)
                        .attr('class', 'sidebar-object plugin')
                        .html(this.plugin + ' - ' + this.name)
                    );
    });
    dnd('dropzone');
} //fertig

function createLayout(container, layout, typeid) {
    var details = $(container).attr('rel');
    if (details == undefined) {
        alert('This page doesn\'t exist in the database. Please create a page before you can add elements');
        return;
    }
    details = details.split("-");
    var parent = details[0];
    var column = details[1];
    var type = typeid.substring(3);
    var order = $(container).children().length + 1;
    var request = $.ajax({
        url:window.app.webroot + "containers/add/" + parent + "/" + column + "/" + type + "/" + order,
        type:"POST",
        context:document.body,
        success:function () {
            var columns = layout.split(":");
            var subcolumns = $('<div></div>').attr('class', 'subcolumns');
            subcolumns.append(generateLayoutHandler(request.responseText));
            for (var i = 0; i < columns.length; i++) {
                var column = columns[i];
                var columnClass = null;
                var contentClass = null;
                if (i == 0) {
                    columnClass = 'c' + column + 'l';
                    contentClass = 'subcl';
                } else if (i == columns.length - 1) {
                    columnClass = 'c' + column + 'r';
                    contentClass = 'subcr';
                } else {
                    columnClass = 'c' + column + 'l';
                    contentClass = 'subc';
                }
                var coldiv = $('<div></div>').attr('class', columnClass + ' dropzone');
                var contentdiv = $('<div></div>').attr('class', contentClass).attr('rel', request.responseText + '-' + (i + 1));

                coldiv.append(contentdiv);
                subcolumns.append(coldiv);
            }
            $(container).append(subcolumns);
            dnd("dropzone");
        }
    });
} //fertig

function removeLayout(id, container) {
    var request = $.ajax({
        url:window.app.webroot + "containers/delete/" + id,
        type:"POST",
        context:document.body,
        success:function () {
            $(container).parent().remove();
        }
    });
} //fertig

function createPlugin(container, layout, pluginid) {
    var details = $(container).attr('rel');
    if (details == undefined) {
        alert('This page doesn\'t exist in the database. Please create a page before you can add elements');
        return;
    }
    details = details.split("-");
    var parent = details[0];
    var column = details[1];
    var plugin = pluginid.substring(3);
    var order = $(container).children().length + 1;

    var request = $.ajax({
        url:window.app.webroot + "content/add/" + parent + "/" + column + "/" + plugin + "/" + order,
        type:"POST",
        context:document.body,
        success:function () {
            var plugin = $('<div></div>').attr('class', 'plugin_content');
            plugin.append(generatePluginHandler(request.responseText));
            loadPluginContent(request.responseText, plugin);
            $(container).append(plugin);
            setSettingOptions(plugin, request.responseText);
        }
    });
} //fertig

function removePlugin(id, container) {
    var request = $.ajax({
        url:window.app.webroot + "content/delete/" + id,
        type:"POST",
        context:document.body,
        success:function () {
            $(container).parent().remove();
        }
    });
} //fertig

function callPageLayout(pageid) {
    var request = $.ajax({
        url:window.app.webroot + "containers/json/" + pageid,
        type:"POST",
        context:document.body,
        success:function () {
            var layout = $.parseJSON(request.responseText);
            $('#content').attr('rel', layout['id'] + '-1');
            if (layout['columns'] != undefined) {
                loadPageLayout(layout['columns']['1']['children'], $('#content'));
            }
        }
    });

} // function callPageLayout

function loadPageLayout(layout, object) {
    for (var content in layout) {
        var container = layout[content];
        if (container['Plugin'] == undefined) {
            var subcolumns = $('<div></div>').attr('class', 'subcolumns');

            subcolumns.append(generateLayoutHandler(container['id']));

            var counter = 1;
            for (var column in container['columns']) {
                column = container['columns'][column];
                var coldiv = $('<div></div>').attr('class', column['class'] + ' dropzone');
                var contentdiv = $('<div></div>').attr('class', column['contentClass']).attr('rel', container['id'] + '-' + counter);

                coldiv.append(contentdiv);
                loadPageLayout(column['children'], contentdiv);
                subcolumns.append(coldiv);
                counter++;
            }

            object.append(subcolumns);
        } else {
            var plugin = $('<div></div>').attr('class', 'plugin_content');
            plugin.append(generatePluginHandler(container['id']));
            loadPluginContent(container['id'], plugin);
            object.append(plugin);
        }
    }
    dnd("dropzone");
}

function loadPluginContent(id, container) {
    var request = $.ajax({
        url:window.app.webroot + "content/display/" + id + "/" + window.app.pageid,
        type:"GET",
        context:document.body,
        success:function () {
            container.append(request.responseText);
            setSettingOptions(container, id);
        }
    });
}

function dnd(dropzoneClass) {

    $(".tab-content").sortable({
        opacity:0.35,
        appendTo:'body',
        helper:'clone'
    });

    $('.subcl, .subcr, .subc, #content')
        .sortable({
            handle:".handler",
            appendTo:'body',
            connectWith:'.subcl, .subcr, .subc, #content',
            placeholder:"placeholder",
            forcePlaceholderSize:true,
            tolerance:'pointer',
            receive:function (event, ui) {
                updatePosition(event, ui);
            },
            stop:function (event, ui) {
                updatePosition(event, ui);
            }
        })
        .droppable({
            accept:".sublayout, .plugin",
            hoverClass:"ui-state-active",
            greedy:true,
            drop:function (event, ui) {
                switch ($(ui.draggable).attr("class")) {
                    case 'sidebar-object sublayout':
                        createLayout(this, $(ui.draggable).attr('rel'), $(ui.draggable).attr('id'));
                        break;
                    case 'sidebar-object plugin':
                        createPlugin(this, $(ui.draggable).attr('rel'), $(ui.draggable).attr('id'));
                        break;
                }
            }
        });
} //fertig

function generateLayoutHandler(id) {
    var layoutHandler = $('<div></div>').html('Layout').attr('class', 'handler ui-state-default').attr('rel', id);
    var layoutCloseButton = $('<div><img src="' + window.app.webroot + 'img/delete.png" width="15" height="15"/></div>');
    layoutCloseButton.css({
        'position':'absolute',
        'right':'2px',
        'top':'2px'
    });
    layoutCloseButton.click(function () {
        if (confirm('Do you really want to delete this container and all subcontainers?')) {
            removeLayout(layoutHandler.attr('rel'), layoutHandler);
        }
    });
    layoutHandler.append(layoutCloseButton);
    return layoutHandler;
}

function generatePluginHandler(id) {
    var pluginHandler = $('<div></div>').html('Plugin').attr('class', 'handler ui-state-default').attr('rel', id);
    var pluginCloseButton = $('><div><img src="' + window.app.webroot + 'img/delete.png" width="15" height="15"/></div>');
    pluginCloseButton.css({
        'position':'absolute',
        'right':'2px',
        'top':'2px'
    });
    pluginCloseButton.click(function () {
        if (confirm('Do you really want to delete this plugin?')) {
            removePlugin(pluginHandler.attr('rel'), pluginHandler);
        }
    });
    pluginHandler.append(pluginCloseButton);
    return pluginHandler;
}

function setSettingOptions(container, id) {
    $(".plugin_content").mouseenter(function () {
        $(".setting_button", this).css("display", "inline");
    });
    $(".plugin_content").mouseleave(function () {
        $(".setting_button", this).css("display", "none");
    });
    $("a#overlay").fancybox({
        'type':'iframe',
        width:'90%',
        height:'90%',
        'onClosed':function () {
            container.empty();
            container.append(generatePluginHandler(id));
            loadPluginContent(id, container);
        }
    });
}

function updatePosition(event, ui) {
    var id = $(ui.item).children('.handler').attr('rel');
    var details = $(ui.item).parent().attr('rel');
    details = details.split("-");
    var parent = details[0];
    var column = details[1];
    var position = $(ui.item).index() + 1;
    var type = null;
    switch ($(ui.item).attr("class")) {
        case 'subcolumns':
            type = 'containers';
            break;
        case 'plugin_content':
            type = 'content';
            break;
    }
    var request = $.ajax({
        url:window.app.webroot + type + "/newPosition/" + id + "/" + parent + "/" + column + "/" + position,
        type:"POST",
        context:document.body
    });
}