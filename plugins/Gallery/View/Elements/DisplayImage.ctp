<?php
if(!isset($data))
	echo __("No image assigned");
else {
	echo '<img src="'.$this->webroot.$data['path_to_pic'].'" width="100%" />';
	echo '<div style="clear:both;"></div>';
}
?>