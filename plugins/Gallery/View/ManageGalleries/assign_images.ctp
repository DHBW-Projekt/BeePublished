<?php
echo $this->Session->flash();
echo $this->element('admin_menu',array("ContentId" => $ContentId));

echo "available pictures";
echo "<table>";
echo "<tr> <td> Id </td> <td> Title </td> </tr>";

foreach ($available_pictures as $picture){
	echo "<tr>";
	echo "<td>".$picture['id']."</td>";
	echo "<td>".$picture['title']."</td>";
	echo "<td>";
	echo $this->Html->image("add2.png", 
	array('width' => '32px',
	'url' => array('plugin' => 'Gallery', 'controller' => 'ManageGalleries', 'action' => 'assignImage',$galleryId,$picture['id'])));
	echo "</td>";
	echo "</tr>";
}
echo "</table>";


echo "gallery pictures";
echo "<table>";
echo "<tr> <td> Id </td> <td> Title </td> </tr>";

foreach ($gallery_pictures as $picture){
	echo "<tr>";
	echo "<td>".$picture['id']."</td>";
	echo "<td>".$picture['title']."</td>";
	echo "<td>";
	echo $this->Html->image("delete.png", 
	array('width' => '32px',
	'url' => array('plugin' => 'Gallery', 'controller' => 'ManageGalleries', 'action' => 'unassignImage',$galleryId,$picture['id'])));
	echo "</td>";
	echo "</tr>";
}
echo "</table>";
?>