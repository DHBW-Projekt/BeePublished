<?php
$this->Html->script('http://maps.googleapis.com/maps/api/js?sensor=true&amp;language=de&amp;region=DE', false);
$this->Html->script('/google_maps/js/googlemaps', false);

if ($data <> __('no location') and isset($this->data['Ort']['Adresse'])) {
	$route = 'printRoute(\'routing\', \'' . $this->data['Ort']['Adresse'] . '\',\'' . implode(",", $data['GoogleMapsLocation']) . '\');';
} else {
	$route = '';
}

if (isset($this->data['Ort']) && isset($data['GoogleMapsLocation'])) {
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
    echo $this->Form->create('Ort');
    echo $this->Form->input('Adresse');
    echo $this->Form->end('Route Berechnen');
    ?>

    <div id="routing"></div>
</div>