<?php
echo $this->Session->flash();
echo $this->element('admin_menu_galleries',array("ContentId" => $data['ContentId']));
echo "<h1> ".__('Manage your Galleries')."</h1>";


echo '<table id="recipients">';
	echo '<thead>';
		echo '<tr>';
			echo '<th></th>';
			echo '<th>'.__('Title').'</th>';
			echo '<th>'.__('Description').'</th>';
			echo '<th></th>';
			echo '<th></th>';
			echo '<th></th>';
		echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	echo $this->Form->create('selectGalleries', array(
				'url' => array(
				'plugin' => 'Gallery',
				'controller' => 'ManageGalleries',
				'action' => 'deleteSelected',$data['ContentId']),
				'onsubmit'=>'return confirm(\''.__('Do you really want to delete the selected galleries?').'\');'));
//debug($data);
foreach ($data['AllGalleries'] as $gallery){
	echo "<tr>";
		echo '<td>';
			echo $this->Form->checkbox($gallery['GalleryEntry']['id']);
		echo '</td>'; 
		echo "<td>".$gallery['GalleryEntry']['title']."</td>";
		echo "<td>".$gallery['GalleryEntry']['description']."</td>";
	
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
	echo '</tbody>';
	echo '<tfoot>';	
			echo '<tr>';
				echo '<td>';
				echo $this->Html->image('/app/webroot/img/arrow.png', array(
						'height' => 20,
						'width' => 20));
				echo '</td>';
				echo '<td>';
					echo $this->Form->submit(__('Delete'), array(
							'height' => 20,
							'width' => 20,
							'alt' => __('[x]Delete')));
					echo $this->Form->end();
				echo '</td>';
			echo '</tr>';
		echo '</tfoot>';
echo "</table>";
?>