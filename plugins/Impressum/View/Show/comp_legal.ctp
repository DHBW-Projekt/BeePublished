<h2>
	<?php echo __('Bitte geben Sie die Umsatzsteuer-ID und, falls vorhanden, die Wirtschafts-ID Ihres Unternehmens ein.') ?>
</h2>
<br>
	<?php
	echo $this->Form->create('Impressum',array('url' => array('plugin'     => 'Impressum',
														   	  'controller' => 'Show',
															  'action'	   => 'compLegal'))); 
	
	if (!empty($input['Impressum']['vat_no'])) {
		echo $this->Form->input('Impressum.vat_no', array('label' => __('Umsatzsteuer-ID:'), 'value' => $input['Impressum']['vat_no']));
	} else {
		echo $this->Form->input('Impressum.vat_no', array('label' => __('Umsatzsteuer-ID:')));
	}
	
	if (!empty($input['Impressum']['eco_no'])) {
		echo $this->Form->input('Impressum.eco_no', array('label' => __('Wirtschafts-ID:'), 'value' => $input['Impressum']['eco_no']));
	} else {
		echo $this->Form->input('Impressum.eco_no', array('label' => __('Wirtschafts-ID:')));
	}
?>
<br>
<?php echo $this->Form->end(__('weiter')); ?>