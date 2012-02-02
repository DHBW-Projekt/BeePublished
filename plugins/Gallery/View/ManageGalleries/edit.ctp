<?php
echo $this->Session->flash();
echo $this->element('admin_menu',array("ContentId" => $ContentId, "mContext" => $mContext));

	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	if($createAllowed) {
		echo $this->Form->create('editor', array('url' => array('plugin' => 'Gallery','controller' => 'ManageGalleries','action' => 'edit',$data['GalleryEntry']['id'],$ContentId,$mContext)));
		echo $this->Form->hidden('GalleryEntry.id', array('value' => $data['GalleryEntry']['id']));
		echo $this->Form->input('GalleryEntry.title', array('title' => __('Title:'), 'value' => $data['GalleryEntry']['title']));
		echo $this->Form->label(__('Description'));
		echo $this->Form->input('GalleryEntry.description', array('value' => $data['GalleryEntry']['description']));
		echo $this->Form->button(__('Save changes'), array('type' => 'submit', 'value' => 'edit'));
		echo '<div style="clear:both;"></div>';
	}

