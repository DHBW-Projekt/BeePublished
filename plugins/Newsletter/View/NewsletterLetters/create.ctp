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

$validationErrors = $this->Session->read('Validation.NewsletterLetter.validationErrors');

echo $this->element('admin_menu', array('contentID' => $contentID, 'pluginId' => $pluginId));
echo $this->Session->flash('NewsletterSaved');
if (isset($newsletter)){
	$this->Html->script('ckeditor/ckeditor', false);;
	$this->Html->script('ckeditor/adapters/jquery',false);
	$this->Html->script('/newsletter/js/admin',false);
	echo $this->Form->create('editor', array(
		'url' => array(
			'plugin' => 'Newsletter',
    		'controller' => 'NewsletterLetters',
    		'action' => 'saveNew', $contentID, $pluginId)));
	echo $this->Form->input('NewsletterLetter.subject', array(
		'label' => __d('newsletter','Subject:')));
	if (isset($validationErrors['subject'][0])){
		echo $this->Html->div('validation_error',$validationErrors['subject'][0]);
	};
	echo $this->Form->textarea('NewsletterLetter.contentEdit', array(
		'label' => '', 
		'rows' => '30',
		'value' => $newsletter['content']));
	echo $this->Form->submit(__d('newsletter','Save'));
	echo $this->Form->end();
}