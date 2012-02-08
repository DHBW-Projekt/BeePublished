<?php
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
* @description Google Maps location view
*/

	//load scripts
	$this->Html->script('http://maps.googleapis.com/maps/api/js?sensor=true&amp;language=de&amp;region=DE', false);
	$this->Html->script('/google_maps/js/googlemaps', false);
	
	//if location is set show it on map
	if ($data <> __('no location')) {
		$location = 'showLocation(\'map\', \'' . implode(",", $data['GoogleMapsLocation']) . '\');';
	} else {
		$location = '';
	}
	
	//init map and show location
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

