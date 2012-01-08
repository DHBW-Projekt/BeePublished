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
	echo $this->element('MenuLinks', array('data' => $data));
?>
	
	<?php
//		if(isset($data)) {
////			$this->element('ShowCategories', $categories);
//			if(array_key_exists('FoodMenuCategory', $data['FoodMenuMenu'])) {
//				$categories = $data['FoodMenuMenu']['FoodMenuCategory'];
//				echo '<ul id="FoodMenuMenu">';
//				foreach ($categories as $category) { 
//					if ( $category['FoodMenuCategory']['deleted'] == NULL ) continue;
//					else {
//						echo '<li>'.$this->Html->link($category['FoodMenuCategory']['name'], array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'showEntries', $category['FoodMenuCategory']['name'], $menu['FoodMenuCategory']['id'])).'</li>';	
//					}	
//				echo '</ul><br />';
//				}
//			}
//		}
//	if (isset($categories)) {
//		debug($categories,$showHtml=false, $showFrom=true);
//		if(array_key_exists('Category', $categories)) {
//			echo '<ul id="FoodMenuMenu">';
//			foreach ($categories as $category) {
//				if ( $category['Category']['deleted'] != NULL ) continue;
//				else {
//					echo '<li>'.$this->Html->link($category['Category']['name'], array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'showEntries', $category['Category']['name'], $menu['Category']['id'])).'</li>';	
//			}
//				
//			}
//			echo '</ul>';
		//}
//	}
		
//		if(array_key_exists('FoodMenuCategory', $data)) {
//			echo '<ul id="FoodMenuMenu">';
//			$categoryItems = $data['FoodMenuCategory'];
//			foreach ($categoryItems as $dataItem){
//			if ( $dataItem['FoodMenuCategory']['deleted'] != NULL ) continue;
//			else {
//			$menu = $dataItem;
//			echo '<li>'.$this->Html->link($menu['FoodMenuCategory']['name'], array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'showEntries', $menu['FoodMenuCategory']['name']), array()).'</li>'; //$menu['FoodMenuMenu']['name']).' ';					
//			}
//			}
//		}	
//		if(array_key_exists('FoodMenuEntry', $data)) {
//			$entryItems = $data['FoodMenuEntry'];
//		}			

?>
</div>