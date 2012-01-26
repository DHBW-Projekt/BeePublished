<?php
echo $this->element('admin_menu_galleries',array("ContentId" => $data['ContentId']));
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
 	if($createAllowed){
		echo '<h1>'.__('Add Images').'</h1>';

		echo $this->Session->flash('Image saved');
		echo $this->Session->flash('Image deleted');


		echo '<h1>'.__('Add single images').'</h1>';

		echo $this->Form->create('addImage', array('url' => array('plugin' => 'Gallery','controller' => 'ManageImages','action' => 'uploadImage',$data['ContentId']),'type' => 'file'));

		echo $this->Form->input(__('Title'));
		echo $this->Form->label(__('File'));
		echo $this->Form->file('File');


		echo $this->Form->submit(__('Add image'));
		echo $this->Form->end();

		echo '<h1>'.__('Add multiple images').'</h1>';


		echo $this->Form->create('addImage', array('url' => array('plugin' => 'Gallery','controller' => 'ManageImages','action' => 'uploadImages',$data['ContentId']),'type' => 'file'));
		echo $this->Form->input('data', array('label'=>'File', 'type'=>'file', 'name' => 'files[]', 'multiple'));
		echo $this->Form->submit(__('Add images'));
		echo $this->Form->end();
 	}
?>