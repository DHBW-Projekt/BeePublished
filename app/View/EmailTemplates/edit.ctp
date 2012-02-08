<?php
/**
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
 * @author Tobias Höhmann
 * 
 * @description email template edit view
 */
	echo $this->element('config-menu');
	
	$this->Html->script('ckeditor/ckeditor', false);;
	$this->Html->script('ckeditor/adapters/jquery',false);
	$this->Html->script('/js/admin/emailtemplate',false);
	// create form for editing the current email template
	echo $this->Form->create('EmailTemplate', array(
		'url' => array(
    	'controller' => 'EmailTemplates',
    	'action' => 'save' , $selectedTemplate['EmailTemplate']['id'])));
	echo $this->Form->hidden('id', array('value' => $selectedTemplate['EmailTemplate']['id']));
	echo $this->Form->input('name', array(
		'label' => 'Name', 
		'value' => $selectedTemplate['EmailTemplate']['name']));
	// ckeditor textarea
	echo $this->Form->textarea('content', array(
		'label' => '', 
		'value' => $selectedTemplate['EmailTemplate']['content'],
		'rows' => '30'));
	echo $this->Form->end('Save');
?>