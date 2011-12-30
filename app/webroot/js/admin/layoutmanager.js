function callLayouts() {
    var request;
    var layouts;

    request = $.ajax({
        url:"../../DualonCMS/LayoutManager/jsonCall",
        type:"POST",
        context:document.body,
        beforeSend:function () {
        },
        error:function () {
        },
        success:function () {
            layouts = $.parseJSON(request.responseText);
            createLayouts(layouts);
        }
    });

} // function callLayouts

function createLayouts(layouts) {

    $('#layouts').append($('<ul></ul>')
        .attr({id:"layout_container"})
    );

    for (var i = 0; i < layouts.length; i++) {
        $('#layout_container').append($('<li></li>')
            .addClass("layout")
            .attr("id", "layouttype_" + layouts[i].id)
            .html(layouts[i].weight)
        );

    } // for

    dnd("dropzone");

} // function createLayouts

function getContainerID() {

    var request;
    var jsonstring;
    var id = $('#content > .active').attr('id');

    request = $.ajax({
        url:"../../DualonCMS/LayoutManager/getContainerID",
        type:"POST",
        context:document.body,
        beforeSend:function () {
        },
        error:function () {
        },
        success:function () {
            jsonstring = preparePageLayout(id, request.responseText);
            savePageLayout(jsonstring);
        }
    });


} // function getContainerID

function savePageLayout(jsonstring) {

    var request;
    var id = $('#content > .active').attr('id').replace('page_', '');
    var pagename = $('#menu_' + id).find('span').html();

    //alert(pagename);
    //alert(jsonstring);
    alert("localhost/DualonCMS/LayoutManager/savePageLayout/?pagename=" + pagename + "&jsonstring=" + escape(jsonstring));

    request = $.ajax({
        url:"../../DualonCMS/LayoutManager/savePageLayout/?pagename=" + pagename + "&jsonstring=" + jsonstring,
        type:"POST",
        context:document.body,
        beforeSend:function () {
        },
        error:function () {
        },
        success:function () {
            // u mad?
            $('#troll').show();
            //alert("Gespeichert");
        }
    });


} // function savePageLayout

function createPlugins(plugins) {
    var pluginlist = $(document.createElement('ul')).attr({
        "id":"plugin_container"
    });

    $("#plugins").append(pluginlist);

    $(plugins).each(function () {
        var plugin = $(document.createElement('li')).attr({
            "id":"pluginid_" + this.id,
            "class":"plugin"
        }).html(this.name);
        $(pluginlist).append(plugin);
    });
    dnd('dropzone');
} // createPlugins


function getPluginList() {
    var request;
    var plugins;

    request = $.ajax({
        url:"/LayoutManager/getPluginList",
        type:"POST",
        context:document.body,
        beforeSend:function () {
        },
        error:function () {
        },
        success:function () {
            //alert(request.responseText);
            plugins = $.parseJSON(request.responseText);
            createPlugins(plugins);
        }
    });
} // function getPluginList

var layouts = new Array();

function setupLayouts(data) {
    $(data).each(function (index, value) {
        layout = {
            "id":this.id,
            "weight":this.weight
        };
        layouts.push(layout);
    });
}

function getLayout(id) {
    weight = null;
    id = parseInt(id);
    $(layouts).each(function () {
        if (id == this.id)
            weight = this.weight;
    });
    layout = weight.split(":");
    return layout;
}

