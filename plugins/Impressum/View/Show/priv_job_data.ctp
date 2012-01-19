<h2>
<?php echo __('Bitte geben Sie Ihre Daten ein.') ?>
</h2>
<br>
<?php
echo $this->Form->create('Impressum',array('url' => array('plugin'     => 'Impressum',
													   	  'controller' => 'Show',
														  'action'	   => 'privJobData')));
echo $this->Form->label('Impressum.first_name', __('Vorname:'));
if (!empty($input['Impressum']['first_name'])) {
	echo $this->Form->input('Impressum.first_name', array('label' => false, 'value' => $input['Impressum']['first_name']));
} else {
	echo $this->Form->input('Impressum.first_name', array('label' => false));
}
echo $this->Form->label('Impressum.last_name', __('Nachname:'));
if (!empty($input['Impressum']['last_name'])) {
	echo $this->Form->input('Impressum.last_name', array('label' => false, 'value' => $input['Impressum']['last_name']));
} else {
	echo $this->Form->input('Impressum.last_name', array('label' => false));
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