<?php
$this->Html->script('/gallery/js/assign', false);
$this->Html->css('/gallery/css/galleries', NULL, array('inline' => false));
echo $this->element('admin_menu_galleries',array("ContentId" => $ContentId));

echo "<h1>".__("Assign images to your gallery")."</h1>";

echo '<div class="galleryinfo">'.__('Please assign images from your image repository to your gallery').'</div>';
?>
 <div class="role">
        <div class="users_role">Available pictures</div>
        <div rel="<?php echo $galleryId ?>" class="users">
            <?php foreach ($available_pictures as $picture): ?>
            <div class="user_detail" rel="<?php echo $picture['id']; ?>">
                <div class="user_pic"><?php echo $this->Html->image($picture['thumb'], array('width' => '55', 'height' => '55')); ?></div>
                <div class="user_name"><?php echo $picture['title']; ?></div>
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
            </div>
          	<?php endforeach; ?>
          	
        </div>
        <div style="clear:both;"></div>
 </div>

