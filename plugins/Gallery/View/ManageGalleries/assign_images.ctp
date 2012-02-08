<?php
/*
 * This file is part of BeePublished which is based on CakePHP.
 * BeePublished is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3
 * of the License, or any later version.
 * BeePublished is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public
 * License along with BeePublished. If not, see
 * http://www.gnu.org/licenses/.
 *
 * @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
 * @author Alexander Müller & Fabian Kajzar
 * 
 * @description view in admin area to assign images to a gallery
 */


$this->Html->script('/gallery/js/assign', false);
$this->Html->css('/gallery/css/galleries', NULL, array('inline' => false));
echo $this->element('admin_menu',array("ContentId" => $ContentId, "mContext" => $mContext));

echo "<h1>".__d('gallery', "Assign images to your gallery.")."</h1>";

echo '<div class="galleryinfo">'.__d('gallery', 'Please assign images from your image repository to your gallery.').'</div>';
?>
 <div class="role">
        <div class="users_role">Available pictures</div>
        <div rel="<?php echo $galleryId ?>" class="users">
            <?php foreach ($available_pictures as $picture): ?>
            <div class="user_detail" rel="<?php echo $picture['id']; ?>">            
                <div class="user_pic"><img src ="<?php echo $this->webroot.$picture['thumb']; ?>" width= "55" height="55" />
                </div>
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
            	<div class="user_pic"><img src ="<?php echo $this->webroot.$picture['thumb']; ?>" width= "55" height="55" />
                </div>
                <div class="user_name"><?php echo $picture['title']; ?></div>
            </div>
          	<?php endforeach; ?>
          	
        </div>
        <div style="clear:both;"></div>
 </div>

