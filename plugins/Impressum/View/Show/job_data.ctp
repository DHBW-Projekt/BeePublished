<h2>
	<?php
		$this->Html->script('/impressum/js/impressum', false);
		echo __('Bitte geben Sie alle Daten in Bezug auf Ihren geschützten Beruf an.');
	?>	
</h2>
<br>
<?php
	echo $this->Form->create('Impressum',array('url' => array('plugin'     => 'Impressum',
														   	  'controller' => 'Show',
															  'action'	   => 'jobData'))); 
	
	if (!empty($data['Impressum']['job_title'])) {
		echo $this->Form->input('Impressum.job_title', array('label' => __('Berufsbezeichnung:'), 'value' => $data['Impressum']['job_title']));
	} else {
		echo $this->Form->input('Impressum.job_title', array('label' => __('Berufsbezeichnung:')));
	}
	
	if (!empty($data['Impressum']['regulations_name'])) {
		echo $this->Form->input('Impressum.regulations_name', array('label' => __('Berufsrechtliche Regelungen:'), 'value' => $data['Impressum']['regulations_name']));
	} else {
		echo $this->Form->input('Impressum.regulations_name', array('label' => __('Berufsrechtliche Regelungen:')));
	}
	
	if (!empty($data['Impressum']['regulations_link'])) {
		echo $this->Form->input('Impressum.regulations_link', array('label' => __('Link zu den berufsrechtlichen Regelungen:'), 'value' => $data['Impressum']['regulations_link']));
	} else {
		echo $this->Form->input('Impressum.regulations_link', array('label' => __('Link zu den berufsrechtlichen Regelungen:')));
	}
	
	if (!empty($data['Impressum']['adm_office_name'])) {
		echo $this->Form->input('Impressum.adm_office_name', array('label' => __('Name der Berufskammer:'), 'value' => $data['Impressum']['adm_office_name']));
	} else {
		echo $this->Form->input('Impressum.adm_office_name', array('label' => __('Name der Berufskammer:')));
	}
	
	if (!empty($data['Impressum']['adm_office_street'])) {
		echo $this->Form->input('Impressum.adm_office_street', array('label' => __('Straße:  '), 'value' => $data['Impressum']['adm_office_street']));
	} else {
		echo $this->Form->input('Impressum.adm_office_street', array('label' => __('Straße:  ')));
	}
	
	if (!empty($data['Impressum']['reg_house_no'])) {
		echo $this->Form->input('Impressum.adm_office_house_no', array('label' => __('Hausnummer:  '), 'value' => $data['Impressum']['adm_office_house_no']));
	} else {
		echo $this->Form->input('Impressum.adm_office_house_no', array('label' => __('Hausnummer:  ')));
	}
	
	if (!empty($data['Impressum']['adm_office_post_code'])) {
		echo $this->Form->input('Impressum.adm_office_post_code', array('label' => __('Postleitzahl:  '), 'value' => $data['Impressum']['adm_office_post_code']));
	} else {
		echo $this->Form->input('Impressum.adm_office_post_code', array('label' => __('Postleitzahl:  ')));
	}
	
	if (!empty($data['Impressum']['adm_office_city'])) {
		echo $this->Form->input('Impressum.adm_office_city', array('label' => __('Ort:  '), 'value' => $data['Impressum']['adm_office_city']));
	} else {
		echo $this->Form->input('Impressum.adm_office_city', array('label' => __('Ort:  ')));
	}
	
	if (!empty($data['Impressum']['adm_office_country'])) {
		echo $this->Form->input('Impressum.adm_office_country', array('label' => __('Land der Verleihung:  '), 'value' => $data['Impressum']['adm_office_country']));
	} else {
		echo $this->Form->input('Impressum.adm_office_country', array('label' => __('Land der Verleihung:  ')));
	} 
?>
<br>
<?php echo $this->Form->end(__('Impressum erstellen')); ?>