<?php 
echo $this->Html->image($data['path_to_pic'],
	array(
		'style' => 'float: left', 
		'width' => '350px', 
		'alt' => 'ImagePreview', 
	)
);
echo '<div style="clear:both;"></div>';

?>