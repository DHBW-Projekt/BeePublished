<?php 
$this->Html->script('/gallery/js/imageoverlay', false);
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
	echo __('No pictures in gallery');
} else {
foreach ($data['GalleryPicture'] as $pic){

	echo '<div class="galleryImage">';
	echo '<a class="fancybox" ';
	echo 'title = "'.$this->webroot.'#'.$pic['title'].'#'.$data['GalleryEntry']['id'].'#'.$pic['id'].'" ';
	echo 'rel="group" href="';
	echo $this->webroot.$pic['path_to_pic'].'">';
	echo $this->Html->image($pic['thumb']);
	echo '</a>';
	
	
	echo '</div>';
}
echo '<div style="clear:both;"></div>';
}
}
?>