function createPlugin(container, plugin, id) {
    var me = container;
    var row = $(document.createElement('div')).attr({
        "class":"row " + id,
        "id":"type_plugin"
    });

    var plugindiv = $(document.createElement('div')).attr({
        "class":"type_plugin"
    });

    $(plugindiv).css({
        "padding":"15px",
        "width":"100%",
        "height":"100%",
        "border":"1px dotted black",
        "overflow":"hidden"
    });

    var plugincontent = $(document.createElement('div')).attr({
        "class":""
    }).html($(plugin).html());
    //anstatt html($(plugin).html()) ajax call -> get pluginhtml und in html() die response reinschreiben

    var handle = $(document.createElement('div')).attr({
        "class":"handle ui-widget-header "
    });

    var close_btn = $(document.createElement('span')).attr({
        "class":"close_btn"
    }).html("Delete Plugin");

    $(close_btn).css({
        "position":"absolute",
        "cursor":"pointer",
        "z-index":"100"
    });

    //Append to parent
    $(handle).append(close_btn);
    $(plugindiv).append(handle);
    $(plugindiv).append(plugincontent);
    $(row).append(plugindiv);
    $(me).append(row);

    //adjust handle width
    $(".handle").each(function () {
        width = parseInt($(this).width());
        width += 30;
        $(this).css("width", width + "px");
    });

    //adjust height of rows
    rows = $(me).children(".row");
    height = 100 / $(rows).size();
    $(rows).each(function () {
        $(this).css({
            "height":height + "%"
        });
    });

    // event handling
    $(plugindiv, handle).hover(function () {
        $(handle).show();
    });

    $(plugindiv, handle).hover(
        function () {
            $.data(this, 'hover', true);
        },
        function () {
            $.data(this, 'hover', false);
        }
    ).data('hover', false);

    $(plugindiv).mouseout(function (event) {
        if (!($(plugindiv, handle).data('hover')))
            $(handle).hide();
    });

    $(handle).mouseout(function (event) {
        if (!($(plugindiv, handle).data('hover')))
            $(handle).hide();
    });

    $(close_btn).click(function () {
        parent = $(this).parent().parent().parent().parent();
        $(this).parent().parent().parent().remove();
        rows = $(parent).children(".row");
        height = 100 / $(rows).size();
        $(rows).each(function () {
            $(this).css({
                "height":height + "%"
            });
        });
    });
}

function createColumns(container, layouttype, layouttypeid, parent_id) {
    var me = container;
    var summe = 0;
    var parentid = null;
    if (parent_id == undefined)
        parentid = "nn";
    else
        parentid = parent_id;

    $(layouttype).each(function () {
        summe += parseInt(this);
    });

    var row = $(document.createElement('div')).attr({
        "class":"row layouttype_" + layouttypeid + " parentid_" + parentid,
        "id":"type_layout"
    });

    $(layouttype).each(function () {
        var width = parseInt(this);

        if (summe < 100)
            width += 0.33;

        var col = $(document.createElement('div')).attr({
            "class":"dropzone type_layout"
        });

        $(col).css({
            "width":width + "%",
            "height":"100%",
            "float":"left",
            "border":"1px dotted black",
            "overflow":"hidden",
            "padding":"15px"
        });

        var handle = $(document.createElement('div')).attr({
            "class":"handle ui-widget-header "
        });


        var close_btn = $(document.createElement('span')).attr({
            "class":"close_btn"
        }).html("Delete Layout");

        $(close_btn).css({
            "position":"absolute",
            "cursor":"pointer",
            "z-index":"100"
        });

        //Append to parent
        $(handle).append(close_btn);
        $(col).append(handle);
        $(row).append(col);

        // event handling
        $(col, handle).hover(function () {
            $(handle).show();
        });

        $(col, handle).hover(
            function () {
                $.data(this, 'hover', true);
            },
            function () {
                $.data(this, 'hover', false);
            }
        ).data('hover', false);

        $(col).mouseout(function (event) {
            if (!($(col, handle).data('hover')))
                $(handle).hide();
        });

        $(handle).mouseout(function (event) {
            if (!($(col, handle).data('hover')))
                $(handle).hide();
        });

        $(close_btn).click(function () {
            parent = $(this).parent().parent().parent().parent();
            $(this).parent().parent().parent().remove();
            rows = $(parent).children(".row");
            height = 100 / $(rows).size();
            $(rows).each(function () {
                $(this).css({
                    "height":height + "%"
                });
            });
        });
    });

    //append row to parent
    $(me).append(row);

    //adjust handle width
    $(".handle").each(function () {
        width = parseInt($(this).width());
        width += 30;
        $(this).css("width", width + "px");
    });

    //adjust height of rows
    rows = $(me).children(".row");
    height = 100 / $(rows).size();
    $(rows).each(function () {
        $(this).css({
            "height":height + "%"
        });
    });

    // make columns dragable + dropable
    dnd("dropzone");
}

