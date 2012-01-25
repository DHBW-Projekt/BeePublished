<?php
$this->Html->script('/gallery/js/assign', false);
$this->Html->css('/gallery/css/galleries', NULL, array('inline' => false));
echo $this->element('admin_menu_galleries',array("ContentId" => $ContentId));

echo "<h1>Assign Images to your Gallery</h1>";

?>
 <div class="role">
        <div class="users_role">Available pictures</div>
        <div rel="<?php echo $galleryId ?>" class="users">
            <?php foreach ($available_pictures as $picture): ?>
            <div class="user_detail" rel="<?php echo $picture['id']; ?>">
                <div class="user_pic"><?php echo $this->Html->image($picture['thumb'], array('width' => '55', 'height' => '55')); ?></div>
                <div class="user_name"><?php echo $picture['title']; ?></div>
                <div>
                    <?php // echo $this->Html->link($this->Html->image('edit.png', array('width' => '20', 'height' => '20')),array('controller' => 'Users', 'action' => 'edit', $user['id']),array('escape' => false, 'class' => 'user_edit')); ?>
                    <?php //echo $this->Html->link($this->Html->image('delete.png', array('width' => '20', 'height' => '20')),array('controller' => 'Users', 'action' => 'delete', $user['id']),array('escape' => false, 'class' => 'user_delete')); ?>
                </div>
            </div>
          	<?php endforeach; ?>
          	
          	
        </div>
                  	<div style="clear:both;"></div>
        
 </div>
 
  <div class="role">
        <div class="users_role">Gallery pictures</div>
        <div rel="<?php echo $galleryId ?>" class="users">
            <?php foreach ($gallery_pictures as $picture): ?>
            <div class="user_detail" rel="<?php echo $picture['id']; ?>">
                <div class="user_pic"><?php echo $this->Html->image($picture['thumb'], array('width' => '55', 'height' => '55')); ?></div>
                <div class="user_name"><?php echo $picture['title']; ?></div>
                <div>
                    <?php // echo $this->Html->link($this->Html->image('edit.png', array('width' => '20', 'height' => '20')),array('controller' => 'Users', 'action' => 'edit', $user['id']),array('escape' => false, 'class' => 'user_edit')); ?>
                    <?php //echo $this->Html->link($this->Html->image('delete.png', array('width' => '20', 'height' => '20')),array('controller' => 'Users', 'action' => 'delete', $user['id']),array('escape' => false, 'class' => 'user_delete')); ?>
                </div>
            </div>
          	<?php endforeach; ?>
          	
        </div>
                  	<div style="clear:both;"></div>
        
 </div>


<?php 

/*

echo "available pictures";
echo "<table>";
echo "<tr> <td> Id </td> <td> Title </td> </tr>";

foreach ($available_pictures as $picture){
	echo "<tr>";
	echo "<td>".$picture['id']."</td>";
	echo "<td>".$picture['title']."</td>";
	echo "<td>";
	echo $this->Html->image("add2.png", 
	array('width' => '32px',
	'url' => array('plugin' => 'Gallery', 'controller' => 'ManageGalleries', 'action' => 'assignImage',$galleryId,$picture['id'])));
	echo "</td>";
	echo "</tr>";
}
echo "</table>";
echo "gallery pictures";
echo "<table>";
echo "<tr> <td> Id </td> <td> Title </td> </tr>";

foreach ($gallery_pictures as $picture){
	echo "<tr>";
	echo "<td>".$picture['id']."</td>";
	echo "<td>".$picture['title']."</td>";
	echo "<td>";
	echo $this->Html->image("delete.png", 
	array('width' => '32px',
	'url' => array('plugin' => 'Gallery', 'controller' => 'ManageGalleries', 'action' => 'unassignImage',$galleryId,$picture['id'])));
	echo "</td>";
	echo "</tr>";
}
echo "</table>";
*/
?>