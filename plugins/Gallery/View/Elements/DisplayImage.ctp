<?php
if(!isset($data))
	echo __("No image assigned");
else {
	echo $this->Html->image($data['path_to_pic'],
		array(
			'style' => 'float: left', 
			'width' => '350px'
		)
	);
	echo '<div style="clear:both;"></div>';
}
?>