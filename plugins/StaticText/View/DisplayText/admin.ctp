<h1>Set Text</h1>
<?php
	//embedding the needed scripts
	echo $this->Html->script('ckeditor/ckeditor', false);
	echo $this->Html->script('ckeditor/adapters/jquery', false);
?>
<div class="texteditor">
<?php 
	echo $this->Form->create('null');
	echo $this->Form->textarea('Text');
?>
<?php
	//options for the radiobuttons
	$options =  array(
		// Not text
		'label' 	=> false,
		'type' 		=> 'radio',
		// no legend
		'legend' 	=> false,
		// Values for the radiobuttons
		'options'	=> array(1 => ' published ', 0 => ' unpublished ')
	);
	echo $this->Form->input('Published', $options);?>
</div>
<?php 
	echo $this->Form->end('Save');
	echo $this->Html->script('/static_text/js/editText', false);
?>
