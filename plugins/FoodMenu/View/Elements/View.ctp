<?php 
    //$this->Html->script('/food_menu/js/foodmenu', false);
    $this->Html->css('/food_menu/css/menu', NULL, array('inline' => false)); 
?>
<?php 
	$user = $this->Session->read('Auth.User');
?>
<div id="foodMenuMain">
<?php
	echo $this->Session->flash();
	if(!(isset($url))) $url = '';
	echo $this->element('SelectDate', array('url' => $url, 'selectedDate' => $selectedDate));
	
	if(!(isset($categories))) $categories = '';
	if(!(isset($entries))) $entries = '';
	
	/* initial call, $data is set by component */
	if (isset($data['show'])) {
		if(array_key_exists('FoodMenuMenu', $data['show'])) {
			
			if (array_key_exists('SelectedMenu', $data['show'])) {
				$selectedMenuId = $data['show']['SelectedMenu']['id'];
			} else {$selectedMenuId = -1;}
			echo '<div id="foodMenuMenu">';
			echo '<ul class="FoodMenuMenu">';
			$menuItems = $data['show']['FoodMenuMenu'];
			foreach ($menuItems as $dataItem){
				if ( $dataItem['deleted'] != NULL ) continue;
				else {
					$menu = $dataItem;
					if ($menu['id'] == $selectedMenuId) {
						echo '<li><strong>'.$this->Html->link($menu['name'], $url . '/view/menu/' .  $menu['name'] . '/' . $menu['id'] . '/' . $selectedDate).'</strong></li>';	;
					} else {
						echo '<li>'.$this->Html->link($menu['name'], $url . '/view/menu/' .  $menu['name'] . '/' . $menu['id'] . '/' . $selectedDate).'</li>';	
					}
				}//else
			}//foreach
			echo '</ul>';
			echo '</div>';			
		}//if
		if(array_key_exists('FoodMenuCategory', $data['show']) && isset($data['show']['FoodMenuCategory'][0])) {
			echo '<div id="foodMenuCategory">';
				if (array_key_exists('SelectedCategory', $data['show'])) {
					$selectedCategoryId = $data['show']['SelectedCategory']['id'];
				} else { $selectedCategoryId = -1; }
				echo '<h2>' . $data['show']['SelectedMenu']['name'] . '</h2>';
				echo '<ul class="FoodMenuMenu">';
				$categoryItems = $data['show']['FoodMenuCategory'];
				foreach ($categoryItems as $dataItem){
					if ( $dataItem['deleted'] != NULL ) continue;
					else {
						$category = $dataItem;
						if ($category['id'] == $selectedCategoryId) {
							echo '<li><strong>'.$this->Html->link($category['name'], $url . '/view/menu/' . $data['show']['SelectedMenu']['name'] . '/' . $data['show']['SelectedMenu']['id'] . '/category/' .  $category['name'] . '/' . $category['id'] . '/' . $selectedDate).'</strong></li>';	
						} else {
							echo '<li>'.$this->Html->link($category['name'], $url . '/view/menu/' . $data['show']['SelectedMenu']['name'] . '/' . $data['show']['SelectedMenu']['id'] . '/category/' .  $category['name'] . '/' . $category['id'] . '/' . $selectedDate).'</li>';
						}
					}//else
				}//foreach
				echo '</ul>';
			echo '</div>';
			}//if
		if(array_key_exists('FoodMenuEntry', $data['show'])  && isset($data['show']['FoodMenuEntry'][0])) {
			echo '<div id="foodMenuEntry">';
			if(array_key_exists('SelectedCategory', $data['show'])) {
				?>
				<table id="userMenuEntries" class="viewEntries">
				<thead>
				<tr>
					<th><?php echo $data['show']['SelectedCategory']['name']; ?></th>
					<th><?php echo (__d('food_menu', 'Price')); ?>
				</tr>
				</thead>
				<tbody>
				<?php
				$entryItems = $data['show']['FoodMenuEntry'];
				foreach ($entryItems as $dataItem){
					if ( $dataItem['deleted'] != NULL ) continue;
					else {
						echo '<tr>';
						$entry = $dataItem;
						echo '<td class="entryName">' . $entry['name'] . '</td>';
						echo '<td class="entryPrice">' . $this->Number->currency($entry['price'], $entry['currency']) . '</td>';
						if((isset($entry['description'])) && $entry['description'] != '') {
							echo '</tr><tr>';
							echo '<td colspan="2" class="entryDescription">' . $entry['description'] . '</td>';
						}//if
						echo '</tr>';
					}//else
				}//foreach
				echo '</tbody>';
				echo '</table>';				
			}//if
			
			echo '</div>';

		}//if
	}//if
?>
	
</div>