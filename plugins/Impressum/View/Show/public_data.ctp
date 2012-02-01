<h2>
	<?php echo __('Bitte geben Sie die Daten Ihrer Körperschaft ein.') ?>
</h2>
<br>
<?php
	echo $this->Form->create('Impressum',array('url' => array('plugin'     => 'Impressum',
														   	  'controller' => 'Show',
															  'action'	   => 'generalData')));
	
	if (!empty($input['Impressum']['legal_form'])) {
		echo $this->Form->input('Impressum.legal_form', array('label' => __('Form:'), 'value' => $input['Impressum']['legal_form']));
	} else {
		echo $this->Form->input('Impressum.legal_form', array('label' => __('Form:')));
	}
	
	if (!empty($input['Impressum']['comp_name'])) {
		echo $this->Form->input('Impressum.comp_name', array('label' => __('Bezeichnung:'), 'value' => $input['Impressum']['comp_name']));
	} else {
		echo $this->Form->input('Impressum.comp_name', array('label' => __('Bezeichnung:')));
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