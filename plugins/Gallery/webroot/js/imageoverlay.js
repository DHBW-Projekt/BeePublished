var layout = "button_count"; 	// Options: 'standard', 'button_count', 'box_count'
var show_faces = "true"; 	// specifies whether to display profile photos below the button (standard layout only). Options: 'true', 'false'
var width = "10"; 		// the width of the Like button.
var action = "like";		// the verb to display on the button. Options: 'like', 'recommend' 
var colorscheme = "light";	// the color scheme for the like button. Options: 'light', 'dark'



$(document).ready(function() {


	function formatTitle(title, currentArray, currentIndex, currentOpts) {
		//build up URL
		var info = title.split("#");
		var domain = window.location.href.split("/");
		title = info[1];
		var url = 'http://'+ domain[2] + info[0] + 'plugin/Gallery/DisplayGallery/displaySingleImage/'+info[2]+'/'+info[3];
		var titlestyle = '<div id="picturetitle">' + (title && title.length ? '<b>' + title + '</b>' : '' ) + 'Image ' + (currentIndex + 1) + ' of ' + currentArray.length + '</div>';
		var scripter =titlestyle + '<div id ="picturesocial"> <div id="fb-root"></div><script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/de_DE/all.js#xfbml=1"; fjs.parentNode.insertBefore(js, fjs); }(document, \'script\', \'facebook-jssdk\'));</script>'; 
		var diver = '<div class="fb-like" data-href="'+url+'" data-send="true" data-width="450" data-show-faces="true"> </div> </div>';
		
		var returnvalue= scripter + diver;
		return returnvalue;
	}
	
	$(".fancybox").fancybox({
		'titlePosition' : 'inside',
		'titleFormat':  formatTitle,
		prevEffect	: 'none',
		nextEffect	: 'none',
		helpers	: {
			title	: {
				type: 'outside'
			},
			overlay	: {
				opacity : 0.8,
				css : {
					'background-color' : '#000'
				}
			},
			thumbs	: {
				width	: 50,
				height	: 50
			}
		}
		
	});
	
});