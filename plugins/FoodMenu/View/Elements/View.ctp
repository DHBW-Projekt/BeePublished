<?php 
//	  echo $this->Html->script('/app/jquery-1.6.2.min');
//      echo $this->Html->script('/app/jquery-ui-1.8.16.custom.min');
//	  $this->Html->css('/css/jquery-ui/jquery-ui-1.8.16.custom'); 
	  echo $this->Html->script('/food_menu/js/foodmenu', false);
?>
<?php 
	$user = $this->Session->read('Auth.User');
?>
<div id="foodMenuMain" style="width:100%; height:450px">
<?php
	echo $this->Session->flash();
	if ( $user['role_id'] >= 3 ) {
	echo $this->Html->link( 
		$this->Html->image('tools.png', array('class' => 'setting_image')), 
		array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'content'), 
		array('escape' => False, 'class' => 'foodmenu-overlay')
	);
	}
	
	echo $this->element('SelectDate');
	//echo $this->element('MenuLinks');
	//echo $this->element('AdminMenus');
	echo $this->element('AdminCategories');
	echo $this->element('AdminEntries');
	echo $this->element('CreateMenu');
	echo $this->element('CreateCategory');
	echo $this->element('CreateEntry');
?>
<div id="foodMenuMenu" style="width:100%; height:30px">
<ul style="float:left">
<?php
	if (isset($data)) {
		if(array_key_exists('FoodMenuMenu', $data)) {
			$menuItems = $data['FoodMenuMenu'];
			foreach ($menuItems as $dataItem){
			if ( $dataItem['FoodMenuMenu']['deleted'] != NULL ) continue;
			else {
			$menu = $dataItem;
			echo '<li>'.$this->Html->link($menu['FoodMenuMenu']['name'], array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'showCatergories', $menu['FoodMenuMenu']['name']), array()).'</li>'; //$menu['FoodMenuMenu']['name']).' ';	
			}
			}
		}
		echo '</ul><br />';	
		
		
		if(array_key_exists('FoodMenuCategory', $data)) {
			echo '<ul style="float:left; list-style-type: none">';
			$categoryItems = $data['FoodMenuCategory'];
			foreach ($categoryItems as $dataItem){
			if ( $dataItem['FoodMenuCategory']['deleted'] != NULL ) continue;
			else {
			$menu = $dataItem;
			echo '<li>'.$this->Html->link($menu['FoodMenuCategory']['name'], array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'showEntries', $menu['FoodMenuCategory']['name']), array()).'</li>'; //$menu['FoodMenuMenu']['name']).' ';					
			}
			}
		}	
		if(array_key_exists('FoodMenuEntry', $data)) {
			$entryItems = $data['FoodMenuEntry'];
		}			

	}
?>
</ul>
</div>
</div>