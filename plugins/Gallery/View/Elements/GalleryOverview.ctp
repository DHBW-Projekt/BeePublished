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
 * @description Element to display a overview of all available galleries
 */


$this->Html->css('/gallery/css/galleries', NULL, array('inline' => false));

if(isset($data['view']) && $data['view'] == 'Single'){	
	echo $this->element('DisplayGallery',array('data' => $data));
} else {
	echo "<h1>".__("Gallery overview")."</h1>";	
	foreach ($data as $gallery){
		echo '<div class="galleryImage">';

		if(!$adminMode){
			echo '<a href="'.$this->here.'/galleryoverview/view/'.$gallery['GalleryEntry']['id'].'">';
		}
		
		if(isset($gallery['GalleryEntry']['titlepicture']['thumb'])){
			echo '<img src="'.$this->webroot.$gallery['GalleryEntry']['titlepicture']['thumb'].'" alt="">';
		} else {
			echo '<img src="'.$this->webroot.$gallery['GalleryPicture'][0]['thumb'].'" alt="">';
		}
		
		if(!$adminMode){
			echo '</a>';
		}
		
		echo '<div class="galleryTitle">'.$gallery['GalleryEntry']['title'].'</div>';
		echo '</div>';
	}
	echo '<div style="clear:both;"></div>';
}
?>