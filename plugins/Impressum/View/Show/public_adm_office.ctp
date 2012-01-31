<h2>
	<?php
		$this->Html->script('/impressum/js/impressum', false);
		echo __('Bitte geben Sie die Daten der zuständigen Aufsichtsbehörde an.');
	?>
</h2>
<br>
<?php
	echo $this->Form->create('Impressum',array('url' => array('plugin'     => 'Impressum',
														   	  'controller' => 'Show',
															  'action'	   => 'admOffice'))); 
?>
<br>
<?php
	if (!empty($input['Impressum']['adm_office_name'])) {
		echo $this->Form->input('Impressum.adm_office_name', array('label' => __('Name der Behörde:'), 'value' => $input['Impressum']['adm_office_name']));
	} else {
		echo $this->Form->input('Impressum.adm_office_name', array('label' => __('Name der Behörde:')));
	}
	
	if (!empty($input['Impressum']['adm_office_street'])) {
		echo $this->Form->input('Impressum.adm_office_street', array('label' => __('Straße:'), 'value' => $input['Impressum']['adm_office_street']));
	} else {
		echo $this->Form->input('Impressum.adm_office_street', array('label' => __('Straße:')));
	}
	
	if (!empty($input['Impressum']['adm_office_house_no'])) {
		echo $this->Form->input('Impressum.adm_office_house_no', array('label' => __('Hausnummer:'), 'value' => $input['Impressum']['adm_office_house_no']));
	} else {
		echo $this->Form->input('Impressum.adm_office_house_no', array('label' => __('Hausnummer:')));
	}
	
	if (!empty($input['Impressum']['adm_office_post_code'])) {
		echo $this->Form->input('Impressum.adm_office_post_code', array('label' => __('Postleitzahl:'), 'value' => $input['Impressum']['adm_office_post_code']));
	} else {
		echo $this->Form->input('Impressum.adm_office_post_code', array('label' => __('Postleitzahl:')));
	}
	
	if (!empty($input['Impressum']['adm_office_city'])) {
		echo $this->Form->input('Impressum.adm_office_city', array('label' => __('Ort:'), 'value' => $input['Impressum']['adm_office_city']));
	} else {
		echo $this->Form->input('Impressum.adm_office_city', array('label' => __('Ort:')));
	}
	
	if (!empty($input['Impressum']['adm_office_country'])) {
		echo $this->Form->input('Impressum.adm_office_country', array('label' => __('Land:'), 'value' => $input['Impressum']['adm_office_country']));
	} else {
		echo $this->Form->input('Impressum.adm_office_country', array('label' => __('Land:')));
	}
?>
<br>
<?php echo $this->Form->end(__('Impressum erstellen')); ?>