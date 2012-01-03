<?php
$user = $this->Session->read('Auth.User');
?>
<div id="subscription">
	<?php
		if (($user['role_id']) == '2') {
			echo $this->Form->create('Subscription');
	    	echo $this->Form->input('email:');
	    	echo $this->Form->end('(Un)subscribe');
	    } else if (($user['role_id']) >= '3') {
	    	echo $user['email'];
	    };
	?>
</div>

<?php
	if (isset($this->data['Subscription'])) {
	   echo "Subscription was successfull";
	}
?>