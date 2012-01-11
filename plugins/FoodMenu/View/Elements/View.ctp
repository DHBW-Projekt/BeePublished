<?php 
    echo $this->Html->script('/food_menu/js/foodmenu', false);
    echo $this->Html->css('/food_menu/css/menu'); 
?>
<?php 
	$user = $this->Session->read('Auth.User');
?>
<div id="foodMenuMain" style="width:100%; height:450px">
<?php
	echo $this->Session->flash();
	
	echo $this->element('SelectDate');
	if(!(isset($categories))) $categories = '';
	if(!(isset($entries))) $entries = '';
	
	/* initial call, $data is set by component */
	if (isset($data)) {
		echo '<div id="foodMenuMenu" style="width:100%; height:30px">';
		echo '<ul id="FoodMenuMenu">';
		if(array_key_exists('FoodMenuMenu', $data)) {
			$menuItems = $data['FoodMenuMenu'];
			foreach ($menuItems as $dataItem){
				if ( $dataItem['FoodMenuMenu']['deleted'] != NULL ) continue;
				else {
					$menu = $dataItem;
					echo '<li>'.$this->Html->link($menu['FoodMenuMenu']['name'], $url . '/view/menu/' .  $menu['FoodMenuMenu']['name'] . '/' . $menu['FoodMenuMenu']['id']).'</li>';	
				}//else
			}//foreach
		}//if
		echo '</ul>';
		echo '</div>';
	}//if
	
	/* showCategories method in FoodmenuApp Controller has been called */
//	elseif(isset($menus)) {
//		echo '<div id="foodMenuMenu" style="width:100%; height:30px">';
//		echo '<ul id="FoodMenuMenu">';
//		if(array_key_exists('FoodMenuMenu', $menus)) {
//			$menuItems = $menus['FoodMenuMenu'];
//			foreach ($menuItems as $dataItem){
//				if ( $dataItem['FoodMenuMenu']['deleted'] != NULL ) continue;
//				else {
//					$menu = $dataItem;
//					echo '<li>'.$this->Html->link($menu['FoodMenuMenu']['name'], array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'showCategories', $menu['FoodMenuMenu']['name'], $menu['FoodMenuMenu']['id'])).'</li>';	
//				}//else
//			}//foreach
//		}//if
//		echo '</ul>';
//		echo '</div>';
//	}
?>
	
</div>