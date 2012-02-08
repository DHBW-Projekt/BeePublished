<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?php 
/*
* This file is part of BeePublished which is based on CakePHP.
* BeePublished is free software: you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation, either version 3
* of the License, or any later version.
* BeePublished is distributed in the hope that it will be useful, but
* WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* You should have received a copy of the GNU General Public
* License along with BeePublished. If not, see
* http://www.gnu.org/licenses/.
*
* @copyright 2012 Duale Hochschule Baden-W¸rttemberg Mannheim
* @author Marcus Lieberenz
*
* @description Basic Settings for all controllers
*/
?>


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
