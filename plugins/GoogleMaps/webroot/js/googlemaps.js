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
* @author Patrick Zamzow
*
* @description Google Maps
*/

//prefer route instead of map
var lock = false;

//init map
function initializeGoogleMaps(panel) {
	try {
		var latlng = new google.maps.LatLng(0, 0);
		
	    var myOptions = {
	        zoom:15,
	        center: latlng,
	        mapTypeId:google.maps.MapTypeId.ROADMAP
	    };
	    
	    if (!lock) {
	    	if (panel=getPanelID(panel, 'map')) {
	    		return new google.maps.Map(document.getElementById(panel), myOptions);
	    	}
	    		return null;
	    }
	} catch(e) {
	    window.location.reload();
	}
}

//get an existing div id
function getPanelID(panel, type) {
	if (!document.getElementById(panel)) {
    	var elems = document.getElementsByTagName("div");
    	for (var i=0;i<elems.length;i++) {
    		var match = new RegExp ("^"+type+"_[0-9]*");
    		if (elems[i].id.match(match)!=null) {
    			return elems[i].id;
    		}
    	}
    	return null;
    } else {
    	return panel;
    }
}

//show location
function showLocation(panel, home) {
    var map = initializeGoogleMaps(panel);
    var geocoder = new google.maps.Geocoder();
    var position;
    
    if (!lock && home!='' && map!=null) {
	    geocoder.geocode({ 'address':home}, function (results, status) {
	            if (status == google.maps.GeocoderStatus.OK) {
	                map.setCenter(results[0].geometry.location);
	                var marker = new google.maps.Marker({
	                    map:map,
	                    position:results[0].geometry.location
	                });
	            }
	        }
	    );
    }
}

//print route
function printRoute(routingPanel, start, destination) {
    //get first map which is on the current page
    var map = initializeGoogleMaps("map");
    var directionsDisplay = new google.maps.DirectionsRenderer();
    var directionsService = new google.maps.DirectionsService();

    var request = {
        origin:start,
        destination:destination,
        travelMode:google.maps.DirectionsTravelMode.DRIVING
    };
    
    if (map!=undefined) directionsDisplay.setMap(map);
    directionsDisplay.setPanel(document.getElementById(getPanelID(routingPanel, "routing")));

    directionsService.route(request, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        }
    });
    
    lock = true;
}

//quick search and hover
$(document).ready(function(){
	if ($('input#search_locations').length > 0)
		$('input#search_locations').quicksearch('table#locations tbody tr');
	
	if ($(".Location_row").length > 0) {
		$(".Location_row").mouseenter(function () {
	        $(".set_location_link", this).css("display", "inline");
	    });
	
		$(".Location_row").mouseleave(function () {
		    $(".set_location_link", this).css("display", "none");
		});
	}
});