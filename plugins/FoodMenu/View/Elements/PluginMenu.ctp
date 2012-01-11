<?php
?>
<div id="pluginMenu">
	<ul id="menu">
		<li><?php echo $this->Html->link((__('Menus')), array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'viewMenus')); ?></li>
		<li><?php echo $this->Html->link((__('Categories')), array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'viewCategories')); ?></li>
		<li><?php echo $this->Html->link((__('Entries')), array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'viewEntries')); ?></li>
	</ul>
</div>