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
 * @description View to edit an image
 */


echo $this->element('admin_menu',array("ContentId" => $ContentId, "mContext" => $mContext));
	echo '<h1>'.__d('gallery', 'Edit an image').'</h1>';
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
	
	if($editAllowed){
		
		echo '<img src="'.$this->webroot.$data['Picture']['thumb'].'" width="40px" />';
				
		echo $this->Form->create('editor', array('url' => array('plugin' => 'Gallery','controller' => 'ManageImages','action' => 'save',$ContentId,$mContext)));
		echo $this->Form->hidden('GalleryPicture.id', array('value' => $data['Picture']['id']));
		echo $this->Form->hidden('GalleryPicture.path_to_pic', array('value' => $data['Picture']['path_to_pic']));
		echo $this->Form->input('GalleryPicture.title', array('label' => 'Title:', 'value' => $data['Picture']['title']));
		echo $this->Form->button('Save', array('type' => 'submit', 'value' => 'save'));
		echo '<div style="clear:both;"></div>';
	}