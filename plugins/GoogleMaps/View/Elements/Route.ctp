<?php
	$this->Html->script('http://maps.googleapis.com/maps/api/js?sensor=true&amp;language=de&amp;region=DE', false);
	$this->Html->script('/google_maps/js/googlemaps', false);
	
	if ($data <> __('no location') and isset($this->data['location']['address'])) {
		$route = 'printRoute(\'routing\', \'' . $this->data['location']['address'] . '\',\'' . implode(",", $data['GoogleMapsLocation']) . '\');';
	} else {
		$route = '';
	}
	
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