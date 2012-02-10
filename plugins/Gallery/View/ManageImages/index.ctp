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
 * @description index view for images
 */


echo $this->element('admin_menu',array("ContentId" => $ContentId, "mContext" => $mContext));

echo $this->Session->flash('Image saved');
echo $this->Session->flash('Image deleted');

echo "<h2>".__d('gallery', 'Add single image')."</h2>";

echo $this->Form->create('addImage', array('url' => array('plugin' => 'Gallery','controller' => 'ManageImages','action' => 'uploadImage',$ContentId,$mContext),'type' => 'file'));

echo $this->Form->input(__d('gallery', 'Title'));
echo $this->Form->label(__d('gallery', 'File'));
echo $this->Form->file('File');

echo $this->Form->submit(__d('gallery', 'Add image'));
echo $this->Form->end();

echo "<h2>".__d('gallery', 'Add multiple images')."</h2>";

echo $this->Form->create('addImage', array('url' => array('plugin' => 'Gallery','controller' => 'ManageImages','action' => 'uploadImages',$ContentId,$mContext),'type' => 'file'));
echo $this->Form->input('data', array('label'=>'Files', 'type'=>'file', 'name' => 'files[]', 'multiple'));
echo $this->Form->submit(__d('gallery', 'Add images'));
echo $this->Form->end();

echo "<br>";
echo "<hr>";
echo "<br>";

echo "<h1>".__d('gallery', 'Existing images')."</h1>";

echo '<table>';
	echo '<thead>';
		echo '<tr>';
			echo '<th></th>';
			echo '<th>'.__d('gallery', 'Preview').'</th>';
			echo '<th>'.__d('gallery', 'Title').'</th>';
			echo '<th>'.__d('gallery', 'Edit').'</th>';
			echo '<th>'.__d('gallery', 'Delete').'</th>';
		echo '</tr>';
	echo '</thead>';
echo '<tbody>';
echo $this->Form->create('selectPictures', array(
				'url' => array(
				'plugin' => 'Gallery',
				'controller' => 'ManageImages',
				'action' => 'deleteSelected',$ContentId),
				'onsubmit'=>'return confirm(\''.__d('gallery', 'Do you really want to delete the selected images?').'\');'));

foreach ($data['AllPictures'] as $picture){
	echo "<tr>";
	
	echo "<td>".$this->Form->checkbox($picture['id'])."</td>";
		
	echo '<td>'.'<img src="'.$this->webroot.$picture['thumb'].'" width="35px" /></td>';

	echo "<td>".$picture['title']."</td>";
	
	echo '<td>';
	echo $this->Html->image('edit.png',array('style' => 'float: left', 'width' => '20px', 'alt' => '[]Edit', 'url' => array('plugin' => 'Gallery', 'controller' => 'ManageImages', 'action' => 'edit', $picture['id'],$ContentId,$mContext)));
	echo '</td>';
	
	echo '<td>';
	
	echo $this->Html->link($this->Html->image('delete.png', array(
								'height' => 20, 
								'width' => 20, 
								'alt' => __d('gallery', '[x]Delete'))),
								array(
									'plugin' => 'Gallery', 
									'controller' => 'ManageImages', 
									'action' => 'delete', 
									$picture['id'],
									$ContentId,$mContext),
								array(
									'escape' => false, 
									'title' => __d('gallery', 'Delete Image')),
	__d('gallery', 'Do you really want to delete this image?'));

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
							'alt' => __d('gallery', '[x]Delete'),
							'onsubmit'=>'return confirm(\''.__d('gallery', 'Do you really want to delete the selected images?').'\');'));
					echo $this->Form->end();
				echo '</td>';
			echo '</tr>';
		echo '</tfoot>';
echo "</table>";

?>