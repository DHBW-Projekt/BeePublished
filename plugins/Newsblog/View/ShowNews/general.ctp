<?php 
	$publishAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'Publish');
	
	echo $this->element('admin_menu',array('plugin' => 'Newsblog'), array('contentId' => $contentId));

	//create form
	echo $this->Form->create(null, array('url' => array('plugin' => 'Newsblog', 'controller' => 'ShowNews', 'action' => 'general')));
	
	if($publishAllowed){
		//create newsblog title input
		echo $this->Form->input(null, array(
				'label' => __d('newsblog', 'Title for Newsblog:'),
				'name' => 'newsblogTitle',
				'value' => $newsblogTitle
		));
	}
	
	//get current 
	echo $this->Form->input(null, array(
		'options' => array(10 => 10, 15 => 15, 20 => 20, 25 => 25),
		'name' => 'itemsPerPage',
		'empty' => '(choose one)',
		'label' => __d('newsblog', 'Items per page:'),
		'default' => 10,
		'value' => $itemsPerPage
	));
	
	echo $this->Form->input(null, array(
		'options' => array(150 => 150, 200 => 200, 250 => 250, 300 => 300, 350 => 350),
		'name' => 'previewTextLength',
		'empty' => '(choose one)',
		'label' => __d('newsblog', 'Preview text length:'),
		'default' => 150,
		'value' => $shorttextLength
	));
	
	//contentid
	echo $this->Form->hidden(null,array(
		'name' => 'contentId',
		'value' => $contentId
	));
	
	//create submit button
	echo $this->Form->end(__d('newsblog', 'Save Configuration'));
?>