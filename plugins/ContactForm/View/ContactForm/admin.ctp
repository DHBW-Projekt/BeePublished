<?php
	//LOAD css-file
	$this->Html->css('/ContactForm/contactform');
?>



<p><?php echo __('There are no configuration options avaliable.')?></p>

<!-- 
<div class = 'MailAddress'>
	<h2>E-mail address for contact</h2>
	<p>Please enter a valid e-mail address to which contact requests will be sent:</p>
	<?php
		echo $this->Form->create('MailAddress', array('action' => 'save', 'controller' => 'MailAddress', 'Model' => 'MailAddress'));
		echo $this->Form->input('mailaddress', array('default'=>$mailaddress['MailAddress']['mailaddress'],'label'=>'')); //default-Wert soll Wert aus DB anzeigen, aber Zugriff auf Modelvariable $mailaddress geht so nicht
		echo $this->Form->end('Save')
	?>
</div> -->