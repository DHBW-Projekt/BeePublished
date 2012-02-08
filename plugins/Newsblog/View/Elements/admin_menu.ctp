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
* @description View element for the admin overlay's menu
* displayed entries are based on the user's role
*/

$this->Html->css('menu-design', NULL, array('inline' => false));
$this->Html->css('menu-template', NULL, array('inline' => false));

$writeAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Write');
$publishAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Publish');
?>
<div id="menu" class="overlay">
    <ol class="nav">
    <li><?php echo $this->Html->link(__d('newsblog', 'General'),array('controller' => 'ShowNews', 'action' => 'general', $contentId))?></li>
        <?php 
        if($writeAllowed){
        	echo '<li>'.$this->Html->link(__d('newsblog', 'Write News'),array('controller' => 'NewsEntries', 'action' => 'create', $contentId)).'</li>';
        }
        if($publishAllowed){
        	echo '<li>'.$this->Html->link(__d('newsblog', 'Publish News'),array('controller' => 'NewsEntries', 'action' => 'publish', $contentId)).'</li>';
        }
        ?>
    </ol>
    <div style="clear:both;"></div>
</div>

