<?php
/*
* This file is part of BeePublished which is based on CakePHP.
* BeePublished is free software: you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation, either version 3
* of the License, or any later version.
* BeePublished is distributed in the hope that it will be useful, but
* WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* You should have received a copy of the GNU General Public
* License along with BeePublished. If not, see
* http://www.gnu.org/licenses/.
*
* @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
* @author Maximilian Stüber, Corinna Knick
*
* @description user input screen
*/
?>

<!-- contact form screen -->
<?php 
	//CAPTCHA
	App::import('Vendor','recaptcha/recaptchalib');
	$publickey = "6LfzYcwSAAAAAN3vRDzZKXkC0rYkwaKQTi8hMkj6";
?>

<div id="contactform_form">
	<h2><?php echo __d('contact_form','Contact Form'); ?></h2>
	<?php 
		$validationError = $this->Session->read('Validation.ContactRequest.validationErrors');
		echo $this->Session->flash('ContactRequest');
		
		echo $this->Form->create('ContactRequest', array('url' => $url.'/contactform/send'));
	?>
	<div class="input">
		<?php
			echo $this->Form->input('name', array('label' => __d('contact_form','Name:'), 'type' => 'text', 'maxlength' => '35'));
			echo $this->Form->input('email', array('label' => __d('contact_form','E-Mail*:'), 'maxlength' => '50'));
			echo $this->Form->input('subject', array('label' => __d('contact_form','Subject*:'), 'maxlength' => '100'));
			echo $this->Form->input('body', array('label' => __d('contact_form','Message*:'), 'rows' => '4'));
		?>
	</div>
	<div id="contactform_captcha">
	<?php 
		echo '<p>'.__d("contact_form","For your own security please insert the following words:").'</p>';
		echo recaptcha_get_html($publickey);
	?>
	</div>
	
	<div id='contactform_between'><i><?php echo $this->Form->label(__d('contact_form','* - Mandatory fields')); ?></i></div>
	<div style="align: left"><br><?php echo $this->Form->end(__d('contact_form','Send')); ?></div>
</div>