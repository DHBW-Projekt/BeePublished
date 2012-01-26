<?php 
echo $this->element('admin_menu_images',array("ContentId" => $data['ContentId']));

echo $this->Session->flash('Image assigned');


echo '<table>';
	echo '<thead>';
		echo '<tr>';
			echo '<th>'.__('Id').'</th>';
			echo '<th>'.__('Title').'</th>';
			echo '<th></th>';
		echo '</tr>';
	echo '</thead>';
	echo '<tbody>';

foreach ($data['AllPictures'] as $picture){
	echo "<tr>";
	echo "<td>".$picture['id']."</td>";
	echo '<td>'.$picture['title']."</td>";
	echo "<td>";
	echo $this->Html->link($this->Html->image("test-pass-icon.png", array('width' => '20px')),array('action' => 'setImage', $data['ContentId'], $picture['id']),array('escape' => False));
	echo "</td>";
	echo "</tr>";
}
echo "</table>";

//debug($data);

?>