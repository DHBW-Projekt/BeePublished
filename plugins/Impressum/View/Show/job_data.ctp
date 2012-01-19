<h2>
<?php
$this->Html->script('/impressum/js/impressum', false);
echo __('Bitte geben Sie alle Daten in Bezug auf Ihren geschützten Beruf an.') ?>
</h2>
<br>
<?php
echo $this->Form->create('Impressum',array('url' => array('plugin'     => 'Impressum',
													   	  'controller' => 'Show',
														  'action'	   => 'jobData'))); 
echo $this->Form->label('Impressum.job_title', __('Berufsbezeichnung:'));
if (!empty($data['Impressum']['job_title'])) {
	echo $this->Form->input('Impressum.job_title', array('label' => false, 'value' => $data['Impressum']['job_title']));
} else {
	echo $this->Form->input('Impressum.job_title', array('label' => false));
}
echo $this->Form->label('Impressum.regulations_name', __('Berufsrechtliche Regelungen:'));
if (!empty($data['Impressum']['regulations_name'])) {
	echo $this->Form->input('Impressum.regulations_name', array('label' => false, 'value' => $data['Impressum']['regulations_name']));
} else {
	echo $this->Form->input('Impressum.regulations_name', array('label' => false));
}
echo $this->Form->label('Impressum.regulations_link', __('Link zu den berufsrechtlichen Regelungen:'));
if (!empty($data['Impressum']['regulations_link'])) {
	echo $this->Form->input('Impressum.regulations_link', array('label' => false, 'value' => $data['Impressum']['regulations_link']));
} else {
	echo $this->Form->input('Impressum.regulations_link', array('label' => false));
}
echo $this->Form->label('Impressum.adm_office_name', __('Name der Berufskammer:'));
if (!empty($data['Impressum']['adm_office_name'])) {
	echo $this->Form->input('Impressum.adm_office_name', array('label' => false, 'value' => $data['Impressum']['adm_office_name']));
} else {
	echo $this->Form->input('Impressum.adm_office_name', array('label' => false));
}
echo $this->Form->label('Impressum.adm_office_street', __('Straße:  '));
if (!empty($data['Impressum']['adm_office_street'])) {
	echo $this->Form->input('Impressum.adm_office_street', array('label' => false, 'value' => $data['Impressum']['adm_office_street']));
} else {
	echo $this->Form->input('Impressum.adm_office_street', array('label' => false));
}
echo $this->Form->label('Impressum.adm_office_house_no', __('Hausnummer:  '));
if (!empty($data['Impressum']['reg_house_no'])) {
	echo $this->Form->input('Impressum.adm_office_house_no', array('label' => false, 'value' => $data['Impressum']['adm_office_house_no']));
} else {
	echo $this->Form->input('Impressum.adm_office_house_no', array('label' => false));
}
echo $this->Form->label('Impressum.adm_office_post_code', __('Postleitzahl:  '));
if (!empty($data['Impressum']['adm_office_post_code'])) {
	echo $this->Form->input('Impressum.adm_office_post_code', array('label' => false, 'value' => $data['Impressum']['adm_office_post_code']));
} else {
	echo $this->Form->input('Impressum.adm_office_post_code', array('label' => false));
}
echo $this->Form->label('Impressum.adm_office_city', __('Ort:  '));
if (!empty($data['Impressum']['adm_office_city'])) {
	echo $this->Form->input('Impressum.adm_office_city', array('label' => false, 'value' => $data['Impressum']['adm_office_city']));
} else {
	echo $this->Form->input('Impressum.adm_office_city', array('label' => false));
}
echo $this->Form->label('Impressum.adm_office_country', __('Land der Verleihung:  '));
if (!empty($data['Impressum']['adm_office_country'])) {
	echo $this->Form->input('Impressum.adm_office_country', array('label' => false, 'value' => $data['Impressum']['adm_office_country']));
} else {
	echo $this->Form->input('Impressum.adm_office_country', array('label' => false));
} ?>
<br>
<?php echo $this->Form->end(__('Impressum erstellen')); ?>