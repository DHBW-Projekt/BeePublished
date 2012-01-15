<?php 
	$this->Helpers->load('Form','Recaptcha');
?>

<div id='contactform'>
	<div class = 'MailAddress'><!-- Diesen Teil sollte später nur der Admin sehen -->
		<b>E-mail address for contact</b></br>
		<p>Please enter a valid e-mail address to which contact requests will be sent:</p>
		<?php
			echo $this->Form->create('MailAddress', array('action' => 'save', 'controller' => 'MailAddress', 'Model' => 'MailAddress'));
			echo $this->Form->input('mailaddress', array('default'=>$mailaddress['MailAddress']['mailaddress'],'label'=>'')); //default-Wert soll Wert aus DB anzeigen, aber Zugriff auf Modelvariable $mailaddress geht so nicht
			echo $this->Form->end('Save')
		?>
	</div>
	</br>
	<div class = 'ContactForm'>
		<b>Contact Form</b></br>
		<?php 
			echo $this->Form->create('ContactForm', array('action' => 'sendform', 'controller' => 'ContactForm'));
		?>
			<table>
				<tr>
					<td><?php echo $this->Form->label('lastname', __('Last Name: '));?></td>
					<td><?php echo $this->Form->input('lastname', array('label' => ''));?></td>
				</tr>
				<tr>
					<td><?php echo $this->Form->label('firstname', __('First Name: '));?></td>
					<td><?php echo $this->Form->input('firstname', array('label' => ''));?></td>
				</tr>
				<tr>
					<td><?php echo $this->Form->label('email', __('E-Mail*: '));?></td>
					<td><?php echo $this->Form->input('email', array('label' => ''));?></td>
				</tr>
				<tr>
					<td><?php echo $this->Form->label('subject', __('Subject*: '));?></td>
					<td><?php echo $this->Form->input('subject', array('label' => ''));?></td>
				</tr>
				<tr>
					<td><?php echo $this->Form->label('body', __('Message*: '));?></td>
					<td><?php echo $this->Form->input('body', array('label' => '', 'rows' => '4'));?></td>
				</tr>
				<tr>
					<td></td>
					<td><?php //echo $this->Recaptcha->display_form(); ?></td> <!-- Recaptcha anzeigen funktioniert nicht -> warum?! -->
				</tr>
				<tr width="100%">
					<td align="left"><?php echo $this->Form->end('Send');?></td><td align = "right">* - Mandatory Field</td>
				</tr>
			</table>
	</div>
</div>