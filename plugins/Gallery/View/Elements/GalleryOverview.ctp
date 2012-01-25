<?php 
$this->Html->css('/gallery/css/galleries', NULL, array('inline' => false));


foreach ($data as $gallery){
		
	
	//debug($gallery);
	
	/*
	
	echo '<div class="galleryImage">';
	echo '<a class="fancybox" ';
	echo 'title = "'.$this->webroot.'#'.$pic['title'].'#'.$data['GalleryEntry']['id'].'#'.$pic['id'].'" ';
	echo 'rel="group" href="';
	echo $this->webroot.$pic['path_to_pic'].'">';
	echo $this->Html->image($gallery['GalleryEntry']['titlepicture']);
	echo '</a>';
	
	
	echo '</div>';
	*/
	echo '<div class="galleryImage">';
	if(isset($gallery['GalleryEntry']['titlepicture']['thumb']))
		echo $this->Html->image($gallery['GalleryEntry']['titlepicture']['thumb']);
	else
		echo $this->Html->image($gallery['GalleryPicture'][0]['thumb']);
	echo '<div class="galleryTitle">'.$gallery['GalleryEntry']['title'].'</div>';
	echo '</div>';
	
}

echo '<div style="clear:both;"></div>';



//debug($data);


/*
echo $this->Html->image($data['path_to_pic'],
	array(
		'style' => 'float: left', 
		'width' => '350px', 
		'alt' => 'ImagePreview', 
	)
);
echo '<div style="clear:both;"></div>';
*/
//debug($data);

?>