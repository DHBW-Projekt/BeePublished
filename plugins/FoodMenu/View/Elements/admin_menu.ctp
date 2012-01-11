<?php $this->Html->css('menu-design', NULL, array('inline' => false));?> 

<?php $this->Html->css('menu-template', NULL, array('inline' => false));?> 

<?php $this->Html->css('/food_menu/css/menu', NULL, array('inline' => false)); ?>
<div id="menu" class="overlay"> 

    <ol class="nav"> 

		<li><?php echo $this->Html->link((__('Menus')), array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuMenu', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link((__('Categories')), array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuCategory', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link((__('Entries')), array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuEntry', 'action' => 'index')); ?></li>
	

    </ol> 

    <div style="clear:both;"></div> 

</div>