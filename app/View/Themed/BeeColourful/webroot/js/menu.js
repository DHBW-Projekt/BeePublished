function initMenu() {
    $("ol.subnav").parent().append("<span></span>");

    $("ol.nav li").hover(
        function () {
            $(this).children("ol.subnav").show();
        },
        function () {
            $(this).children("ol.subnav").hide();
        }
    );
    var menuswitchelement = $(document.createElement("a")).attr({
		"id" : "menuswitch",
		"href" : "#",
		"style" : "text-align:left;"
	});
	
	if($("#menuswitch").length<1) {
	$("#topnav-content").append(menuswitchelement);
	}
	var hidden = "false";
	if (document.cookie) {
		cookiefile = document.cookie;
//		hidden = cookiefile.slice(cookiefile.indexOf("hidden=") + 7, cookiefile
//				.indexOf("hidden=") + 12);
		if (hidden == "false") {
			$("#pagelogo").show();
			$("#menu").show();
			prepareforhide();
		} else {
			$("#pagelogo").hide();
			$("#menu").hide();
			prepareforshow();
		}
	} else {
		document.cookie = "hidden=" + hidden;
		prepareforhide();
	}
	function prepareforhide() {
		if (window.app.language == 'de'){
			var text = "Men&uuml; verstecken >>";
		} else {
			var text = "Hide menu >>";
		}
		$(menuswitchelement).html(text).click(function() {
			$("#pagelogo").hide();
			$("#menu").hide();
			hidden = "true";
			document.cookie = "hidden=" + hidden;
			prepareforshow();
		});
	}
	function prepareforshow() {
		if (window.app.language == 'de'){
			var text = "Men&uuml; anzeigen >>";
		} else {
			var text = "Show menu >>";
		}
		$(menuswitchelement).html(text).click(function() {
			$("#pagelogo").show();
			$("#menu").show();
			hidden = "false";
			document.cookie = "hidden=" + hidden;
			prepareforhide();
		});
	}
}