<h2>
	<?php echo __('Bitte geben Sie, falls vorhanden, die Umsatzsteuer-ID Ihrer Körperschaft ein.') ?>
</h2>
<br>
	<?php
	echo $this->Form->create('Impressum',array('url' => array('plugin'     => 'Impressum',
														   	  'controller' => 'Show',
															  'action'	   => 'publicLegal'))); 
	
	if (!empty($input['Impressum']['vat_no'])) {
		echo $this->Form->input('Impressum.vat_no', array('label' => __('Umsatzsteuer-ID:'), 'value' => $input['Impressum']['vat_no']));
	} else {
		echo $this->Form->input('Impressum.vat_no', array('label' => __('Umsatzsteuer-ID:')));
	}
?>
<br>
<?php echo $this->Form->end(__('weiter')); ?>