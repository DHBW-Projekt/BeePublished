<div id="directions">
		    <?php
			    echo $this->Form->create('Ziel');
			    echo $this->Form->input('Adresse');
			    echo $this->Form->end('Route Berechnen');
		    ?>
	    
		<div id="rounting"></div>
</div>

<?php
	$googleMaps = $this->Helpers->load('GoogleMaps.GoogleMap');
	if (isset($this->data['Ziel']) && isset($data['GoogleMapsLocation'])) {
		$googleMaps->printRoute(implode(",", $data['GoogleMapsLocation']), $this->data['Ziel']['Adresse'], "rounting");
	}
?>
