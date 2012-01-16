<?php

echo $this->element('admin_menu',array("contentId"));

//debug($image);

echo $this->Html->image($image['path_to_pic'],
array(
		'style' => 'float: left', 
		'width' => '150px', 
		'alt' => 'ImagePreview', 
)
);


echo $this->Form->create('editor', 
	array(
		'url' => 
			array(
				'plugin' => 'Gallery',
    			'controller' => 'Images',
    			'action' => 'save' , $image['id']
    		)
    )
);
echo $this->Form->hidden('GalleryImage.id', array(
		'value' => $image['id'])
);
echo $this->Form->input('GalleryImage.title', array(
		'label' => 'Title:', 
		'value' => $image['title'])
);



echo $this->Form->button('Save', array(
		'type' => 'submit', 
		'value' => 'save'));


echo '<div style="clear:both;"></div>';