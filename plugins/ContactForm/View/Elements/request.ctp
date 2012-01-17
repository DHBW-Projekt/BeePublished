<!-- contact form screen -->
<?php 
	//CAPTCHA
	App::import('Vendor','recaptcha/recaptchalib');
	$publickey = "6LfzYcwSAAAAAN3vRDzZKXkC0rYkwaKQTi8hMkj6";
?>

<div id='contactform_form'>
	<h2>Contact Form</h2>
	<?php 
		$validationError = $this->Session->read('Validation.ContactForm.validationErrors');
		echo $this->Session->flash('ContactForm');

		echo $this->Form->create('ContactForm', array('url' => $url.'/contactform/send'));
	?>
	<table>
		<tr>
			<td><?php echo $this->Form->label('name', __('Name*: '));?></td>
			<td><?php echo $this->Form->input('name', array('label' => ''));?></td>
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
			<td><?php echo recaptcha_get_html($publickey);?></td>
		</tr>
	</table>
	<?php echo $this->Form->end('Send');?>
	</div>
</div>