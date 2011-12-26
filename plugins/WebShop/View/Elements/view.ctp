<?php 
	echo $this->element('SearchBar');
	
	echo '<h1>'.$data['Product']['name'].'</h1>';
	echo $this->Html->image('/WebShop/img/'.$data['Product']['picture'], array('style' => "float: left", "width" => "200px"));
	echo $data['Product']['description'];
	echo $this->Html->image('/WebShop/img/Cart-Add-32.png', array('url' => array('plugin' => 'web_shop', 'controller' => 'WebShop', 'action' => 'add', $data['Product']['id'])));