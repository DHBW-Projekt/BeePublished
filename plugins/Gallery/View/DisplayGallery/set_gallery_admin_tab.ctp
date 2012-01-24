<?php 
echo $this->element('admin_menu_galleries',array("ContentId" => $data['ContentId']));

echo "<table>";
echo "<tr> <td> Id </td> <td> Title </td> </tr>";

foreach ($data['AllGalleries'] as $gallery){
	echo "<tr>";
	echo "<td>".$gallery['GalleryEntry']['title']."</td>";
	echo "<td>";
	echo $this->Html->link($this->Html->image("check.png", array('width' => '32px')),array('action' => 'setGallery', $data['ContentId'], $gallery['GalleryEntry']['id']),array('escape' => False));
	echo "</td>";
	echo "</tr>";
}
echo "</table>";

?>