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

// show admin menu
echo $this->element('admin_menu', array('contentID' => $contentID, 'pluginId' => $pluginId));

// show newsletter
if (isset($newsletter)){
	$this->Html->script('ckeditor/ckeditor', false);;
	$this->Html->script('ckeditor/adapters/jquery',false);
	$this->Html->script('/newsletter/js/admin',false);
	echo $this->Session->flash('NewsletterSent');
	echo $this->Form->create('preview', array(
		'url' => array(
			'plugin' => 'Newsletter',
			'controller' => 'NewsletterLetters',
			'action' => 'sendOrEdit', $contentID, $pluginId, $newsletter['NewsletterLetter']['id'])));
	echo $this->Form->input('NewsletterLetter.subject', array(
		'label' => __d('newsletter','Subject:'), 
		'value' => $newsletter['NewsletterLetter']['subject'],
		'readonly' => 'readonly'));
	echo $this->Form->textarea('NewsletterLetter.contentPreview', array(
		'label' => '', 
		'value' => $newsletter['NewsletterLetter']['content'],
		'rows' => '30'));
	if ($newsletter['NewsletterLetter']['draft'] == 1){
		// if newsletter is a draft show send and edit buttons
		echo $this->Form->submit(__d('newsletter','Send'), array(
			'name' => 'send',
			'div' => false));
		echo $this->Form->submit(__d('newsletter','Edit'), array(
			'name' => 'edit',
			'div' => false));
	} else {
		// if newsletter is already sent, show date of sending
		echo __d('newsletter','This newsletter has been sent on ').$newsletter['NewsletterLetter']['date']; 
	};
	echo $this->Form->end();	
};