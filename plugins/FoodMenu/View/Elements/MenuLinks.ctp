<div id="foodMenuMenu" style="width:100%; height:30px">
<ul>
<?php
	if (isset($data)) {
		echo $data;
		foreach ($data as $menu){
			echo $menu;
			echo '<li>'.$menu['Name']['Name'].'</li>';
		}
	}
?>
</ul>
</div>