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
					echo '<li>'.$this->Html->link($menu['FoodMenuMenu']['name'], array('plugin' => 'FoodMenu', 'controller' => 'View', 'action' => 'showCategories', $menu['FoodMenuMenu']['name'], $menu['FoodMenuMenu']['id'])).'</li>';	
			}
			}
		}
	}
	?>
	</ul><br />
</div>