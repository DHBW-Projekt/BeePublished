<?php $this->Helpers->load('Html');?>
<div>
	<p>Hi <?php echo $username;?>,</p>
	<p>your password has been resetted. The new password is: <b><?php echo $newPassword;?></b>.<br>
	Please change it as soon as you are logged in!</p>
</div>
<div>
<p>Yours sincerly,</p>
<p><?php echo $url;?></p>
</div>