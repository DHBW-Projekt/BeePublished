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
 * @description Edit view to edit a gallery
 */


echo $this->Session->flash();
echo $this->element('admin_menu',array("ContentId" => $ContentId, "mContext" => $mContext));

	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	if($createAllowed) {
		echo $this->Form->create('editor', array('url' => array('plugin' => 'Gallery','controller' => 'ManageGalleries','action' => 'edit',$data['GalleryEntry']['id'],$ContentId,$mContext)));
		echo $this->Form->hidden('GalleryEntry.id', array('value' => $data['GalleryEntry']['id']));
		echo $this->Form->input('GalleryEntry.title', array('title' => __('Title:'), 'value' => $data['GalleryEntry']['title']));
		echo $this->Form->label(__('Description'));
		echo $this->Form->input('GalleryEntry.description', array('value' => $data['GalleryEntry']['description']));
		echo $this->Form->button(__('Save changes'), array('type' => 'submit', 'value' => 'edit'));
		echo '<div style="clear:both;"></div>';
	}

