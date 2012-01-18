<?php $this->Html->css('menu-design', NULL, array('inline' => false));?> 

<?php $this->Html->css('menu-template', NULL, array('inline' => false));?> 

<?php $this->Html->css('/food_menu/css/menu', NULL, array('inline' => false)); ?>

<?php $this->Html->script('/food_menu/js/confirmbox', array('inline' => false)); ?>
<?php
	$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create');
	$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit');
	$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete');
?>
<div id="menu" class="overlay"> 

    <ol class="nav"> 

		<li><?php echo $this->Html->link((__('Menus')), array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenus', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link((__('Categories')), array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategories', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link((__('Entries')), array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntries', 'action' => 'index')); ?></li>
	

    </ol> 

    <div style="clear:both;"></div> 

</div>