<?php 


foreach ($data['GalleryPicture'] as $pic){
	
echo $this->Html->image($pic['thumb'],
	array(
		'style' => 'float: left', 
		'alt' => 'ImagePreview',
		'url' => array(
				'plugin' => 'Gallery',
				'controller' => 'DisplayGallery',
				'action' => 'displaySingleImage',$data['GalleryEntry']['id'],$pic['id'])
	)
);

}

debug($data);

echo '<div style="clear:both;"></div>';

//debug($data);

?>