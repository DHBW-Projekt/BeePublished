<h2>
	<?php echo __('Bitte geben Sie die Daten Ihres Unternehmens ein.') ?>
</h2>
<br>
<?php
	echo $this->Form->create('Impressum',array('url' => array('plugin'     => 'Impressum',
														   	  'controller' => 'Show',
															  'action'	   => 'generalData')));
	
	echo $this->Form->label('Impressum.comp_name', __('Firma:'));
	if (!empty($input['Impressum']['comp_name'])) {
		echo $this->Form->input('Impressum.comp_name', array('label' => false, 'value' => $input['Impressum']['comp_name']));
	} else {
		echo $this->Form->input('Impressum.comp_name', array('label' => false));
	}
	
	echo $this->Form->label('Impressum.legal_form', __('Rechtsform:'));
	if (!empty($input['Impressum']['legal_form'])) {
		echo $this->Form->input('Impressum.legal_form', array('label' => false, 'value' => $input['Impressum']['legal_form']));
	} else {
		echo $this->Form->input('Impressum.legal_form', array('label' => false));
	}
	
	echo $this->Form->label('Impressum.street', __('Straße:'));
	if (!empty($input['Impressum']['street'])) {
		echo $this->Form->input('Impressum.street', array('label' => false, 'value' => $input['Impressum']['street']));
	} else {
		echo $this->Form->input('Impressum.street', array('label' => false));
	}
	
	echo $this->Form->label('Impressum.house_no', __('Hausnummer:'));
	if (!empty($input['Impressum']['house_no'])) {
		echo $this->Form->input('Impressum.house_no', array('label' => false, 'value' => $input['Impressum']['house_no']));
	} else {
		echo $this->Form->input('Impressum.house_no', array('label' => false));
	}
	
	echo $this->Form->label('Impressum.post_code', __('Postleitzahl:'));
	if (!empty($input['Impressum']['post_code'])) {
		echo $this->Form->input('Impressum.post_code', array('label' => false, 'value' => $input['Impressum']['post_code']));
	} else {
		echo $this->Form->input('Impressum.post_code', array('label' => false));
	}
	
	echo $this->Form->label('Impressum.city', __('Ort:'));
	if (!empty($input['Impressum']['city'])) {
		echo $this->Form->input('Impressum.city', array('label' => false, 'value' => $input['Impressum']['city']));
	} else {
		echo $this->Form->input('Impressum.city', array('label' => false));
	}
	
	echo $this->Form->label('Impressum.country', __('Land:'));
	if (!empty($input['Impressum']['country'])) {
		echo $this->Form->input('Impressum.country', array('label' => false, 'value' => $input['Impressum']['country']));
	} else {
		echo $this->Form->input('Impressum.country', array('label' => false));
	}
?>
<br>
<?php echo $this->Form->end(__('weiter')); ?>