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
* @copyright 2012 Duale Hochschule Baden-W¸rttemberg Mannheim
* @author Marcus Lieberenz
*
* @description Basic Settings for all controllers
*/

$this->Html->css('menu-design', NULL, array('inline' => false));
$this->Html->css('menu-template', NULL, array('inline' => false));
$settingsAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'ChangeNewsletterSettings');
$recipientsAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'unSubscribeOtherUsers');
?>

<div id="menu" class="overlay">
    <ol class="nav">
        <li><?php echo $this->Html->link(__d('newsletter','Newsletters'),array(
			'plugin' => 'Newsletter', 
        	'controller' => 'NewsletterLetters', 
        	'action' => 'index', $contentID, $pluginId));?></li>
<?php
// only show this menu item if user is allowed to edit recipients list         	
if($recipientsAllowed){
	echo '<li>';
		echo $this->Html->link(__d('newsletter','Recipients'),array(
        	'plugin' => 'Newsletter', 
        	'controller' => 'NewsletterRecipients', 
        	'action' => 'index', $contentID, $pluginId));
       echo '</li>';
};
if($settingsAllowed){
	// only show this menu item if user is allowed to change settings
	echo '<li>';
		echo $this->Html->link(__d('newsletter','General Settings'),array(
        	'plugin' => 'Newsletter', 
        	'controller' => 'NewsletterSettings', 
        	'action' => 'index', $contentID, $pluginId));
	echo '</li>';
};
?>
    </ol>
    <div style="clear:both;"></div>
</div>