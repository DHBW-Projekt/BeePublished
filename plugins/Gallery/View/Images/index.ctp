<?php
echo $this->element('admin_menu');

echo "Add new Image";
echo $this->Form->create('addImage', 
array(
	'url' => array(
				'plugin' => 'Gallery',
	    		'controller' => 'Images',
	    		'action' => 'create'
	    		),
	'type' => 'file'));
echo $this->Form->input('ImageTitle');
echo $this->Form->file('File');

echo $this->Form->submit('add Image');
echo $this->Form->end();
echo "existing images";
?>
<table border="0">
  <tr>
    <td>id</td>
    <td>title</td>
  </tr>
<?php 
if(isset($allImages)){
	foreach($allImages as $image){
		echo "<tr>";
		echo "<td>".$image['GalleryPicture']['id']."</td>";
		echo "<td>".$image['GalleryPicture']['title']."</td>";
		
		
		echo '<td>';
		echo $this->Html->image('/app/webroot/img/edit.png',
			array(
				'style' => 'float: left', 
				'width' => '20px', 
				'alt' => '[]Edit', 
				'url' => array(
					'plugin' => 'Gallery', 
					'controller' => 'Images', 
					'action' => 'edit', $image['GalleryPicture']['id']
				)
			)
		);
		echo 	'</td>';
		
		echo 	'<td>';
		echo $this->Html->link($this->Html->image('/app/webroot/img/delete.png',
			array(
				'height' => 20, 
				'width' => 20, 
				'alt' => __('[x]Delete'))
			),
			array(
				'plugin' => 'Gallery', 
				'controller' => 'Images', 
				'action' => 'delete', $image['GalleryPicture']['id']
			),
			array(
				'escape' => false, 
				'title' => __('Delete newsletter')),
				__('Do you really want to delete this image?')
			);
		echo 	'</td>';
		
		
		
		
		echo "</tr>";
	}
}

?>
</table>