function callPageLayout(pagename) {
    var request;
    var layouts;
    var pageid = $('#content > .active').attr('id');
    var menuid = $('#menu_' + pageid.replace('page_', '')).attr('id');
    var menuname = $('#' + menuid + ' > span').html();

    //empty existing layout
    $("#" + pageid).empty();

    //alert(menuname);
    request = $.ajax({
        url:"../../DualonCMS/LayoutManager/getLayoutTree/?pagename=" + menuname,
        type:"POST",
        context:document.body,
        beforeSend:function () {
        },
        error:function () {
        },
        success:function () {
            alert(request.responseText);
            loadPageLayout(pageid, request.responseText);
        }
    });

} // function callPageLayout

function loadPageLayout(pageid, jsonstring) {
    //get json string with pageid from backend service
    //jsonstring =...

    //var jsonstring = "{\"layoutobjects\":[{\"containers\":[{\"id\":1,\"parent_id\":\"null\",\"layout_type_id\":\"null\",\"column\":\"0\",\"order\":\"0\"},{\"id\":2,\"parent_id\":1,\"layout_type_id\":1,\"column\":\"1\",\"order\":1},{\"id\":3,\"parent_id\":2,\"layout_type_id\":1,\"column\":2,\"order\":1},{\"id\":4,\"parent_id\":1,\"layout_type_id\":5,\"column\":\"1\",\"order\":2},{\"id\":5,\"parent_id\":4,\"layout_type_id\":1,\"column\":1,\"order\":1},{\"id\":6,\"parent_id\":4,\"layout_type_id\":2,\"column\":2,\"order\":1},{\"id\":7,\"parent_id\":4,\"layout_type_id\":5,\"column\":3,\"order\":1}]},{\"plugins\":[{\"module_id\":5,\"parent_id\":3,\"column\":2,\"order\":1},{\"module_id\":8,\"parent_id\":6,\"column\":2,\"order\":1},{\"module_id\":10,\"parent_id\":7,\"column\":2,\"order\":1},{\"module_id\":13,\"parent_id\":7,\"column\":3,\"order\":1}]},{\"layouts\":[{\"id\":\"1\",\"weight\":\"50:50\"},{\"id\":\"2\",\"weight\":\"33:66\"},{\"id\":\"3\",\"weight\":\"25:75\"},{\"id\":\"4\",\"weight\":\"75:25\"},{\"id\":\"5\",\"weight\":\"33:33:33\"}]}]}";
    var layoutobjects = $.parseJSON(jsonstring);
    var containers = layoutobjects["layoutobjects"]["containers"];

    if (layoutobjects["layoutobjects"]["plugins"] != undefined)
        var plugins = layoutobjects["layoutobjects"]["plugins"];
    var layouts = layoutobjects["layoutobjects"]["layouts"];

    setupLayouts(layouts);

    var pagediv = $("#content > .active");

    var maincontainerid = containers[0].id;

    //load containers
    $(containers).each(function (index, value) {
        if (this.id == maincontainerid) {
            $(pagediv).addClass("parentid_" + this.id);
        }
        if (this.parent_id == maincontainerid) {
            layouttype = getLayout(this.layout_type_id);
            createColumns(pagediv, layouttype, this.layout_type_id, this.id);
        } else if (this.parent_id != maincontainerid) {
            if (this.layout_type_id != undefined && this.layout_type_id != "null" && this.layout_type_id != "0") {
                parent = $(".parentid_" + this.parent_id);
                var column = parseInt(this.column);
                $(parent).children(".dropzone").each(function (index, value) {
                    if ((index + 1) == column)
                        column = this;
                });
                layouttype = getLayout(this.layout_type_id);
                createColumns(column, layouttype, this.layout_type_id, this.id);
            }
        }
    });

    //load plugins
    $(plugins).each(function (index, value) {
        if (this.container_id == maincontainerid) {
            createPlugin(pagediv, $(this), this.plugin_id);
        } else {
            parent = $(".parentid_" + this.container_id);
            var column = parseInt(this.column);
            $(parent).children(".dropzone").each(function (index, value) {
                if ((index + 1) == column)
                    column = this;
            });
            createPlugin(column, $(this), this.plugin_id);
        }
    });

    rows = $(pagediv).children(".row");
    height = 100 / $(rows).size();
    $(rows).each(function () {
        $(this).css({
            "height":height + "%"
        });
    });
    //
}

