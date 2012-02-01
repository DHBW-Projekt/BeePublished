<?php
	//LOAD menu
	echo $this->element('admin_menu', array('contentID' => $contentID));
?>

<h1>Create new location</h1>

<?php 
	echo $this->Form->create('GoogleMapsLocation', array('url' => array('controller' => 'Location', 'action' => 'create', $contentID)));
	echo $this->Form->input('street', array('label' => (__d("google_maps", 'Street').':')));
	echo $this->Form->input('street_number', array('label' => (__d("google_maps", 'Street Number').':')));
	echo $this->Form->input('zip_code', array('label' => (__d("google_maps", 'ZIP Code').':')));
	echo $this->Form->input('city', array('label' => (__d("google_maps", 'City').':')));
	echo $this->Form->input('country', array('label' => (__d("google_maps", 'Country').':')));
	echo $this->Form->submit(__d('web_shop', 'Save', true), array('name' => 'save', 'div' => false));
	echo $this->Form->submit(__d('web_shop', 'Cancel', true), array('name' => 'cancel', 'div' => false));
	echo $this->Form->end();
?>