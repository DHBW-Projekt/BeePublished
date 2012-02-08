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
* @author Philipp Scholl
*
* @description View to show a list of all valid but unpublished news entries to publish or delete them
*/

App::uses('Sanitize', 'Utility');
$this->Helpers->load('BBCode');
$DateTimeHelper = $this->Helpers->load('Time');
//bind javascript and css
$this->Html->script('/newsblog/js/admin_publish', false);
$this->Html->css('/newsblog/css/admin', null, array('inline' => false));
//clean data from model
$entriesToPublish = Sanitize::clean($entriesToPublish);

echo $this->element('admin_menu',array('plugin' => 'Newsblog'), array('contentId' => $contentId));
$this->Js->set('webroot', $webroot);
//read permission
$publishAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Publish');

if($publishAllowed){
	echo '<div id="admin_newsblog-publish">';
	if(count($entriesToPublish) > 0){
		foreach($entriesToPublish as $entryToPublish):
			//read data array into variables
			$id = $entryToPublish['NewsEntry']['id'];
			$username = $entryToPublish['Author']['username'];
			$title = Sanitize::html($entryToPublish['NewsEntry']['title']);
			$subtitle = Sanitize::html($entryToPublish['NewsEntry']['subtitle']);
			$text = $this->BBCode->transformBBCode(Sanitize::html($entryToPublish['NewsEntry']['text']));
			$createdOn = Sanitize::html($entryToPublish['NewsEntry']['createdOn']);
			$createdOnDate = $DateTimeHelper->format('m-d-Y', $entryToPublish['NewsEntry']['createdOn']);
			$createdOnTime = $DateTimeHelper->format('H:i', $entryToPublish['NewsEntry']['createdOn']);
			
			echo '<div class="unpublished_newsentry" id="'.$id.'">';
				echo '<div class="newsentry_publish_container">';
					echo '<div class="newsentry_publish_title">'.$title.'</div>';
					if($subtitle != null & $subtitle != ''){
						echo '<div class="newsentry_publish_subtitle">'.$subtitle.'</div>';
					}
					echo '<div class="newsentry_publish_info">by '.$username.' on '.$createdOnDate.' at '.$createdOnTime.'</div>';
					echo '<div class="newsentry_publish_content">'.$text.'</div>';
				echo '</div>';
				echo '<div class="newsentry_publish_buttons">';
					echo $this->Html->link(
						$this->Html->image('check.png', array('class' => 'newsentry_publish_icon', 'alt' => 'Publish')),
						array('plugin' => 'Newsblog', 'controller' => 'NewsEntries', 'action' => 'publish', $contentId, $id),
						array('class' => 'newsentry_publish_link', 'escape' => false)
					);
					echo $this->Html->link(
					$this->Html->image('delete.png', array('class' => 'newsentry_delete_button_icon', 'alt' => 'Delete')),
					array('plugin' => 'Newsblog', 'controller' => 'NewsEntries', 'action' => 'delete', $id),
					array('escape' => false),
					__d('newsblog', 'Would you really like to delete this entry?')
					);
				echo '</div>';
			echo '<hr></div>';
		endforeach;
	} else{
		echo __d('newsblog', 'No entries to publish!');
	}
	echo '</div>';
}
?>