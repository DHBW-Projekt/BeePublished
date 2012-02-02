<?php
echo $this->element('admin_menu_images',array("ContentId" => $data['ContentId']));

echo $this->Session->flash('Image saved');
echo $this->Session->flash('Image deleted');

echo "<h2>".__('Add single image')."</h2>";

echo $this->Form->create('addImage', array('url' => array('plugin' => 'Gallery','controller' => 'ManageImages','action' => 'uploadImage',$data['ContentId']),'type' => 'file'));

echo $this->Form->input(__('Title'));
echo $this->Form->label(__('File'));
echo $this->Form->file('File');

echo $this->Form->submit(__('Add image'));
echo $this->Form->end();

echo "<h2>".__('Add multiple images')."</h2>";

echo $this->Form->create('addImage', array('url' => array('plugin' => 'Gallery','controller' => 'ManageImages','action' => 'uploadImages',$data['ContentId']),'type' => 'file'));
echo $this->Form->input('data', array('label'=>'Files', 'type'=>'file', 'name' => 'files[]', 'multiple'));
echo $this->Form->submit(__('Add images'));
echo $this->Form->end();

echo "<br>";
echo "<hr>";
echo "<br>";

echo "<h1>".__('Existing images')."</h1>";

echo '<table>';
	echo '<thead>';
		echo '<tr>';
			echo '<th></th>';
			echo '<th>'.__('Id').'</th>';
			echo '<th>'.__('Preview').'</th>';
			echo '<th>'.__('Title').'</th>';
			echo '<th>'.__('Edit').'</th>';
			echo '<th>'.__('Delete').'</th>';
		echo '</tr>';
	echo '</thead>';
echo '<tbody>';
echo $this->Form->create('selectPictures', array(
				'url' => array(
				'plugin' => 'Gallery',
				'controller' => 'ManageImages',
				'action' => 'deleteSelected',$data['ContentId']),
				'onsubmit'=>'return confirm(\''.__('Do you really want to delete the selected images?').'\');'));

foreach ($data['AllPictures'] as $picture){
	echo "<tr>";
	
	echo "<td>".$this->Form->checkbox($picture['id'])."</td>";
	
	echo "<td>".$picture['id']."</td>";
	
	echo '<td>'.'<img src="'.$this->webroot.$picture['thumb'].'" width="35px" /></td>';
	
	
	echo "<td>".$picture['title']."</td>";
	
	echo '<td>';
	echo $this->Html->image('/app/webroot/img/edit.png',array('style' => 'float: left', 'width' => '20px', 'alt' => '[]Edit', 'url' => array('plugin' => 'Gallery', 'controller' => 'ManageImages', 'action' => 'edit', $picture['id'],$data['ContentId'])));
	echo '</td>';
	
	echo '<td>';
	
	echo $this->Html->link($this->Html->image('/app/webroot/img/delete.png', array(
								'height' => 20, 
								'width' => 20, 
								'alt' => __('[x]Delete'))),
								array(
									'plugin' => 'Gallery', 
									'controller' => 'ManageImages', 
									'action' => 'delete', 
									$picture['id'],
									$data['ContentId']),
								array(
									'escape' => false, 
									'title' => __('Delete Image')),
	__('Do you really want to delete this image?'));

	echo '</td>';	
	
	echo "</tr>";
}
echo '</tbody>';
	echo '<tfoot>';	
			echo '<tr>';
				echo '<td>';
				echo $this->Html->image('/app/webroot/img/arrow.png', array(
						'height' => 20,
						'width' => 20));
				echo '</td>';
				echo '<td>';
					echo $this->Form->submit(__('Delete'), array(
							'height' => 20,
							'width' => 20,
							'alt' => __('[x]Delete'),
							'onsubmit'=>'return confirm(\''.__('Do you really want to delete the selected images?').'\');'));
					echo $this->Form->end();
				echo '</td>';
			echo '</tr>';
		echo '</tfoot>';
echo "</table>";

?>