function preparePageLayout(pageid, maxids) {
    var ids = maxids.split("|");
    var maxcontainerid = parseInt(ids[0]);
    var maxcontentid = parseInt(ids[1]);
    var id = maxcontainerid;
    var contentid = maxcontentid;
    var jsonString = null;
    var layoutobjects = new Object();
    var containers = new Object();
    containers["containers"] = new Array();
    var plugins = new Object();
    plugins["plugins"] = new Array();
    var parentid = null;

    var rows = $('#' + pageid).children(".row");

    if ($(rows).size() > 0) {
        var mainContainer = {
            "id":maxcontainerid,
            "parent_id":"null",
            "layout_type_id":"null",
            "column":"0",
            "order":"0"
        };

        containers["containers"].push(mainContainer);

        $(rows).each(function (i, value) {
            var type = $(this).attr("id");
            type = type.replace("type_", "");

            if (type == "plugin") {
                var pluginid = $(this).attr("class");
                pluginid = parseInt(pluginid.replace(/row\spluginid_/g, ""));
                var plugin = {
                    "id":contentid,
                    "plugin_id":pluginid,
                    "container_id":maxcontainerid,
                    "column":1,
                    "order":i + 1
                };
                contentid++;
                plugins["plugins"].push(plugin);
            } else {
                var layouttypeid = $(this).attr("class");
                layouttypeid = parseInt(layouttypeid.replace(/row\slayouttype_/g, ""));
                id++;
                var container = {
                    "id":id,
                    "parent_id":maxcontainerid,
                    "layout_type_id":layouttypeid,
                    "column":"1",
                    "order":i + 1
                };
                containers["containers"].push(container);

                parentid = id;
                var columns = $(this).children('.dropzone');

                $(columns).each(function (k, value) {
                    var columnorder = k + 1;
                    var innerrows = $(this).children(".row");

                    $(innerrows).each(function (j, value) {
                        var type = $(this).attr("id");
                        type = type.replace("type_", "");

                        if (type == "plugin") {
                            var pluginid = $(this).attr("class");
                            pluginid = parseInt(pluginid.replace(/row\spluginid_/g, ""));
                            var plugin = {
                                "id":contentid,
                                "plugin_id":pluginid,
                                "container_id":parentid,
                                "column":columnorder,
                                "order":j + 1
                            };
                            contentid++;
                            plugins["plugins"].push(plugin);
                        } else {
                            var layouttypeid = $(this).attr("class");
                            layouttypeid = parseInt(layouttypeid.replace(/row\slayouttype_/g, ""));
                            id++;
                            var container = {
                                "id":id,
                                "parent_id":parentid,
                                "layout_type_id":layouttypeid,
                                "column":columnorder,
                                "order":j + 1
                            };
                            containers["containers"].push(container);

                            var innerparentid = id;

                            var innercolumns = $(this).children('.dropzone');

                            $(innercolumns).each(function (n, value) {
                                var columnorder = n + 1;
                                var pluginrows = $(this).children(".row");
                                $(pluginrows).each(function (m, value) {
                                    var pluginid = $(this).attr("class");
                                    pluginid = parseInt(pluginid.replace(/row\spluginid_/g, ""));
                                    var plugin = {
                                        "id":contentid,
                                        "plugin_id":pluginid,
                                        "container_id":innerparentid,
                                        "column":columnorder,
                                        "order":m + 1
                                    };
                                    contentid++;
                                    plugins["plugins"].push(plugin);
                                });
                            });
                        } // else
                    }); // innerrows
                }); // each columns
            } // else
        }); // each outerrows

        layoutobjects["layoutobjects"] = new Array();
        layoutobjects["layoutobjects"].push(containers);
        layoutobjects["layoutobjects"].push(plugins);
        /*
         var layouts = new Object();
         layouts["layouts"] = new Array();
         layouts["layouts"].push({
         "id": "1",
         "weight": "50:50"
         });
         layouts["layouts"].push({
         "id": "2",
         "weight": "33:66"
         });
         layouts["layouts"].push({
         "id": "3",
         "weight": "25:75"
         });
         layouts["layouts"].push({
         "id": "4",
         "weight": "75:25"
         });
         layouts["layouts"].push({
         "id": "5",
         "weight": "33:33:33"
         });
         layoutobjects["layoutobjects"].push(layouts);
         */
        jsonString = JSON.stringify(layoutobjects);

        return jsonString;
    } else {
        return false;
    }
} // function savePageLayout

