<?php 
echo $this->element('admin_menu_galleries',array("ContentId" => $data['ContentId']));
$this->Html->css('/gallery/css/galleries', NULL, array('inline' => false));

echo "<h1> ".__('Assign a Gallery')."</h1>";

echo $this->Session->flash();

echo '<div class="galleryinfo">'.__('Please assign a gallery to the view.').'</div>';

echo '<table>';
	echo '<thead>';
		echo '<tr>';
			echo '<th>'.__('Title').'</th>';
			echo '<th>'.__('Description').'</th>';
			echo '<th></th>';
		echo '</tr>';
	echo '</thead>';
	echo '<tbody>';

foreach ($data['AllGalleries'] as $gallery){
	echo '<tr>';
		echo '<td>'.$gallery['GalleryEntry']['title'].'</td>';
		echo '<td style width="30%">'.$gallery['GalleryEntry']['description'].'</td>';
		echo '<td>';
			echo $this->Html->link($this->Html->image("test-pass-icon.png", array('width' => '20px')),array('action' => 'setGallery', $data['ContentId'], $gallery['GalleryEntry']['id']),array('escape' => False));
		echo '</td>';
	echo '</tr>';
}
echo '</tbody>';
echo "</table>";

?>