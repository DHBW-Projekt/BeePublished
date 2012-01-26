<?php
echo $this->Session->flash();
echo $this->element('admin_menu_galleries',array("ContentId" => $ContentId));
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	if($createAllowed) {
		echo $this->Form->create('editor', array('url' => array('plugin' => 'Gallery','controller' => 'ManageGalleries','action' => 'edit',$data['GalleryEntry']['id'],$ContentId)));
		echo $this->Form->hidden('GalleryEntry.id', array('value' => $data['GalleryEntry']['id']));
		echo $this->Form->input('GalleryEntry.title', array('title' => 'Description:', 'value' => $data['GalleryEntry']['title']));
		echo $this->Form->input('GalleryPicture.description', array('label' => 'Description:', 'value' => $data['GalleryEntry']['description']));
		echo $this->Form->button('Save changes', array('type' => 'submit', 'value' => 'edit'));
		echo '<div style="clear:both;"></div>';
	}
