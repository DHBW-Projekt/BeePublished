<?php 
$this->Html->css('/gallery/css/galleries', NULL, array('inline' => false));

if(isset($data['view']) && $data['view'] == 'Single'){	
	echo $this->element('DisplayGallery',array('data' => $data));
} else {
	echo "<h1>".__("Gallery overview")."</h1>";	
	foreach ($data as $gallery){
		echo '<div class="galleryImage">';
		if(isset($gallery['GalleryEntry']['titlepicture']['thumb']))
			echo $this->Html->image($gallery['GalleryEntry']['titlepicture']['thumb'],array('url' => $url.'/galleryoverview/view/'.$gallery['GalleryEntry']['id']));
		else
			echo $this->Html->image($gallery['GalleryPicture'][0]['thumb'],array('url' => $url.'/galleryoverview/view/'.$gallery['GalleryEntry']['id']));
		echo '<div class="galleryTitle">'.$gallery['GalleryEntry']['title'].'</div>';
		echo '</div>';
	}
	echo '<div style="clear:both;"></div>';
}
?>