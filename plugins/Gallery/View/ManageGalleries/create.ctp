<?php
$this->Html->css('/gallery/css/galleries', NULL, array('inline' => false));
echo $this->element('admin_menu',array("ContentId" => $contentId, "mContext" => $mContext));
echo $this->Session->flash();


	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	if($createAllowed) {

		echo "<h1> ".__('Create a new gallery')."</h1>";


		echo '<div class="galleryinfo">'.__('Create a new gallery to share the newest pictures with your audience.').'</div>';

		echo $this->Form->create('GalleryEntry', array('url' => array('plugin' => 'Gallery','controller' => 'ManageGalleries','action' => 'create',$ContentId,$mContext)));


		echo $this->Form->input('GalleryEntry.title');
		echo $this->Form->input('GalleryEntry.description', array('div' => 'mandatory', 'type' => 'textarea', 'label' => (__('Description:')))).'<br />';

		echo $this->Form->label(__('Title picture:'));

		echo $this->Form->select('GalleryEntry.gallery_picture_id', $pictures);

		echo $this->Form->submit('Submit');
		echo $this->Form->end();
	}

?>