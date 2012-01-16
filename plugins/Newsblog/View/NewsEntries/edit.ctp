<?php 
	$this->Html->css('/newsblog/css/editNews', null, array('inline' => false));
	$this->Html->script('/newsblog/js/editNews', array('inline' => false));
	$this->Html->script('/ckeditor/ckeditor', array('inline' => false));
	$this->Html->script('/ckeditor/adapters/jquery', array('inline' => false));
	
	//get configured date format
	//split valid from
	$validFrom = $newsentry['NewsEntry']['validFrom'];
	//split valid to
	$validTo = $newsentry['NewsEntry']['validTo'];
	
	$this->Js->set('webroot', $this->request->webroot);
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
	
	//create title input
	echo $this->Form->input('NewsEntry.title', array(
		//'div' => 'editNewsTitle',
		'label' => 'Title:',
		'name' => 'title',
		'value'=> $newsentry['NewsEntry']['title']
	));
	//create subtitle input
	echo $this->Form->input('NewsEntry.subtitle', array(
		//'div' => 'writeNewsSubtitle',
		'label' => 'Subtitle:',
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
	echo $this->Form->input(null, array(
		//'div' => 'editNewsValidConfig',
		'type' => 'text',
		'id' => 'nbValidFromDatepicker',
		'name' => 'validFromUI',
		'class' => 'datepicker',
		'label' => 'Valid from:',
		'value'=> $newsentry['NewsEntry']['validFrom']
	));
	//create validTo input
	echo $this->Form->input(null, array(
		//'div' => 'editNewsValidConfig',
		'type' => 'text',
		'id' => 'nbValidToDatepicker',
		'name' => 'validToUI',
		'class' => 'datepicker',
		'label' => 'Valid to:',
		'value'=> $newsentry['NewsEntry']['validTo']
	));
	
	echo $this->Form->end("Save changes");
	?>
</div>