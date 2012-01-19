<?php

echo $this->element('admin_menu',array("ContentId" => $ContentId));
echo $this->Form->create('editor', array('url' => array('plugin' => 'Gallery','controller' => 'ManageImages','action' => 'save',$ContentId)));
echo $this->Form->hidden('GalleryEntry.id', array('value' => $data['GalleryEntry']['id']));
echo $this->Form->input('GalleryEntry.title', array('title' => 'Description:', 'value' => $data['GalleryEntry']['title']));
echo $this->Form->input('GalleryPicture.description', array('label' => 'Description:', 'value' => $data['GalleryEntry']['description']));
echo $this->Form->button('Save', array('type' => 'submit', 'value' => 'save'));
echo '<div style="clear:both;"></div>';