<?php 
$this->Html->css('/gallery/css/galleries', NULL, array('inline' => false));

if(isset($data['view']) && $data['view'] == 'Single'){	
	echo $this->element('DisplayGallery',array('data' => $data));
} else {
	echo "<h1>".__("Gallery overview")."</h1>";	
	foreach ($data as $gallery){
		echo '<div class="galleryImage">';

		if(!$adminMode){
			echo '<a href="'.$this->here.'/galleryoverview/view/'.$gallery['GalleryEntry']['id'].'">';
		}
		
		if(isset($gallery['GalleryEntry']['titlepicture']['thumb'])){
			echo '<img src="'.$this->webroot.$gallery['GalleryEntry']['titlepicture']['thumb'].'" alt="">';
		} else {
			echo '<img src="'.$this->webroot.$gallery['GalleryPicture'][0]['thumb'].'" alt="">';
		}
		
		if(!$adminMode){
			echo '</a>';
		}
		
		echo '<div class="galleryTitle">'.$gallery['GalleryEntry']['title'].'</div>';
		echo '</div>';
	}
	echo '<div style="clear:both;"></div>';
}
?>