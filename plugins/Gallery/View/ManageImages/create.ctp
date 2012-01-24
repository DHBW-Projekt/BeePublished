<?php
echo $this->element('admin_menu_galleries',array("ContentId" => $ContentId));

echo "<h1>Add new Image</h1>";

echo $this->Form->create('addImage', array('url' => array('plugin' => 'Gallery','controller' => 'ManageImages','action' => 'create',$data['ContentId']),'type' => 'file'));

echo $this->Form->input(__('Title'));
echo $this->Form->label(__('File'));
echo $this->Form->file('File');

echo $this->Form->submit(__('Add Image'));
echo $this->Form->end();
?>