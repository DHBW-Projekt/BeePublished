<!-- contact form screen -->
<?php 
	//CAPTCHA
	App::import('Vendor','recaptcha/recaptchalib');
	$publickey = "6LfzYcwSAAAAAN3vRDzZKXkC0rYkwaKQTi8hMkj6";
	//echo $this->Html->css('/ContactForm/css/contact_form');
?>

<form id = 'contactform_form'>
	<h2><?php echo __('Contact Form') ?></h2>
		<?php 
			$validationError = $this->Session->read('Validation.ContactForm.validationErrors');
			echo $this->Session->flash('ContactForm');
			echo $this->Form->create('ContactForm', array('url' => $url.'/contactform/send'));
		?>
		<div id = 'contactform_div'>
			<label><?php echo $this->Form->label('name', __('Name: '));?></label><?php echo $this->Form->input('name', array('label' => '', 'type' => 'text', 'maxlength' => '30'));?>
			
			<label><?php echo $this->Form->label('email', __('E-Mail*: '));?></label><?php echo $this->Form->input('email', array('label' => '', 'maxlength' => '40'));?>
			
			<label><?php echo $this->Form->label('subject', __('Subject*: '));?></label><?php echo $this->Form->input('subject', array('label' => ''));?>
			
			<label><?php echo $this->Form->label('body', __('Message*: '));?></label><?php echo $this->Form->input('body', array('label' => '', 'rows' => '4', 'type' => 'text'));?>
			
			<label><?php echo __('* - Mandatory field') ?></label>
		</div><br />
		<div id='contactform_bottom'>
			<?php echo recaptcha_get_html($publickey);?><br />
			<?php echo $this->Form->end('Send');?><br />
		</div>
</form>