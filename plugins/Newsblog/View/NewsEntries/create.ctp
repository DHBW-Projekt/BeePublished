<?php 
$this->Html->script('/ckeditor/ckeditor', array('inline' => false));
$this->Html->script('/ckeditor/adapters/jquery', array('inline' => false));
$this->Html->script('/newsblog/js/admin_write', false);
$this->Html->css('/newsblog/css/admin', null, array('inline' => false));

$DateTimeHelper = $this->Helpers->load('Time');

echo $this->element('admin_menu',array('plugin' => 'Newsblog'), array('contentId' => $contentId));
$this->Js->set('webroot', $webroot);
$writeAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Write');

if($writeAllowed){
	echo '<div id="admin_newsblog-write">';
	echo '<div class="writeNewsContainer">';
	
		//create form
		echo $this->Form->create('NewsEntry', array('url' => array('plugin' => 'Newsblog', 'controller' => 'NewsEntries', 'action' => 'create')));
		//create title input
		echo $this->Form->input('NewsEntry.title', array(
			'div' => 'writeNewsTitle',
			'label' => 'Title:',
			'name' => 'title'
		));
		//create subtitle input
		echo $this->Form->input('NewsEntry.subtitle', array(
			'div' => 'writeNewsSubtitle',
			'label' => 'Subtitle:',
			'name' => 'subtitle'
		));
		//create entrytext textarea
		echo $this->Form->input('NewsEntry.text', array(
			'div' => 'writeNewsBody',
			'label' => false,
			'id' => 'writeNewsTextEditor',
			'name' => 'text'
		));
		//create validFrom input
		echo $this->Form->text(null, array(
			'div' => 'writeValidConfiguration',
			'id' => 'nbValidFromDatepicker',
			'label' => 'Valid from:',
			'name' => 'validFromUI',
			'class' => 'datepicker',
			'disabled' => true
		));
		//create validTo input
		echo $this->Form->text(null, array(
			'div' => 'writeValidConfiguration',
			'id' => 'nbValidToDatepicker',
			'label' => 'Valid to:',
			'name' => 'validToUI',
			'class' => 'datepicker',
			'disabled' => true
			
		));
		//hidden fields
		echo $this->Form->hidden(null,array(
			'id' => 'validFromDB',
			'name' => 'validFrom'
		));
		echo $this->Form->hidden(null,array(
			'id' => 'validToDB',
			'name' => 'validTo'
		));
		
		//contentid
		echo $this->Form->hidden(null,array(
			'name' => 'contentId',
			'value' => $contentId
		));
		//action set to editNews
		echo $this->Form->hidden(null,array(
			'name' => 'action',
			'value' => 'createNews'
		));
		
		//create submit button
		echo $this->Form->button("Create News");
		
	echo '</div>';
	echo '</div>';
}
?>