function dnd(dropzoneClass) {
    //adjust accordion height
    var sidebarheight = $("#sidebar-menu").height() - 4 * $("h3").height();

    $($("#sidebar-menu > div")).each(function () {
        $(this).css("height", sidebarheight + "px");
    });

    // make widgets and layouts draggable + sortable
    $("#plugin_container").sortable({
        opacity:0.35,
        appendTo:'body',
        helper:'clone'
    });

    $("#layout_container").sortable({
        opacity:0.35,
        appendTo:'body',
        helper:'clone'
    });

    //	var dropzoneArr = $("."+dropzoneClass);
    //	 dropzone handling
    //	var prevDiv = null;
    //	var prevDropObj = null;

    $("." + dropzoneClass).droppable({
        accept:".layout , .plugin",
        hoverClass:"ui-state-active",
        greedy:true,
        //		over: function(event, ui){
        //			height = $(this).height();
        //			bottom = height * 0.9;
        //			$(this).mousemove(function(e){
        //			      if(e.pageY >= bottom)
        //			    	  $(".50_50").css("height", "50%");
        //			 });
        //		},
        drop:function (event, ui) {
            var me = this;
            //			if(this.innerHTML == ""){
            //				if(prevDropObj == this)
            //					$(prevDiv).remove();
            //				prevDropOjb = this;
            //				var div = $(document.createElement('div')).attr({
            //					name: $(ui.draggable).attr("id"),
            //					"class": widgetClass
            //				});
            //				$(div).css("background-image", ui.draggable.css("background-image"));
            //				$(div).draggable({
            //					revert: true,
            //					opacity: 0.35
            //				});
            //				$(this).append(div);
            //				prevDiv = div;
            //				$(ui.draggable).hide();
            switch ($(ui.draggable).attr("class")) {
                case "plugin":
                    var pluginid = $(ui.draggable).attr('id');
                    createPlugin(me, $(ui.draggable), pluginid);
                    break;
                case "layout":
                    var id = "";

                    if (!($(this).parent().parent().parent().parent().attr("id") == null)) {
                        id = $(this).parent().parent().parent().parent().attr("id");
                    } // if

                    if (id.indexOf("page_") == -1) {
                        layouttype = $(ui.draggable).html();
                        layouttype = layouttype.split(":");
                        layouttypeid = $(ui.draggable).attr('id');
                        layouttypeid = layouttypeid.replace("layouttype_", "");

                        createColumns(me, layouttype, layouttypeid);
                    } else {
                        alert('Maximum count of layers reached!');
                    }
                    break;
                default:
                    break;
            }
            //
        }
    }).sortable({
            handle:".handle"
        });

//		$("body").droppable({
//			accept: ".dropable",
//			drop: function( event, ui ) {
//				$("#"+ui.draggable.attr("name")).show();
//				$(ui.draggable).remove();
//			}
//		});		
}