<div id="foodMenuMenu" style="width:100%; height:30px">
	<ul id="FoodMenuMenu">
	<?php
		if (isset($data)) {
			if(array_key_exists('FoodMenuMenu', $data)) {
				$menuItems = $data['FoodMenuMenu'];
				foreach ($menuItems as $dataItem){
					if ( $dataItem['FoodMenuMenu']['deleted'] != NULL ) continue;
					else {
						$menu = $dataItem;
						echo '<li>'.$this->Html->link($menu['FoodMenuMenu']['name'], array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'showCategories', $menu['FoodMenuMenu']['name'], $menu['FoodMenuMenu']['id'])).'</li>';	
					}//else
				}//foreach
				foreach ($menuItems as $menuItem) {
					if (!(array_key_exists('FoodMenuCategory', $menuItem))) continue;
					$categories = $menuItem['FoodMenuCategory'];
					foreach ($categories as $category) {
 						echo '<ul id="FoodMenuMenu">';
							if ( $category['deleted'] == NULL ) continue;
							else {
								echo '<li>'.$this->Html->link($category['name'], array('plugin' => 'FoodMenu', 'controller' => 'FoodMenuApp', 'action' => 'showEntries', $category['name'], $category['id'])).'</li>';	
							}//else	
						echo '</ul><br />';
					}//foreach
				}//foreach
			}//if
		}//if
	?>
	</ul><br />
</div>