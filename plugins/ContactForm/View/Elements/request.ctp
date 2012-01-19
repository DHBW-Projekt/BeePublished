<!-- contact form screen -->
<?php 
	//CAPTCHA
	App::import('Vendor','recaptcha/recaptchalib');
	$publickey = "6LfzYcwSAAAAAN3vRDzZKXkC0rYkwaKQTi8hMkj6";
	//echo $this->Html->css('/ContactForm/css/contactform');
?>

<form id = 'contactform_form'>
	<h2>Contact Form</h2>
		<?php 
			$validationError = $this->Session->read('Validation.ContactForm.validationErrors');
			echo $this->Session->flash('ContactForm');
	
			echo $this->Form->create('ContactForm', array('url' => $url.'/contactform/send'));
		?>
		<div id = 'contactform_div'>
		<table>
			<tr>
				<td><?php echo $this->Form->label('name', __('Name: '));?></td>
				<td><?php echo $this->Form->input('name', array('label' => '', 'type' => 'text', 'maxlength' => '30'));?></td>
			</tr>	
			<tr>
				<td><?php echo $this->Form->label('email', __('E-Mail*: '));?></td>
				<td><?php echo $this->Form->input('email', array('label' => '', 'maxlength' => '40'));?></td>
			</tr>
			<tr>
				<td><?php echo $this->Form->label('subject', __('Subject*: '));?></td>
				<td><?php echo $this->Form->input('subject', array('label' => ''));?></td>
			</tr>
			<tr>
				<td><?php echo $this->Form->label('body', __('Message*: '));?></td>
				<td><?php echo $this->Form->input('body', array('label' => '', 'rows' => '4', 'type' => 'text'));?></td>
			</tr>
			<tr>
				<td></td>
				<td>* - Mandatory field</td>
			</tr>
		</table><br>
		</div>
		
		<div id='contactform_bottom'>
		
			<?php echo recaptcha_get_html($publickey);?><br>
			
			<?php echo $this->Form->end('Send');?><br>
		</div>
</form>