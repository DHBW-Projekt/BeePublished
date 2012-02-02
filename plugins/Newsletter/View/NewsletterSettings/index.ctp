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

$this->Html->script('/ckeditor/ckeditor', false);
$this->Html->script('/ckeditor/adapters/jquery',false);
$this->Html->script('/newsletter/js/admin',false);
echo $this->Html->css('/newsletter/css/newsletter', NULL, array('inline' => false));

// show admin menu
echo $this->element('admin_menu', array('contentID' => $contentID, 'pluginId' => $pluginId));

echo '<h1>'.__d('newsletter','Information text on subscription view:').'</h1>';
// flash position here	
echo $this->Session->flash('TextSaved');
// form for text setting	
echo $this->Form->create('PluginText', array(
	'url' => array(
		'plugin' => 'Newsletter',
		'controller' => 'NewsletterSettings',
		'action' => 'save', $contentID, $pluginId)));

echo $this->Form->textarea('Text', array(
	'label' => 'Text:',
	'type' => 'text',
	'name' => 'text',
	'value' => $pluginText['text']));
echo $this->Form->submit(__d('newsletter','Save'));
echo $this->Form->end();