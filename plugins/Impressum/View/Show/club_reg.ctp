<h2>
	<?php echo __('Bitte geben Sie die Daten zu dem Registereintrag Ihres Vereins ein.') ?>
</h2>
<br>
<?php
	echo $this->Form->create('Impressum',array('url' => array('plugin'     => 'Impressum',
														   	  'controller' => 'Show',
															  'action'	   => 'regData')));
	
	echo $this->Form->label('Impressum.reg_name', __('Name des Registers:'));
	if (!empty($input['Impressum']['reg_name'])) {
		echo $this->Form->input('Impressum.reg_name', array('label' => false, 'value' => $input['Impressum']['reg_name']));
	} else {
		echo $this->Form->input('Impressum.reg_name', array('label' => false, 'value' => __('Vereinsregister')));
	}
	
	echo $this->Form->label('Impressum.reg_street', __('Straße:'));
	if (!empty($input['Impressum']['reg_street'])) {
		echo $this->Form->input('Impressum.reg_street', array('label' => false, 'value' => $input['Impressum']['reg_street']));
	} else {
		echo $this->Form->input('Impressum.reg_street', array('label' => false));
	}
	
	echo $this->Form->label('Impressum.reg_house_no', __('Hausnummer:'));
	if (!empty($input['Impressum']['reg_house_no'])) {
		echo $this->Form->input('Impressum.reg_house_no', array('label' => false, 'value' => $input['Impressum']['reg_house_no']));
	} else {
		echo $this->Form->input('Impressum.reg_house_no', array('label' => false));
	}
	
	echo $this->Form->label('Impressum.reg_post_code', __('Postleitzahl:'));
	if (!empty($input['Impressum']['reg_post_code'])) {
		echo $this->Form->input('Impressum.reg_post_code', array('label' => false, 'value' => $input['Impressum']['reg_post_code']));
	} else {
		echo $this->Form->input('Impressum.reg_post_code', array('label' => false));
	}
	
	echo $this->Form->label('Impressum.reg_city', __('Ort:'));
	if (!empty($input['Impressum']['reg_city'])) {
		echo $this->Form->input('Impressum.reg_city', array('label' => false, 'value' => $input['Impressum']['reg_city']));
	} else {
		echo $this->Form->input('Impressum.reg_city', array('label' => false));
	}
	
	echo $this->Form->label('Impressum.reg_country', __('Land:'));
	if (!empty($input['Impressum']['reg_country'])) {
		echo $this->Form->input('Impressum.reg_country', array('label' => false, 'value' => $input['Impressum']['reg_country']));
	} else {
		echo $this->Form->input('Impressum.reg_country', array('label' => false));
	}
	
	echo $this->Form->label('Impressum.reg_no', __('Registernummer:'));
	if (!empty($input['Impressum']['reg_no'])) {
		echo $this->Form->input('Impressum.reg_no', array('label' => false, 'value' => $input['Impressum']['reg_no']));
	} else {
		echo $this->Form->input('Impressum.reg_no', array('label' => false));
	} 
?>
<br>
<?php echo $this->Form->end(__('Impressum erstellen')); ?>