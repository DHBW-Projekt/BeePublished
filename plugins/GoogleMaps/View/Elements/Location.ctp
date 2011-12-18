<?php
$this->Html->script('http://maps.googleapis.com/maps/api/js?sensor=true&amp;language=de&amp;region=DE', false);
$this->Html->script('/google_maps/js/googlemaps', false);
$this->Html->scriptBlock('
        $(document).ready(function () {
            initializeGoogleMaps(\'map\');
            //showLocation(\'map\', \'' . implode(",", $data['GoogleMapsLocation']) . '\');
        });
        ', array('inline' => false)
);
?>

<div id="map" style="width:100%; height:200px"></div>

