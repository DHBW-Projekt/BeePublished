<?php
if(!isset($data))
	echo __("No image assigned");
else {
	echo '<img src="'.$this->webroot.$data['path_to_pic'].'" />';
	echo '<div style="clear:both;"></div>';
}
?>