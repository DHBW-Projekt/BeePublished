<?php
	//LOAD menu
	echo $this->element('admin_menu', array('contentID' => $contentID));
?>

<?php echo $this->Form->create('ContentValues', array('url' => array('controller' => 'WebShop', 'action' => 'setContentValues', $contentID))); ?>
<?php echo $this->Form->input('NumberOfEntries', array('label' => (__d("web_shop", 'Number of Products').':'))); ?>
<?php echo $this->Form->end(__d("web_shop", 'Save')); ?>