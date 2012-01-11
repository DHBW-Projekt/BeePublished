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
	if (isset($data['show'])) {
		//debug($data['show']);
		if(array_key_exists('FoodMenuMenu', $data['show'])) {
			echo '<div id="foodMenuMenu" style="width:100%;">';
			echo '<ul class="FoodMenuMenu">';
			$menuItems = $data['show']['FoodMenuMenu'];
			foreach ($menuItems as $dataItem){
				if ( $dataItem['deleted'] != NULL ) continue;
				else {
					$menu = $dataItem;
					echo '<li>'.$this->Html->link($menu['name'], $url . '/view/menu/' .  $menu['name'] . '/' . $menu['id']).'</li>';	
				}//else
			}//foreach
			echo '</ul>';
			echo '</div>';			
		}//if
		if(array_key_exists('FoodMenuMenu', $data['show'])) {
			echo '<div id="foodMenuCategory">';
			if(array_key_exists('SelectedMenu', $data['show'])) {
				echo '<h2>' . $data['show']['SelectedMenu']['name'] . '</h2>';
				echo '<ul class="FoodMenuMenu">';
				$categoryItems = $data['show']['FoodMenuCategory'];
				foreach ($categoryItems as $dataItem){
					if ( $dataItem['deleted'] != NULL ) continue;
					else {
						$category = $dataItem;
						echo '<li>'.$this->Html->link($category['name'], $url . '/view/menu/' . $data['show']['SelectedMenu']['name'] . '/' . $data['show']['SelectedMenu']['id'] . '/category/' .  $category['name'] . '/' . $category['id']).'</li>';	
					}//else
				}//foreach
				echo '</ul>';
			}//if
			echo '</div>';

		}//if
	}//if
?>
	
</div>