<h2>
<?php echo __('Bitte wählen Sie einen Eintrag aus.'); ?>
</h2>
<br>

<?php
echo $this->Form->create('Impressum',array(
		'url' => array(
				'plugin' => 'Impressum',
		  		'controller' => 'Show',
		  		'action' => 'admin'
		  		)
		  		));
		  		?>
<p>
<?php
$options = array('priv' => __('Privatperson'),
				 'comp' => __('Unternehmen'),
				 'club' => __('eingetragener Verein'),
				 'job' => __('Freiberufler'));
if (empty($input['Impressum']['type'])) {
	$attributes = array('separator' => '</p><p>', 'legend' => false, 'value' => 'priv');
} else {
	$attributes = array('separator' => '</p><p>', 'legend' => false, 'value' => $input['Impressum']['type']);
}
echo $this->Form->radio('type', $options, $attributes); ?>
</p>
<br>
<?php echo $this->Form->end(__('weiter')); ?>