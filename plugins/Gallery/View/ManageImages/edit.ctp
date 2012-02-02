<?php
echo $this->element('admin_menu',array("ContentId" => $ContentId, "mContext" => $mContext));
	echo '<h1>'.__('Edit an image').'</h1>';
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	if($editAllowed){
		
		echo '<img src="'.$this->webroot.$data['Picture']['thumb'].'" width="40px" />';
				
		echo $this->Form->create('editor', array('url' => array('plugin' => 'Gallery','controller' => 'ManageImages','action' => 'save',$ContentId,$mContext)));
		echo $this->Form->hidden('GalleryPicture.id', array('value' => $data['Picture']['id']));
		echo $this->Form->hidden('GalleryPicture.path_to_pic', array('value' => $data['Picture']['path_to_pic']));
		echo $this->Form->input('GalleryPicture.title', array('label' => 'Title:', 'value' => $data['Picture']['title']));
		echo $this->Form->button('Save', array('type' => 'submit', 'value' => 'save'));
		echo '<div style="clear:both;"></div>';
	}