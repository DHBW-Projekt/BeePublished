<?php
echo $this->Session->flash();
echo $this->element('admin_menu_galleries',array("ContentId" => $data['ContentId']));
echo "<h1> ".__('Manage your Galleries')."</h1>";

echo "<table>";
echo "<tr> <td> Id </td> <td> Title </td>  <td> Assign Pictures</td></tr>";

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
	echo $this->Html->image('/app/webroot/img/add2.png',array('style' => 'float: left', 'width' => '20px', 'alt' => '[]Assign', 'url' => array('plugin' => 'Gallery', 'controller' => 'ManageGalleries', 'action' => 'assignImages',$gallery['GalleryEntry']['id'],$data['ContentId'])));
	echo '</td>';
	
	echo "</tr>";
}
echo "</table>";
?>