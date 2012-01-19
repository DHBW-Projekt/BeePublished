<?php
echo $this->element('admin_menu',array("ContentId" => $data['ContentId']));


//prepare Values array



echo "Add new Image";

echo $this->Form->create('GalleryEntry', array('url' => array('plugin' => 'Gallery','controller' => 'ManageGalleries','action' => 'create',$data['ContentId'])));

echo $this->Form->input('GalleryEntry.title');
echo $this->Form->input('GalleryEntry.description');
echo $this->Form->select('GalleryEntry.gallery_picture_id', $pictures);
//echo $this->Form->input('GalleryEntry.gallery_picture_id', array('type' => 'select', 'options' => $pictures, 'value' => $pictures));
echo $this->Form->submit('submit');
echo $this->Form->end();



echo "<table>";
echo "<tr> <td> Id </td> <td> Title </td> </tr>";

//debug($data);
foreach ($data['AllGalleries'] as $gallery){
	echo "<tr>";
	echo "<td>".$gallery['GalleryEntry']['id']."</td>";
	echo "<td>".$gallery['GalleryEntry']['title']."</td>";
	
	echo '<td>';
	echo $this->Html->image('/app/webroot/img/edit.png',array('style' => 'float: left', 'width' => '20px', 'alt' => '[]Edit', 'url' => array('plugin' => 'Gallery', 'controller' => 'ManageGalleries', 'action' => 'edit', $gallery['GalleryEntry']['id'],$data['ContentId'])));
	echo '</td>';
	
	echo '<td>';
	echo $this->Html->image('/app/webroot/img/delete.png',array('style' => 'float: left', 'width' => '20px', 'alt' => '[]Delete', 'url' => array('plugin' => 'Gallery', 'controller' => 'ManageGalleries', 'action' => 'delete',$gallery['GalleryEntry']['id'],$data['ContentId'])));
	echo '</td>';
	
	echo '<td>';
	echo $this->Html->image('/app/webroot/img/delete.png',array('style' => 'float: left', 'width' => '20px', 'alt' => '[]Assign', 'url' => array('plugin' => 'Gallery', 'controller' => 'ManageGalleries', 'action' => 'assignImages',$gallery['GalleryEntry']['id'],$data['ContentId'])));
	echo '</td>';
	
	echo "</tr>";
}
echo "</table>";
?>