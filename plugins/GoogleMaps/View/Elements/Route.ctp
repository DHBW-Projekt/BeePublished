<?php
$this->Html->script('http://maps.googleapis.com/maps/api/js?sensor=true&amp;language=de&amp;region=DE', false);
$this->Html->script('/google_maps/js/googlemaps', false);
if (isset($this->data['Ziel']) && isset($data['GoogleMapsLocation'])) {
    $this->Html->scriptBlock('
            $(document).ready(function () {
                initializeGoogleMaps(\'map\');
                printRoute(\'routing\', \'' . implode(",", $data['GoogleMapsLocation']) . '\',\'' . $this->data['Ziel']['Adresse'] . '\');
            });
            ', array('inline' => false)
    );
}
?>
<div id="directions">
    <?php
    echo $this->Form->create('Ziel');
    echo $this->Form->input('Adresse');
    echo $this->Form->end('Route Berechnen');
    ?>

    <div id="routing"></div>
</div>