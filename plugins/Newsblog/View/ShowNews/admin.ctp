<?php 
	$this->Html->script('/newsblog/js/admin', false);
	$this->Html->css('/newsblog/css/admin', null, array('inline' => false));$this->Js->set('webroot', $this->request->webroot);
	
	//include menu element
	echo $this->element('admin_menu',array('plugin' => 'Newsblog'), array('contentId' => $contentId));
?>