var lock = false;

function initializeGoogleMaps(panel) {
    var latlng = new google.maps.LatLng(0, 0);

    var myOptions = {
        zoom:15,
        center: latlng,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    
    if (!lock) {
    	map = new google.maps.Map(document.getElementById(panel), myOptions);
    }
}

function showLocation(panel, home) {
    var geocoder = new google.maps.Geocoder();
    var position;
    
    if (!lock) {
	    geocoder.geocode({ 'address':home}, function (results, status) {
	            if (status == google.maps.GeocoderStatus.OK) {
	                map.setCenter(results[0].geometry.location);
	                var marker = new google.maps.Marker({
	                    map:map,
	                    position:results[0].geometry.location
	                });
	            } else {
	                alert('Geocode was not successful for the following reason: ' + status);
	            }
	        }
	    );
    }
}

function printRoute(panel, start, destination) {
    var directionsDisplay = new google.maps.DirectionsRenderer();
    var directionsService = new google.maps.DirectionsService();
    
    var request = {
        origin:start,
        destination:destination,
        travelMode:google.maps.DirectionsTravelMode.DRIVING
    };

    directionsDisplay.setMap(map);
    directionsDisplay.setPanel(document.getElementById(panel));

    directionsService.route(request, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        }
    });
    
    lock = true;
}

$(document).ready(function(){
	$(".Location_row").mouseenter(function () {
        $(".set_location_link", this).css("display", "inline");
    });
	$(".Location_row").mouseleave(function () {
	    $(".set_location_link", this).css("display", "none");
	});
});