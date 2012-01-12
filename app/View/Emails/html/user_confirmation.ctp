<?php $this->Helpers->load('Html');?>
<div>
	<p>Hi <?php echo $username;?>,</p>
	<p>Thank you for your registration at <?php echo $url;?>. Your account has been created. Please click <?php echo $this->Html->link('here', $activationUrl);?> to activate your account.</p>
</div>
<div>
<p>Yours sincerly,</p>
<p><?php echo $url;?></p>
</div>