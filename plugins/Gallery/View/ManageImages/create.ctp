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
 * @description Create view for images
 */


echo $this->element('admin_menu',array("ContentId" => $ContentId, "mContext" => $mContext));
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
 	if($createAllowed){
	

		echo $this->Session->flash('Image saved');
		echo $this->Session->flash('Image deleted');


		echo '<h1>'.__('Add single images').'</h1>';

		echo $this->Form->create('addImage', array('url' => array('plugin' => 'Gallery','controller' => 'ManageImages','action' => 'uploadImage',$ContentId),'type' => 'file'));

		echo $this->Form->input(__('Title'));
		echo $this->Form->label(__('File'));
		echo $this->Form->file('File');


		echo $this->Form->submit(__('Add image'));
		echo $this->Form->end();

		echo '<h1>'.__('Add multiple images').'</h1>';


		echo $this->Form->create('addImage', array('url' => array('plugin' => 'Gallery','controller' => 'ManageImages','action' => 'uploadImages',$ContentId),'type' => 'file'));
		echo $this->Form->input('data', array('label'=>'File', 'type'=>'file', 'name' => 'files[]', 'multiple'));
		echo $this->Form->submit(__('Add images'));
		echo $this->Form->end();
 	}
?>