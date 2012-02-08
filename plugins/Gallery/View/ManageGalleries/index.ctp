<?php
/*
 * This file is part of BeePublished which is based on CakePHP.
 * BeePublished is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3
 * of the License, or any later version.
 * BeePublished is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public
 * License along with BeePublished. If not, see
 * http://www.gnu.org/licenses/.
 *
 * @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
 * @author Alexander Müller & Fabian Kajzar
 * 
 * @description index view for all galleries
 */


$this->Html->css('/gallery/css/galleries', NULL, array('inline' => false));

echo $this->element('admin_menu',array("ContentId" => $ContentId, "mContext" => $mContext));
	
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	
echo "<h1> ".__d('gallery', 'Manage your galleries')."</h1>";
echo $this->Session->flash('GalleryNotification');
echo '<div class="galleryinfo">'.__d('gallery', 'Here you can edit, delete your galleries or assign pictures to them.').'</div>';

if($createAllowed) {

	echo "<h1> ".__d('gallery', 'Create a new gallery')."</h1>";


	echo '<div class="galleryinfo">'.__d('gallery', 'Create a new gallery to share the newest pictures with your audience.').'</div>';

	echo $this->Form->create('GalleryEntry', array('url' => array('plugin' => 'Gallery','controller' => 'ManageGalleries','action' => 'create',$ContentId,$mContext)));


	echo $this->Form->input('GalleryEntry.title');
	echo $this->Form->input('GalleryEntry.description', array('div' => 'mandatory', 'type' => 'textarea', 'label' => (__d('gallery', 'Description:')))).'<br />';

	echo $this->Form->label(__d('gallery', 'Title picture:'));

	echo $this->Form->select('GalleryEntry.gallery_picture_id', $pictures);

	echo $this->Form->submit('Submit');
	echo $this->Form->end();
}

echo '<h1>'.__d('gallery', "Existing galleries").'</h1>';

echo '<table>';
	echo '<thead>';
		echo '<tr>';
			echo '<th></th>';
			echo '<th>'.__d('gallery', 'Title').'</th>';
			echo '<th>'.__d('gallery', 'Description').'</th>';
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
				'action' => 'deleteSelected',$ContentId,$mContext),
				'onsubmit'=>'return confirm(\''.__d('gallery', 'Do you really want to delete the selected galleries?').'\');'));
foreach ($data['AllGalleries'] as $gallery){
	echo "<tr>";
		echo '<td>';
			echo $this->Form->checkbox($gallery['GalleryEntry']['id']);
		echo '</td>'; 
		echo "<td>".$gallery['GalleryEntry']['title']."</td>";
		echo "<td>".$gallery['GalleryEntry']['description']."</td>";
	
		echo '<td>';
		if($editAllowed){
			echo $this->Html->link($this->Html->image('edit.png', array(
							'height' => 20, 
							'width' => 20, 
							'alt' => __d('gallery', '[x]Edit'))),
							array(
								'plugin' => 'Gallery', 
								'controller' => 'ManageGalleries', 
								'action' => 'edit', $gallery['GalleryEntry']['id'],$ContentId,$mContext),
							array(
								'escape' => false, 
								'title' => __d('gallery', 'Edit Gallery')));
		};
		echo '</td>';
	
		echo '<td>';
		
			if($deleteAllowed){
			echo $this->Html->link($this->Html->image('delete.png', array(
							'height' => 20, 
							'width' => 20, 
							'alt' => __d('gallery', '[x]Delete'))),
							array(
								'plugin' => 'Gallery', 
								'controller' => 'ManageGalleries', 
								'action' => 'delete',$gallery['GalleryEntry']['id'],$ContentId,$mContext),
							array(
								'escape' => false, 
								'title' => __d('gallery', 'Delete Gallery')),
								__d('gallery', 'Do you really want to delete this Gallery?'));
			}
		echo '</td>';
	
		echo '<td>';
			if($editAllowed){
				echo $this->Html->image('add2.png',array('style' => 'float: left', 'width' => '20px', 'alt' => '[]Assign', 'url' => array('plugin' => 'Gallery', 'controller' => 'ManageGalleries', 'action' => 'assignImages',$gallery['GalleryEntry']['id'],$ContentId,$mContext)));
			}		
		echo '</td>';
		
	echo "</tr>";
}
	echo '</tbody>';
	echo '<tfoot>';	
			echo '<tr>';
				echo '<td>';
				echo $this->Html->image('arrow.png', array(
						'height' => 20,
						'width' => 20));
				echo '</td>';
				echo '<td>';
					echo $this->Form->submit(__d('gallery', 'Delete'), array(
							'height' => 20,
							'width' => 20,
							'alt' => __d('gallery', '[x]Delete')));
					echo $this->Form->end();
				echo '</td>';
			echo '</tr>';
		echo '</tfoot>';
echo "</table>";
?>