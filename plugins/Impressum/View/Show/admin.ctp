<h2>
	<?php echo __('Bitte wählen Sie einen Eintrag aus.'); ?>
</h2>
<br>
<?php
	echo $this->Form->create('Impressum',array('url' => array('plugin' => 'Impressum',
															  'controller' => 'Show',
		 													  'action' => 'admin')));
	$options = array('priv' => __('Privatperson'),
					 'comp' => __('Unternehmen'),
					 'club' => __('eingetragener Verein'),
					 'job' => __('Freiberufler'),
					 'public' => __('Körperschaft des öffentlichen Rechts'));
	if (empty($input['Impressum']['type'])) {
		$attributes = array('legend' => false, 'value' => 'priv');
	} else {
		$attributes = array('legend' => false, 'value' => $input['Impressum']['type']);
	}
	echo $this->Form->radio('type', $options, $attributes); 
?>
<br>
<?php echo $this->Form->end(__('weiter')); ?>