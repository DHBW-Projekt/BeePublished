<h2>
	<?php echo __('Bitte geben Sie Ihre Kontaktdaten ein.') ?>
</h2>
<br>
<?php
	echo $this->Form->create('Impressum',array('url' => array('plugin'     => 'Impressum',
														   	  'controller' => 'Show',
															  'action'	   => 'privJobContact'))); 
	
	if (!empty($input['Impressum']['phone_no'])) {
		echo $this->Form->input('Impressum.phone_no', array('label' => __('Telefonnummer:'), 'value' => $input['Impressum']['phone_no']));
	} else {
		echo $this->Form->input('Impressum.phone_no', array('label' => __('Telefonnummer:')));
	}
	
	if (!empty($input['Impressum']['fax_no'])) {
		echo $this->Form->input('Impressum.fax_no', array('label' => __('Faxnummer:'), 'value' => $input['Impressum']['fax_no']));
	} else {
		echo $this->Form->input('Impressum.fax_no', array('label' => __('Faxnummer:')));
	}
	
	if (!empty($input['Impressum']['email'])) {
		echo $this->Form->input('Impressum.email', array('label' => __('E-Mail-Adresse:'), 'error' => __('Das ist keine gültige E-Mail-Adresse') ,'value' => $input['Impressum']['email']));
	} else {
		echo $this->Form->input('Impressum.email', array('label' => __('E-Mail-Adresse:'), 'error' => __('Das ist keine gültige E-Mail-Adresse')));
} ?>
<p>
	<?php echo __('Hinweis: Ihre E-Mail-Adresse wird so dargestellt, dass sie nicht von Spambots ausgelesen werden kann.')?>
</p>

<br>
<?php
	if ($input['Impressum']['type'] = 'job') {
		echo $this->Form->end(__('weiter'));
	} else {
		echo $this->Form->end(__('Impressum erstellen'));
	}
?>