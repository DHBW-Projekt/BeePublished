<?php
$user = $this->Session->read('Auth.User'); // get data for current user
$this->Html->script('/newsletter/js/newsletter', false);
?>
<div id="subscription">

	<?php
		if (($user['role_id']) == '2') {
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
//	    	echo '<br>'.$plugin.'<br>'.$view.'<br>'.$id;
	    	
			  	
		   	echo $this->Html->link(
	      		$this->Html->image('tools.png', array('class' => 'setting_image')),
	       		array('plugin' => 'Newsletter', 'controller' => 'Subscription', 'action' => 'admin2'),
	      		array('escape' => False, 'id' => 'overlay') //, 'class' => 'setting_button')
	    	);
	    		
		    	
		    // if current user is admin (change later: role_id >= 4), for development: 3

      	};
       
	?>
	
</div>



