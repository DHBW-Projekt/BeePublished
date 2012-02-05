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
* @description Google Maps route view
*/
	//load scripts
	$this->Html->script('http://maps.googleapis.com/maps/api/js?sensor=true&amp;language=de&amp;region=DE', false);
	$this->Html->script('/google_maps/js/googlemaps', false);
	
	//show route if location and destination is set
	if ($data <> __('no location') and isset($this->data['location']['address'])) {
		$route = 'printRoute(\'routing\', \'' . $this->data['location']['address'] . '\',\'' . implode(",", $data['GoogleMapsLocation']) . '\');';
	} else {
		$route = '';
	}
	
	//show route and map
	if (isset($this->data['location']) && isset($data['GoogleMapsLocation'])) {
	    $this->Html->scriptBlock('
	            $(document).ready(function () {
	                initializeGoogleMaps(\'map\');'.
	    			$route.'
	            });
	            ', array('inline' => false)
	    );
	}
?>

<div id="directions">
    <?php
	    echo $this->Form->create('location', array('url' => $url));
	    echo $this->Form->input('address', array('label' => (__d("google_maps", 'Location').':'), 'style' => "width:100%"));
	    echo $this->Form->end(__d("google_maps", "Calculate Route"));
    ?>
    <div id="routing"></div>
</div>