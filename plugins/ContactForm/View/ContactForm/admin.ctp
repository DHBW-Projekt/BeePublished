<?php
	//LOAD css-file
	echo $this->Html->css('/ContactForm/css/contact_form');
	//$this->Form->create('admin', array('controller' => 'ContactForm', 'action' => 'admin', $contentID));
?>

<div id="contact_form_admin">
	<h2><?php echo __('Configuration') ?></h2><br />
	<p><?php echo __('There are no configuration options available. To change the recipient of contact requests, please set a new e-mail address in your general configuration.')?></p>
	<div style="clear:both;"></div>
</div>