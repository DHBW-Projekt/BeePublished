<?php 
App::uses('Sanitize', 'Utility');
$this->Helpers->load('BBCode');
$DateTimeHelper = $this->Helpers->load('Time');
//bin javascript and css
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
				echo '</div>';
			echo '<hr></div>';
		endforeach;
	} else{
		echo __d('newsblog', 'No entries to publish!');
	}
	echo '</div>';
}
?>