<?php
	//CAPTCHA
	App::import('Vendor','recaptcha/recaptchalib');
	$publickey = "6LfzYcwSAAAAAN3vRDzZKXkC0rYkwaKQTi8hMkj6";
?>

<div id='applicationmembership_form'>
	<h2><?php echo __d('application_membership','Application for membership'); ?></h2>
	<?php
		$validationError = $this->Session->read('Validation.ApplicationMembership.validationErrors');
		echo $this->Session->flash('ApplicationMembership');
	?>
	
	<p class="applicationmembership_oath">
		<?php echo __d('application_membership','I hereby apply for membership in this association:'); ?>
	</p>
	
	<?php echo $this->Form->create('ApplicationMembership', array('url' => $url.'/applicationmembership/send'));?>

	<div class="input">
		<?php
			echo $this->Form->label('type', __d('application_membership','Membership*'));
		
			$options = array('true' => 'active','false' => 'passive');
			echo $this->Form->select('type', $options, array('label' => false));
		?>
	</div>

	<div class="input">
		<?php
			echo $this->Form->label('title', __d('application_membership','Form of address*'));

			$options = array('Ms/Mrs' => 'Ms/Mrs','Mr' => 'Mr');

			echo $this->Form->select('title', $options, array('label' => __d('application_membership','Form of address*')));
		?>
	</div>

	<?php echo $this->Form->input('last_name', array('label' => __d('application_membership','Lastname*'))); ?>
	<?php echo $this->Form->input('first_name', array('label' => __d('application_membership','Firstname*'))); ?>

	<div class="input">
	<?php 
		echo $this->Form->label('date_of_birth', __d('application_membership','Date of birth*'));

		echo $this->Form->dateTime(	$fieldName = 'date_of_birth',
									$dateFormat = 'DMY',
									$timeFormat = null,
									$attributes = array('label' => false, 'dateFormat' => 'DMY', 'minYear' => date("Y") - 100, 'maxYear' => date("Y"), 'monthNames' => true, 'empty' => ' '));
	?>
	</div>

	<?php
		echo $this->Form->input('email', array('label' => __d('application_membership','Email*')));
		echo $this->Form->input('telephone', array('label' => __d('application_membership','Telephone')));
		echo $this->Form->input('street', array('label' => __d('application_membership','Street and street number*')));
		echo $this->Form->input('zip', array('label' => __d('application_membership','Zip*')));
		echo $this->Form->input('city', array('label' => __d('application_membership','City*')));
		echo $this->Form->input('comment', array('label' => __d('application_membership','Comment'), 'rows' => '4','id'=>'ApplicationMembershipComment'));
	?>

	<div class="input">
		<?php 
			echo $this->Form->label('recaptcha_response_field', __d('application_membership','Captcha'));
			echo recaptcha_get_html($publickey);	
		?>
	</div>

	<p class="applicationmembership_fieldinfo">
	<?php echo __d('application_membership','The marked fields(*) are required.'); ?>
	</p>

	<?php echo $this->Form->end(__d('application_membership','Send'));?>
</div>