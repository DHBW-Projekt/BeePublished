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
 * @description Entry view for display galleries
 */

echo $this->element('admin_menu',array("ContentId" => $ContentId, "mContext" => $mContext));

$this->Html->css('/gallery/css/galleries', NULL, array('inline' => false));
$this->Html->script('/gallery/js/gallerytableassign', false);
echo "<h1> ".__('Assign a gallery')."</h1>";

echo $this->Session->flash();
$curr_galleryid=-1;
if(array_key_exists('galleryID', $data['CurrGallery'])){
	$curr_galleryid = $data['CurrGallery']['galleryID'];
}


echo '<div class="galleryinfo">'.__('Please assign a gallery to the view.').'</div>';

echo '<table>';
	echo '<thead>';
		echo '<tr>';
			echo '<th>'.__('Title').'</th>';
			echo '<th>'.__('Description').'</th>';
			echo '<th></th>';
		echo '</tr>';
	echo '</thead>';
	echo '<tbody>';

foreach ($data['AllGalleries'] as $gallery){
	echo '<tr class="Gallery_row">';
		echo '<td>'.$gallery['GalleryEntry']['title'].'</td>';
		echo '<td style width="30%">'.$gallery['GalleryEntry']['description'].'</td>';
		echo '<td>';
			
			if ($gallery['GalleryEntry']['id'] == $curr_galleryid){
									$class = "";
									$style = "display:inline";
			} else {
									$class = "set_gallery_link";
									$style = "display:none";
			}
			echo $this->Html->link(
			$this->Html->image("check.png", array('width' => '16px')),
			array('action' => 'setGallery', $ContentId, $gallery['GalleryEntry']['id'],$mContext),
			array('escape' => False, 'class' => $class, "style" => $style)
			);
		echo '</td>';
	echo '</tr>';
}
echo '</tbody>';
echo "</table>";

?>