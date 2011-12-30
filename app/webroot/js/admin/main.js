$(document).ready(function () {
    //formatPage();
    callMenu();
    $("#sidebar-menu").accordion({ autoHeight:true });
    //callPages();
    //callLayouts();
    getPluginList();
    $('.sort a').fancybox({
        'onClosed': function() {
            callMenu();
        }
    });
});

$(window).resize(function () {
    //formatPage();
});

function formatPage() {

    /*var maxheight = $(window).height();
     var maxwidth = $(window).width();

     $('#sidebar-content').height(maxheight-200);

     $('#content').height(maxheight-200);
     $('#content').width(maxwidth-220);

     $('#content').height(maxheight-200);
     $('#content').width(maxwidth-210);

     $('#footer').width(maxwidth-210);
     $('#header').width(maxwidth-210);*/

} // function formatPage
	
	 