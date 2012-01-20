<?php 
foreach ($data['GalleryPicture'] as $pic){

if(isset($pic['path_to_pic'])){
echo $this->Html->image($pic['path_to_pic'],
	array(
		'style' => 'float: left', 
		'width' => '350px', 
		'alt' => 'ImagePreview', 
	)
);
}
}
echo '<div style="clear:both;"></div>';

//debug($data);

?>