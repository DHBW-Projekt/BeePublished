<?php
	//LOAD menu
	echo $this->element('admin_menu', array('contentID' => $contentID));
?>

<h1>Edit Location</h1>

<?php 
	echo $this->Form->create('GoogleMapsLocation', array('url' => array('controller' => 'Location', 'action' => 'edit', $contentID, $locationID)));
	echo $this->Form->input('street');
	echo $this->Form->input('street_number');
	echo $this->Form->input('zip_code');
	echo $this->Form->input('city');
	echo $this->Form->input('country');
	echo $this->Form->submit(__('Save', true), array('name' => 'save', 'div' => false));
	echo $this->Form->submit(__('Cancel', true), array('name' => 'cancel', 'div' => false));
	echo $this->Form->end();
?>