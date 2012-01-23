<?php
echo $this->element('admin_menu',array("ContentId" => $data['ContentId']));

echo $this->Session->flash('Image saved');
echo $this->Session->flash('Image deleted');


echo "<h1>Add single image</h1>";

echo $this->Form->create('addImage', array('url' => array('plugin' => 'Gallery','controller' => 'ManageImages','action' => 'uploadImage',$data['ContentId']),'type' => 'file'));

echo $this->Form->input(__('Title'));
echo $this->Form->label(__('File'));
echo $this->Form->file('File');


echo $this->Form->submit(__('Add image'));
echo $this->Form->end();

echo "<h1>Add multiple images</h1>";

echo $this->Form->create('addImage', array('url' => array('plugin' => 'Gallery','controller' => 'ManageImages','action' => 'uploadImages',$data['ContentId']),'type' => 'file'));
echo $this->Form->input('data', array('label'=>'File', 'type'=>'file', 'name' => 'files[]', 'multiple'));
echo $this->Form->submit(__('Add images'));
echo $this->Form->end();

echo "<br>";
echo "<hr>";
echo "<br>";

echo "<h1>existing images</h1>";

echo "<table>";
echo "<tr> <td> Id </td> <td> Title </td> </tr>";

foreach ($data['AllPictures'] as $picture){
	echo "<tr>";
	echo "<td>".$picture['id']."</td>";
	echo "<td>".$picture['title']."</td>";
	
	echo '<td>';
	echo $this->Html->image('/app/webroot/img/edit.png',array('style' => 'float: left', 'width' => '20px', 'alt' => '[]Edit', 'url' => array('plugin' => 'Gallery', 'controller' => 'ManageImages', 'action' => 'edit', $picture['id'],$data['ContentId'])));
	echo '</td>';
	
	echo '<td>';
	echo $this->Html->image('/app/webroot/img/delete.png',array('style' => 'float: left', 'width' => '20px', 'alt' => '[]Delete', 'url' => array('plugin' => 'Gallery', 'controller' => 'ManageImages', 'action' => 'delete', $picture['id'],$data['ContentId'])));
	echo '</td>';
	
	echo "</tr>";
}
echo "</table>";

?>