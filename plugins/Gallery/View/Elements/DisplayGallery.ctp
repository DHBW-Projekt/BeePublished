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
 * @description Element to display a single gallery
 */


$this->Html->script('/gallery/js/imageoverlay', false);
$this->Html->script('/gallery/js/fbtest', false);
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
	echo __('No pictures in gallery.');
} else {
		$titlepic  = $data['GalleryEntry']['titlepicture'];
		$title_is_inGallery = false;
		//check whether the title image ist part of the gallery
		foreach ($data['GalleryPicture'] as $checkpic){
			if($titlepic['id'] == $checkpic['id']){
			$title_is_inGallery = true;
			}//if
		}
		
		if(!$title_is_inGallery){
			echo '<div class="galleryImage">';
			echo '<a class="fancybox" ';
			echo 'title = "'.$this->webroot.'#'.$titlepic['title'].'#'.$data['GalleryEntry']['id'].'#'.$titlepic['id'].'" ';
			echo 'rel="group" href="';
			echo $this->webroot.$titlepic['path_to_pic'].'">';
	
			echo '<img src="'.$this->webroot.$titlepic['thumb'].'" />';
			echo '</a>';
			
			echo '</div>';
		}
		
	foreach ($data['GalleryPicture'] as $pic){
		echo '<div class="galleryImage">';

		echo '<a class="fancybox" ';
		echo 'title = "'.$this->webroot.'#'.$pic['title'].'#'.$data['GalleryEntry']['id'].'#'.$pic['id'].'" ';
		echo 'rel="group" href="';
		echo $this->webroot.$pic['path_to_pic'].'">';
	
		echo '<img src="'.$this->webroot.$pic['thumb'].'" />';
		echo '</a>';
	
	
		echo '</div>';
	}
echo '<div id="fb-root"></div>';
echo '<div style="clear:both;"></div>';
}
}
?>