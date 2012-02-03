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
 * @description View to manage the admin navigation
 */


$this->Html->css('menu-design', NULL, array('inline' => false));?>
<?php $this->Html->css('menu-template', NULL, array('inline' => false));?>

<div id="menu" class="overlay">
    <ol class="nav">
    	<?php 
    		if($mContext == 'singleGallery'){
    			echo "<li>";
    			echo $this->Html->link(__('Assign gallery'),array('plugin' => 'Gallery', 'controller' => 'DisplayGallery', 'action' => 'setGalleryAdminTab', $ContentId,$mContext));
    			echo "</li>";
    		} else if ($mContext == 'singleImage'){
    			echo "<li>";
    			echo $this->Html->link(__('Assign image'),array('plugin' => 'Gallery', 'controller' => 'DisplayImage', 'action' => 'setImageAdminTab', $ContentId,$mContext));	    			
    			echo "</li>";
    		}
    		echo "<li>";
    		echo $this->Html->link(__('Manage images'),array('plugin' => 'Gallery', 'controller' => 'ManageImages', 'action' => 'index', $ContentId,$mContext));
    		echo "</li>";
    		
    		/*
    		echo "<li>";
    		echo $this->Html->link(__('Create gallery'),array('plugin' => 'Gallery', 'controller' => 'ManageGalleries', 'action' => 'create', $ContentId,$mContext));
    		echo "</li>";
    		*/
    		echo "<li>";
    		echo $this->Html->link(__('Manage Galleries'),array('plugin' => 'Gallery', 'controller' => 'ManageGalleries', 'action' => 'index', $ContentId,$mContext));
    		echo "</li>";	
    	?>
    </ol>
    <div style="clear:both;"></div>
</div>