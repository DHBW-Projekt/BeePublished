<?php $this->Helpers->load('Html');?>
<div>
	<p><?php echo __('Hi').'&nbsp;'.$username;?>,</p>
	<p><?php echo __('Thank you for your registration at').'&nbsp;'.$url.'.&nbsp;'.__('Your account has been created. Please click ').$this->Html->link(__('here'), $activationUrl).__(' to activate your account.');?></p>
</div>
<div>
<p><?php echo __('Yours sincerly,');?></p>
<p><?php echo $url;?></p>
</div>