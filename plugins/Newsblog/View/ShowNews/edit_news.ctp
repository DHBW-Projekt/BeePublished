<?php 
	$this->Html->css('/newsblog/css/editNews', null, array('inline' => false));
	$this->Html->script('/newsblog/js/editNews', array('inline' => false));
	$this->Html->script('/ckeditor/ckeditor', array('inline' => false));
	$this->Html->script('/ckeditor/adapters/jquery', array('inline' => false));
	
	//get configured date format
	//split valid from
	$validFrom = $newsentry['NewsEntry']['validFrom'];
	$validFromPieces = explode("-", $validFrom);
	$validFromYear = $validFromPieces[0];
	$validFromMonth = $validFromPieces[1];
	$validFromDay = $validFromPieces[2];
	//split valid to
	$validTo = $newsentry['NewsEntry']['validTo'];
	$validToPieces = explode("-", $validTo);
	$validToYear = $validToPieces[0];
	$validToMonth = $validToPieces[1];
	$validToDay = $validToPieces[2];
	
	$this->Js->set('newsentryid', $newsentry['NewsEntry']['id']);
	$this->Js->set('contentid', $newsentry['NewsEntry']['content_id']);
?>
<div class="nbEntryContainer">
	<?php 
	//create form
	echo $this->Form->create('NewsEntry', array('url' => array('plugin' => 'Newsblog', 'controller' => 'ShowNews', 'action' => 'saveNewsData')));
	//create title input
	echo $this->Form->input('NewsEntry.title', array(
		'div' => 'editNewsTitle',
		'label' => false,
		'name' => 'title',
		'value'=> $newsentry['NewsEntry']['title']
	));
	//create entrytext textarea
	echo $this->Form->textarea('NewsEntry.text', array(
		'div' => 'editNewsBody',
		'label' => false,
		'id' => 'editNewsTextEditor',
		'name' => 'text',
		'value' => $newsentry['NewsEntry']['text']
	));
	//create validFrom input
	echo $this->Form->text(null, array(
		'div' => 'editNewsValidConfig',
		'id' => 'nbValidFromDatepicker',
		'name' => 'validFrom',
		'class' => 'datepicker',
		'label' => 'Valid from:',
		'value'=> $newsentry['NewsEntry']['validFrom']
	));
	//create validTo input
	echo $this->Form->text(null, array(
		'div' => 'editNewsValidConfig',
		'id' => 'nbValidToDatepicker',
		'name' => 'validTo',
		'class' => 'datepicker',
		'label' => 'Valid to:',
		'value'=> $newsentry['NewsEntry']['validTo']
	));
	//hidden fields
	//contentid
	echo $this->Form->hidden(null,array(
		'name' => 'contentId',
		'value' => $newsentry['NewsEntry']['content_id']
	));
	//action set to editNews
	echo $this->Form->hidden(null,array(
		'name' => 'action',
		'value' => 'editNews'
	));
	//newsEntryId
	echo $this->Form->hidden(null,array(
		'name' => 'id',
		'value' => $newsentry['NewsEntry']['id']
	));
	
	//create submit button
	echo $this->Form->submit("Save Changes", array(
		'div' => 'editNewsButtons',
		'class' => 'button'
	));
	?>
</div>