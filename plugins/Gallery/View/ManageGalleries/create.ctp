<?php
$this->Html->css('/gallery/css/galleries', NULL, array('inline' => false));
echo $this->element('admin_menu_galleries',array("ContentId" => $data['ContentId']));
echo $this->Session->flash();


echo "<h1> ".__('Create a new Gallery')."</h1>";

echo '<div class="galleryinfo">'.__('Create a new gallery to share the newest pictures with your audience.').'</div>';

echo $this->Form->create('GalleryEntry', array('url' => array('plugin' => 'Gallery','controller' => 'ManageGalleries','action' => 'create',$data['ContentId'])));

echo $this->Form->input('GalleryEntry.title');

echo $this->Form->input('GalleryEntry.description');

echo $this->Form->label(__('Title Picture:'));

echo $this->Form->select('GalleryEntry.gallery_picture_id', $pictures);

//echo $this->Form->input('GalleryEntry.gallery_picture_id', array('type' => 'select', 'options' => $pictures, 'value' => $pictures));
echo $this->Form->submit('submit');
echo $this->Form->end();
?>