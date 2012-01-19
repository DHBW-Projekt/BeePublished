<h2>
	<?php echo __('Bitte geben Sie die Umsatzsteuer-ID und, falls vorhanden, die Wirtschafts-ID Ihres Unternehmens ein.') ?>
</h2>
<br>
	<?php
	echo $this->Form->create('Impressum',array('url' => array('plugin'     => 'Impressum',
														   	  'controller' => 'Show',
															  'action'	   => 'compLegal'))); 
	
	echo $this->Form->label('Impressum.vat_no', __('Umsatzsteuer-ID:'));
	if (!empty($input['Impressum']['vat_no'])) {
		echo $this->Form->input('Impressum.vat_no', array('label' => false, 'value' => $input['Impressum']['vat_no']));
	} else {
		echo $this->Form->input('Impressum.vat_no', array('label' => false));
	}
	
	echo $this->Form->label('Impressum.eco_no', __('Wirtschafts-ID:'));
	if (!empty($input['Impressum']['eco_no'])) {
		echo $this->Form->input('Impressum.eco_no', array('label' => false, 'value' => $input['Impressum']['eco_no']));
	} else {
		echo $this->Form->input('Impressum.eco_no', array('label' => false));
	}
?>
<br>
<?php echo $this->Form->end(__('weiter')); ?>