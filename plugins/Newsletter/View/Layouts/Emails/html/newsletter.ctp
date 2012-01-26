<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<style type="text/css">
		.newsletter {
			background-color: #ffffff;
			font-size: 12px;
			padding: 10px 20px;
			padding-bottom: 30px;
			margin-bottom: 30px;
			color: #cccccc;
		}
	</style>
	<body>
	<div></div>
	<div>
		<?php echo $content_for_layout; ?>
	</div>
		
	<div class="newsletter">
		<?php 
			$text = __d('newsletter','Please click here if you want to unsubscribe from this newsletter: ');
			echo $text; 
			echo $this->Html->link('Unsubscribe', 'http://'.env('SERVER_NAME', array('class' => 'newsletter')));
		?>
		<br>
		Powered by BeePublished - All rights reserved - &copy; Copyright 2011-2012
	</div>
	</body>
</html>
