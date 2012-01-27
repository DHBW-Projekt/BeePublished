<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Register new User'); ?></legend>
		<?php
			echo $this->Form->input('username', array('label' => __('Username:')));
			echo $this->Form->input('password', array('type' => 'password', 'label' => __('Password:')));
			echo $this->Form->input('password_confirm', array('type' => 'password', 'label' => __('Confirm Password:')));
			echo $this->Form->input('email', array('label' => __('Email:')));
		?>
	</fieldset>
<?php echo $this->Form->end(__('Create User'));?>
</div>