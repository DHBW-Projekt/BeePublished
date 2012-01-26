<h2>
	<?php echo __('Bitte geben Sie, falls vorhanden, die Umsatzsteuer-ID Ihrer Körperschaft ein.') ?>
</h2>
<br>
	<?php
	echo $this->Form->create('Impressum',array('url' => array('plugin'     => 'Impressum',
														   	  'controller' => 'Show',
															  'action'	   => 'publicLegal'))); 
	
	echo $this->Form->label('Impressum.vat_no', __('Umsatzsteuer-ID:'));
	if (!empty($input['Impressum']['vat_no'])) {
		echo $this->Form->input('Impressum.vat_no', array('label' => false, 'value' => $input['Impressum']['vat_no']));
	} else {
		echo $this->Form->input('Impressum.vat_no', array('label' => false));
	}
?>
<br>
<?php echo $this->Form->end(__('weiter')); ?>