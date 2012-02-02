/*
 * This file is part of BeePublished which is based on CakePHP.
 * BeePublished is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3
 * of the License, or any later version.
 * BeePublished is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public
 * License along with BeePublished. If not, see
 * http://www.gnu.org/licenses/.
 *
 * @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
 * @author Alexander Müller & Fabian Kajzar
 * 
 * 
 */

var layout = "button_count"; 	// Options: 'standard', 'button_count', 'box_count'
var show_faces = "true"; 	// specifies whether to display profile photos below the button (standard layout only). Options: 'true', 'false'
var width = "10"; 		// the width of the Like button.
var action = "like";		// the verb to display on the button. Options: 'like', 'recommend' 
var colorscheme = "light";	// the color scheme for the like button. Options: 'light', 'dark'

$(document).ajaxComplete(function(){
  
});


$(document).ready(function() {

	function formatTitle(title, currentArray, currentIndex, currentOpts) {
		//build up URL
		var info = title.split("#");
		var domain = window.location.href.split("/");
		title = info[1];
		var url = 'http://'+ domain[2] + info[0] + 'plugin/Gallery/DisplaySingleImage/display/'+info[2]+'/'+info[3];
		var titlestyle = '<div id="picturetitle">' + (title && title.length ? '<b>' + title + '</b>' : '' ) + 'Image ' + (currentIndex + 1) + ' of ' + currentArray.length + '</div>';
		//var obj = d.getElementById(id); if (d.getElementById(id)){ alert("test"); d.removeChild(obj); }
		//if (d.getElementById(id)){ var fbtest = d.getElementById(fbcontainertodelete); var children = fbtest.childNodes; fbtest.removeChild(children[0]); d.removeChild(d.getElementById(id));
		var scripter =titlestyle + '<div id ="picturesocial"> <div id="fb-root"></div> <script>  (function(d, s, id, deleteid) { var js, fjs = d.getElementsByTagName(s)[0]; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/de_DE/all.js#xfbml=1"; fjs.parentNode.insertBefore(js, fjs); }(document, \'script\', \'facebook-jssdk\', \'fbcontainertodelete\'));</script>'; 
		var diver = '<div id= "fbcontainertodelete" class="fb-like" data-href="'+url+'" data-send="true" data-width="450" data-show-faces="true"> </div> </div>';
		 
		var returnvalue= scripter + diver;
		return returnvalue;
	}


	$(".fancybox").fancybox({
		'titlePosition' : 'inside',
		'titleFormat':  formatTitle,
		prevEffect	: 'none',
		nextEffect	: 'none',
		helpers	: {
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