<?php
debug($available_pictures);
echo "<table>";
echo "<tr> <td> Id </td> <td> Title </td> </tr>";

foreach ($data['gallery_pictures'] as $picture){
	echo "<tr>";
	echo "<td>".$picture['id']."</td>";
	echo "<td>".$picture['title']."</td>";
	echo "<td>";
	echo $this->Html->link($this->Html->image("check.png", array('width' => '32px')),array('action' => 'setImage', $data['ContentId'], $picture['id']),array('escape' => False));
	echo "</td>";
	echo "</tr>";
}
echo "</table>";

?>