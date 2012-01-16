<?php
echo $this->element('admin_menu',array("ContentId" => $data['ContentId']));

echo "Add new Image";

echo $this->Form->create('addImage', array('url' => array('plugin' => 'Gallery','controller' => 'ManageImages','action' => 'create',$data['ContentId']),'type' => 'file'));

echo $this->Form->input('ImageTitle');
echo $this->Form->file('File');

echo $this->Form->submit('add Image');
echo $this->Form->end();

echo "<br>";
echo "existing images";

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