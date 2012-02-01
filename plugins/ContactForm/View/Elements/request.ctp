<!-- contact form screen -->
<?php 
	//CAPTCHA
	App::import('Vendor','recaptcha/recaptchalib');
	$publickey = "6LfzYcwSAAAAAN3vRDzZKXkC0rYkwaKQTi8hMkj6";
?>

<div id="contactform_form">
	<h2><?php echo __d('contact_form','Contact Form'); ?></h2>
	<?php 
		$validationError = $this->Session->read('Validation.ContactForm.validationErrors');
		echo $this->Session->flash('ContactForm');
		
		echo $this->Form->create('ContactForm', array('url' => $url.'/contactform/send'));
	?>
	<div class="input">
		<?php
			echo $this->Form->input('name', array('label' => __d('contact_form','Name:'), 'type' => 'text', 'maxlength' => '35'));
			echo $this->Form->input('email', array('label' => __d('contact_form','E-Mail*:'), 'maxlength' => '50'));
			echo $this->Form->input('subject', array('label' => __d('contact_form','Subject*:'), 'maxlength' => '100'));
			echo $this->Form->input('body', array('label' => __d('contact_form','Message*:'), 'rows' => '4'));
		?>
	</div>
	
	<div class="input">
		<?php 
			echo $this->Form->label('recaptcha_response_field', __d('contact_form','CAPTCHA*:'));
			echo recaptcha_get_html($publickey);
		?>
	</div>
	<div id='contactform_between'><i><?php echo $this->Form->label(__d('contact_form','* - Mandatory fields')); ?></i></div>
	<div style="align: left"><br><?php echo $this->Form->end(__d('contact_form','Send')); ?></div>
</div>