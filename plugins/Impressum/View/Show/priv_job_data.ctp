<h2>
	<?php echo __('Bitte geben Sie Ihre Daten ein.') ?>
</h2>
<br>
<?php
	echo $this->Form->create('Impressum',array('url' => array('plugin'     => 'Impressum',
														   	  'controller' => 'Show',
															  'action'	   => 'privJobData')));
	
	if (!empty($input['Impressum']['first_name'])) {
		echo $this->Form->input('Impressum.first_name', array('label' => __('Vorname:'), 'value' => $input['Impressum']['first_name']));
	} else {
		echo $this->Form->input('Impressum.first_name', array('label' => __('Vorname:')));
	}
	
	if (!empty($input['Impressum']['last_name'])) {
		echo $this->Form->input('Impressum.last_name', array('label' => __('Nachname:'), 'value' => $input['Impressum']['last_name']));
	} else {
		echo $this->Form->input('Impressum.last_name', array('label' => __('Nachname:')));
	}
	
	if (!empty($input['Impressum']['street'])) {
		echo $this->Form->input('Impressum.street', array('label' => __('Straße:'), 'value' => $input['Impressum']['street']));
	} else {
		echo $this->Form->input('Impressum.street', array('label' => __('Straße:')));
	}
	
	if (!empty($input['Impressum']['house_no'])) {
		echo $this->Form->input('Impressum.house_no', array('label' => __('Hausnummer:'), 'value' => $input['Impressum']['house_no']));
	} else {
		echo $this->Form->input('Impressum.house_no', array('label' => __('Hausnummer:')));
	}
	
	if (!empty($input['Impressum']['post_code'])) {
		echo $this->Form->input('Impressum.post_code', array('label' => __('Postleitzahl:'), 'value' => $input['Impressum']['post_code']));
	} else {
		echo $this->Form->input('Impressum.post_code', array('label' => __('Postleitzahl:')));
	}
	
	if (!empty($input['Impressum']['city'])) {
		echo $this->Form->input('Impressum.city', array('label' => __('Ort:'), 'value' => $input['Impressum']['city']));
	} else {
		echo $this->Form->input('Impressum.city', array('label' => __('Ort:')));
	}
	
	if (!empty($input['Impressum']['country'])) {
		echo $this->Form->input('Impressum.country', array('label' => __('Land:'), 'value' => $input['Impressum']['country']));
	} else {
		echo $this->Form->input('Impressum.country', array('label' => __('Land:')));
	}
?>
<br>
<?php echo $this->Form->end(__('weiter')); ?>