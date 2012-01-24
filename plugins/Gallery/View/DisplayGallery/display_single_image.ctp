
<div>
<?php 
if(isset($data['previous']))
	echo $this->Html->link(' previous ',array(
				'plugin' => 'Gallery',
				'controller' => 'DisplayGallery',
				'action' => 'displaySingleImage',$data['GalleryID'],$data['previous']));

if(isset($data['next']))
	echo $this->Html->link(' next ',array(
				'plugin' => 'Gallery',
				'controller' => 'DisplayGallery',
				'action' => 'displaySingleImage',$data['GalleryID'],$data['next']));



?>

</div>

<?php 

echo '<div style="clear:both;"></div>';

echo $this->Html->image($data['image']['path_to_pic'],
array(
		'style' => 'float: left', 
		'alt' => 'ImagePreview'
)
);
debug($data);

echo '<div style="clear:both;"></div>';

?>