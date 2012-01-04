<?php
$user = $this->Session->read('Auth.User'); // get data for current user
?>
<div id="subscription">
	<?php
		if (($user['role_id']) == '3') {
			echo $this->Form->create('Subscription',array('url' => array('plugin' => 'Newsletter',
														   		  'controller' => 'Subscription',
														   		  'action' => 'subscribe')));
	    	echo $this->Form->input('email');
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
