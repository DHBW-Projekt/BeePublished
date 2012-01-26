<h2>
	<?php echo __('Bitte geben Sie Ihre Kontaktdaten ein.') ?>
</h2>
<br>
<?php
	echo $this->Form->create('Impressum',array('url' => array('plugin'     => 'Impressum',
														   	  'controller' => 'Show',
															  'action'	   => 'privJobContact'))); 
	
	echo $this->Form->label('Impressum.phone_no', __('Telefonnummer:'));
	if (!empty($input['Impressum']['phone_no'])) {
		echo $this->Form->input('Impressum.phone_no', array('label' => false, 'value' => $input['Impressum']['phone_no']));
	} else {
		echo $this->Form->input('Impressum.phone_no', array('label' => false));
	}
	
	echo $this->Form->label('Impressum.fax_no', __('Faxnummer:'));
	if (!empty($input['Impressum']['fax_no'])) {
		echo $this->Form->input('Impressum.fax_no', array('label' => false, 'value' => $input['Impressum']['fax_no']));
	} else {
		echo $this->Form->input('Impressum.fax_no', array('label' => false));
	}
	
	echo $this->Form->label('Impressum.email', __('E-Mail-Adresse:'));
	if (!empty($input['Impressum']['email'])) {
		echo $this->Form->input('Impressum.email', array('label' => false, 'error' => __('Das ist keine gültige E-Mail-Adresse') ,'value' => $input['Impressum']['email']));
	} else {
		echo $this->Form->input('Impressum.email', array('label' => false, 'error' => __('Das ist keine gültige E-Mail-Adresse')));
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