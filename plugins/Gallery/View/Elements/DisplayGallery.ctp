<?php 
$this->Html->script('/gallery/js/imageoverlay', false);
$this->Html->script('/gallery/js/fbtest', false);
$this->Html->css('/gallery/css/galleries', NULL, array('inline' => false));

if(!isset($data)){
	echo __("No gallery assigned");
} else {
	?>	
	<div class="newsblogtitle">
		<h1>
	<?php echo "Gallery - ".$data['GalleryEntry'] ['title']?>
		</h1>
	</div> 
<?php
if(!isset($data['GalleryPicture'])){
	echo __('No pictures in gallery.');
} else {
		$titlepic  = $data['GalleryEntry']['titlepicture'];
		$title_is_inGallery = false;
		//check whether the title image ist part of the gallery
		foreach ($data['GalleryPicture'] as $checkpic){
			if($titlepic['id'] == $checkpic['id']){
			$title_is_inGallery = true;
			}//if
		}
		
		if(!$title_is_inGallery){
			echo '<div class="galleryImage">';
			echo '<a class="fancybox" ';
			echo 'title = "'.$this->webroot.'#'.$titlepic['title'].'#'.$data['GalleryEntry']['id'].'#'.$titlepic['id'].'" ';
			echo 'rel="group" href="';
			echo $this->webroot.$titlepic['path_to_pic'].'">';
	
			echo '<img src="'.$this->webroot.$titlepic['thumb'].'" />';
			echo '</a>';
			
			echo '</div>';
		}
		
	foreach ($data['GalleryPicture'] as $pic){
		echo '<div class="galleryImage">';

		echo '<a class="fancybox" ';
		echo 'title = "'.$this->webroot.'#'.$pic['title'].'#'.$data['GalleryEntry']['id'].'#'.$pic['id'].'" ';
		echo 'rel="group" href="';
		echo $this->webroot.$pic['path_to_pic'].'">';
	
		echo '<img src="'.$this->webroot.$pic['thumb'].'" />';
		echo '</a>';
	
	
		echo '</div>';
	}
echo '<div id="fb-root"></div>';
echo '<div style="clear:both;"></div>';
}
}
?>