<?php 
	$this->Html->css('menu-design', NULL, array('inline' => false));
	$this->Html->css('menu-template', NULL, array('inline' => false));
?>

<div id="menu" class="overlay">
    <ol class="nav">
        <li><?php echo $this->Html->link(__d("web_shop", 'Product Administration'),array('controller' => 'WebShop', 'action' => 'admin', $contentID));?></li>
        <li><?php echo $this->Html->link(__d("web_shop", 'Open Orders'),array('controller' => 'WebShop', 'action' => 'openOrders', $contentID));?></li>
        <li><?php echo $this->Html->link(__d("web_shop", 'Settings'),array('controller' => 'WebShop', 'action' => 'setContentValues', $contentID));?></li>
    </ol>
    <div style="clear:both;"></div>
</div>

