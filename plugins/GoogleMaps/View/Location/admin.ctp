<h1>Set Location</h1>
<?php
    echo $this->Form->create('GoogleMapsLocation');
    echo $this->Form->input('street');
    echo $this->Form->input('street_number');
    echo $this->Form->input('zip_code');
    echo $this->Form->input('city');
    echo $this->Form->input('country');
    echo $this->Form->end('Set Location');
?>