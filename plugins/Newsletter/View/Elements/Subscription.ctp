<?php
$user = $this->Session->read('Auth.User'); // get data for current user
?>
<div id="subscription">
	<?php
//		debug($user, $showHTML = false, $showForm = true);
//	if current user is not registred or logged in
		if (!($user)) {
			echo $this->Form->create('Subscription');
	    	echo $this->Form->input('email:');
	    	echo $this->Form->end('(Un)subscribe');
	    } 
// 	if current user is registred
	    else if (($user['role_id']) >= '3') {
// check for newsletter subscription
	    	echo $user['email'];
	    };
	?>
</div>


<?php
// react on button click
	if (isset($this->data['Subscription'])) {
	   echo "Subscription was successful";
	}
?>