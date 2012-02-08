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
* @description View to edit a certain news entry
*/

	App::uses('Sanitize', 'Utility');
	$newsentry = Sanitize::clean($newsentry, array('unicode' => true, 'encode' => false, 'remove_html' => true));
	$this->Html->css('/css/jqueryui/jquery-ui-1.8.17.custom', null, array('inline' => false));
	$this->Html->css('/css/jqueryui/jquery-ui-timepicker-addon.css', null, array('inline' => false));
	$this->Html->css('/newsblog/css/editNews', null, array('inline' => false));
	$this->Html->script('jquery/jquery-ui-timepicker-addon', array('inline' => false));
	$this->Html->script('/newsblog/js/editNews', array('inline' => false));
	$this->Html->script('ckeditor/ckeditor', array('inline' => false));
	$this->Html->script('ckeditor/adapters/jquery', array('inline' => false));
	
	//get configured date format
	//split valid from
	$validFrom = $newsentry['NewsEntry']['validFrom'];
	//split valid to
	$validTo = $newsentry['NewsEntry']['validTo'];
	
	$this->Js->set('webroot', $this->request->webroot);
	$this->Js->set('validFromAltText', __d('newsblog','Choose Valid From'));
	$this->Js->set('validToAltText', __d('newsblog','Choose Valid To'));
	
	$dateFormat = __('m-d-Y');
	$this->Js->set('dateFormatForPicker', $dateFormat);
?>
<div class="nbEntryContainer">
	<?php 
	//create form
	echo $this->Form->create('NewsEntry', array('url' => array('plugin' => 'Newsblog', 'controller' => 'NewsEntries', 'action' => 'edit')));
	//hidden fields
	echo $this->Form->hidden(null,array(
			'id' => 'validFromDB',
			'name' => 'validFrom'
	));
	echo $this->Form->hidden(null,array(
			'id' => 'validToDB',
			'name' => 'validTo'
	));
	//newsEntryId
	echo $this->Form->hidden(null,array(
			'name' => 'id',
			'value' => $newsentry['NewsEntry']['id']
	));
	
	//create title input
	echo $this->Form->input('NewsEntry.title', array(
		//'div' => 'editNewsTitle',
		'label' => __d('newsblog','Title:'),
		'name' => 'title',
		'value'=> $newsentry['NewsEntry']['title']
	));
	//create subtitle input
	echo $this->Form->input('NewsEntry.subtitle', array(
		//'div' => 'writeNewsSubtitle',
		'label' => __d('newsblog', 'Subtitle:'),
		'name' => 'subtitle',
		'value'=> $newsentry['NewsEntry']['subtitle']
	));
	//create entrytext textarea
	echo $this->Form->input('NewsEntry.text', array(
		//'div' => 'editNewsBody',
		'label' => false,
		'id' => 'editNewsTextEditor',
		'name' => 'text',
		'value' => $newsentry['NewsEntry']['text']
	));
	//create validFrom input
	$validFrom = $newsentry['NewsEntry']['validFrom'];
	$validFrom =  substr($validFrom, 0, strlen($validFrom)-3);
	echo $this->Form->input('NewsEntry.validFrom', array(
		'div' => 'editNewsValidConfig',
		'type' => 'text',
		'id' => 'nbValidFromDatepicker',
		'name' => 'validFromUI',
		'class' => 'datepicker',
		'label' => __d('newsblog', 'Valid from:'),
		'value'=> $validFrom
	));
	//create validTo input
	$validTo = $newsentry['NewsEntry']['validFrom'];
	$validTo =  substr($validTo, 0, strlen($validTo)-3);
	echo $this->Form->input('NewsEntry.validTo', array(
		'div' => 'editNewsValidConfig',
		'type' => 'text',
		'id' => 'nbValidToDatepicker',
		'name' => 'validToUI',
		'class' => 'datepicker',
		'label' => __d('newsblog', 'Valid to:'),
		'value'=> $validTo
	));
	
	echo $this->Form->end(__d('newsblog', 'Save changes'));
	?>
</div>