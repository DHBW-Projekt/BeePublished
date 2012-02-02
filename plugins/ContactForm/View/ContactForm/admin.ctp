<?php
	//LOAD css-file
	echo $this->Html->css('/ContactForm/css/contact_form');
?>

<!-- SET content of admin overlay -->
<div id="contact_form_admin">
	<h2><?php echo __d('contact_form','Configuration') ?></h2><br />
	<div id="contact_form_admin_content"><?php echo __d('contact_form','There are no configuration options available. Contact requests are automatically sent to the e-mail address in your general configurations. To change the recipient of contact requests, please set a new e-mail address in your general configurations.')?></p>
	<div style="clear:both;"></div>
</div>