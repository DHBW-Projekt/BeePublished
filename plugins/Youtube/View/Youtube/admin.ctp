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
* @author Sebastian Haase
*
* @description element displayed as default page in admin overlay
* 			   if a video link is already present - show it / else just provide form to save a link 
*/
$this->Html->css('/Youtube/css/template',null,array('inline' => false));

$input = $this->Session->read('Validation.YoutubeLink.data');
$errors = $this->Session->read('Validation.YoutubeLink.validationErrors')
?>

<?php echo $this->element('adminMenu', array('contentId' => $contentId), array('plugin' => 'Youtube'));?>

<?php echo $this->Session->flash('Youtube.Admin');?>

<div id="youtube_settings">
<p><?php echo __d('youtube', 'In order for this plugin to work correctly, go to youtube, select the video and copy the link provided at the top of your browser.');?></p>
<br/>
<?php 
if (!empty($currentLink)){
	echo '<p>' . __d('youtube', 'The current video has the following url: ') . $this->Html->link($currentLink, $currentLink, array('target' => '_blank')) . '</p>';
	echo '<p>' . __d('youtube', 'You can change the used url by saving a new one.') . '</p>';
	echo '<br/>';
}

// begin of form
echo $this->Form->create('YoutubeLink', array('url' => array('plugin' => 'Youtube',
															   'controller' => 'Youtube',
															   'action' => 'admin',
																$contentId)));
// check whether a value is already present or an error had occured
if (($input != NULL) && array_key_exists('url', $input['YoutubeLink'])){
	echo $this->Form->input('YoutubeLink.url', array('type' => 'text', 'label' => 'URL:', 'value' => $input['YoutubeLink']['url']));
} else {
	echo $this->Form->input('YoutubeLink.url', array('type' => 'text', 'label' => 'URL:'));
}
if (($errors != NULL) && array_key_exists('url', $errors) && array_key_exists('0', $errors['url'])){
	echo $this->Html->div('validation_error',$errors['url']['0']);
}
// end of form
echo $this->Form->end(__d('youtube', 'Save'));
?>
</div>