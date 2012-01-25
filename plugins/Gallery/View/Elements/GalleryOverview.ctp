<?php 
$this->Html->css('/gallery/css/galleries', NULL, array('inline' => false));

echo "<h1>".__("Gallery overview")."</h1>";

foreach ($data as $gallery){
	echo '<div class="galleryImage">';
	if(isset($gallery['GalleryEntry']['titlepicture']['thumb']))
		echo $this->Html->image($gallery['GalleryEntry']['titlepicture']['thumb']);
	else
		echo $this->Html->image($gallery['GalleryPicture'][0]['thumb']);
	echo '<div class="galleryTitle">'.$gallery['GalleryEntry']['title'].'</div>';
	echo '</div>';
}
echo '<div style="clear:both;"></div>';
?>