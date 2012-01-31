<h2>
	<?php echo __('Bitte geben Sie die Daten zu dem Registereintrag Ihres Vereins ein.') ?>
</h2>
<br>
<?php
	echo $this->Form->create('Impressum',array('url' => array('plugin'     => 'Impressum',
														   	  'controller' => 'Show',
															  'action'	   => 'regData')));
	
	if (!empty($input['Impressum']['reg_name'])) {
		echo $this->Form->input('Impressum.reg_name', array('label' => __('Name des Registers:'), 'value' => $input['Impressum']['reg_name']));
	} else {
		echo $this->Form->input('Impressum.reg_name', array('label' => __('Name des Registers:'), 'value' => __('Vereinsregister')));
	}
	
	if (!empty($input['Impressum']['reg_street'])) {
		echo $this->Form->input('Impressum.reg_street', array('label' => __('Straße:'), 'value' => $input['Impressum']['reg_street']));
	} else {
		echo $this->Form->input('Impressum.reg_street', array('label' => __('Straße:')));
	}
	
	if (!empty($input['Impressum']['reg_house_no'])) {
		echo $this->Form->input('Impressum.reg_house_no', array('label' => __('Hausnummer:'), 'value' => $input['Impressum']['reg_house_no']));
	} else {
		echo $this->Form->input('Impressum.reg_house_no', array('label' => __('Hausnummer:')));
	}
	
	if (!empty($input['Impressum']['reg_post_code'])) {
		echo $this->Form->input('Impressum.reg_post_code', array('label' => __('Postleitzahl:'), 'value' => $input['Impressum']['reg_post_code']));
	} else {
		echo $this->Form->input('Impressum.reg_post_code', array('label' => __('Postleitzahl:')));
	}
	
	if (!empty($input['Impressum']['reg_city'])) {
		echo $this->Form->input('Impressum.reg_city', array('label' => __('Ort:'), 'value' => $input['Impressum']['reg_city']));
	} else {
		echo $this->Form->input('Impressum.reg_city', array('label' => __('Ort:')));
	}
	
	if (!empty($input['Impressum']['reg_country'])) {
		echo $this->Form->input('Impressum.reg_country', array('label' => __('Land:'), 'value' => $input['Impressum']['reg_country']));
	} else {
		echo $this->Form->input('Impressum.reg_country', array('label' => __('Land:')));
	}
	
	if (!empty($input['Impressum']['reg_no'])) {
		echo $this->Form->input('Impressum.reg_no', array('label' => __('Registernummer:'), 'value' => $input['Impressum']['reg_no']));
	} else {
		echo $this->Form->input('Impressum.reg_no', array('label' => __('Registernummer:')));
	} 
?>
<br>
<?php echo $this->Form->end(__('Impressum erstellen')); ?>