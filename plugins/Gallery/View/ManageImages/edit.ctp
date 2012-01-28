<?php
echo $this->element('admin_menu_images',array("ContentId" => $data['ContentId']));

	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	if($editAllowed){
		echo $this->Html->image($data['Picture']['path_to_pic'],array('style' => 'float: left', 'width' => '150px', 'alt' => 'ImagePreview', ));
		echo $this->Form->create('editor', array('url' => array('plugin' => 'Gallery','controller' => 'ManageImages','action' => 'save',$data['ContentId'])));
		echo $this->Form->hidden('GalleryPicture.id', array('value' => $data['Picture']['id']));
		echo $this->Form->hidden('GalleryPicture.path_to_pic', array('value' => $data['Picture']['path_to_pic']));
		echo $this->Form->input('GalleryPicture.title', array('label' => 'Title:', 'value' => $data['Picture']['title']));
		echo $this->Form->button('Save', array('type' => 'submit', 'value' => 'save'));
		echo '<div style="clear:both;"></div>';
	}