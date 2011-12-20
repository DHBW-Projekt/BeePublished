<?php
class GoogleMapHelper extends AppHelper {
	
	function initialize($home, $panel) {	
		echo "
			<script type=\"text/javascript\" src=\"http://maps.googleapis.com/maps/api/js?sensor=true&amp;language=de&amp;region=DE\"></script>
					
		    <script>		     
		      var myOptions = {
		          zoom: 15,
		          mapTypeId: google.maps.MapTypeId.ROADMAP,
		      };
		      
		      var map = new google.maps.Map(document.getElementById(\"".$panel."\"), myOptions);
		      
			  var geocoder = new google.maps.Geocoder();
			  var position;
		     
		      geocoder.geocode( { 'address': \"".$home."\"}, function(results, status) {
			        if (status == google.maps.GeocoderStatus.OK) {
			          map.setCenter(results[0].geometry.location);
			          var marker = new google.maps.Marker({
			              map: map, 
			              position: results[0].geometry.location
			          });
			        } else {
          				alert(\"Geocode was not successful for the following reason: \" + status);
        			}
			  });
		      
		    </script>
		";
	}
	
	function printRoute($start, $destination, $panel) {
		echo "
			<script>
				var directionsDisplay = new google.maps.DirectionsRenderer();
	      		var directionsService = new google.maps.DirectionsService();
	      		
		        var request = {
		          origin: \".$start.\",
		          destination: \".$destination.\",
		          travelMode: google.maps.DirectionsTravelMode.DRIVING,
		        };
		        
		        directionsDisplay.setMap(map);
	        	directionsDisplay.setPanel(document.getElementById(\"".$panel."\"));
		        
		        directionsService.route(request, function(response, status) {
		          if (status == google.maps.DirectionsStatus.OK) {
		            directionsDisplay.setDirections(response);
		          }
		        });
		        
		    </script>
		";
	}
}