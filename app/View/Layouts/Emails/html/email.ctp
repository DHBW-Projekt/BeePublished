<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<body>
	<div></div>
	<div>
		<?php
			if (isset($header)) 
				echo $header;
			
			echo $content_for_layout;
			
			if (isset($footer))
				echo $footer; 
		?>
	</div>
	<div style="background-color: #ffffff; font-size: 12px; padding: 10px 20px; padding-bottom: 30px; margin-bottom: 30px; color: #cccccc;">
		<?php echo __('Powered by BeePublished - All rights reserved - &copy; Copyright 2011-2012'); ?>
	</div>
	</body>
</html>
