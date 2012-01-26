<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Register new User'); ?></legend>
		<?php
			echo $this->Form->input('username');
			echo $this->Form->input('password');
			echo $this->Form->input('password_confirm', array('type' => 'password'));
			echo $this->Form->input('email');
		?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>