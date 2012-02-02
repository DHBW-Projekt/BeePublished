<?php

	$this->Html->script('http://maps.googleapis.com/maps/api/js?sensor=true&amp;language=de&amp;region=DE', false);
	$this->Html->script('/google_maps/js/googlemaps', false);

	if ($data <> __('no location')) {
		$location = 'showLocation(\'map\', \'' . implode(",", $data['GoogleMapsLocation']) . '\');';
	} else {
		$location = '';
	}

	$this->Html->scriptBlock('
	        $(document).ready(function () {
	        	
	        	if (lock==undefined) { 
	        		//window.location.reload();
	        	} else {
		            initializeGoogleMaps(\'map\');
		            '.$location.'
		        }
	        });
	        ', array('inline' => false)
	);
?>

<div id="map" style="width:100%; height:200px"></div>

