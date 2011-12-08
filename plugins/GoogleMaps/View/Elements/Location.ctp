<div id="map" style="width:100%; height:200px"></div>

<?php
	$googleMaps = $this->Helpers->load('GoogleMaps.GoogleMap');
	$googleMaps->initialize(implode(",", $data['GoogleMapsLocation']), "map");
?>
