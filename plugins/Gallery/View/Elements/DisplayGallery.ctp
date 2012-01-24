<?php 
$this->Html->script('/gallery/js/imageoverlay', false);
$this->Html->css('/gallery/css/galleries', NULL, array('inline' => false));

if(!isset($data)){
	echo "No gallery selected";
} else {
	?>	
	<div class="newsblogtitle">
		<h1>
	<?php echo "Gallery - ".$data['GalleryEntry'] ['title']?>
		</h1>
	</div> 
<?php 



foreach ($data['GalleryPicture'] as $pic){
	echo '<a class="fancybox" ';
	echo 'title = "'.$this->webroot.'#'.$pic['title'].'#'.$data['GalleryEntry']['id'].'#'.$pic['id'].'" ';
	echo 'rel="group" href="';
	echo $this->webroot.$pic['path_to_pic'].'">';
	echo $this->Html->image($pic['thumb']);
	echo '</a>';
/*echo $this->Html->image($pic['thumb'],
	array(
		'style' => 'float: left', 
		'alt' => 'ImagePreview',
		'url' => array(
				'plugin' => 'Gallery',
				'controller' => 'DisplayGallery',
				'action' => 'displaySingleImage',$data['GalleryEntry']['id'],$pic['id'])
	)
);*/
}

echo '<div style="clear:both;"></div>';



//debug($data);

}
?>