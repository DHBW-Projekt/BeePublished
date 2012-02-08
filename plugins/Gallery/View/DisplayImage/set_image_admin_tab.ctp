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
 * @description Entry view for image administration
 */


echo $this->element('admin_menu',array("ContentId" => $ContentId, "mContext" => $mContext));

$this->Html->css('/gallery/css/galleries', NULL, array('inline' => false));
$this->Html->script('/gallery/js/gallerytableassign', false);
echo $this->Session->flash('Image assigned');

$curr_picid=-1;
if(array_key_exists('pictureID', $data['CurrPicture'])){
	$curr_picid = $data['CurrPicture']['pictureID'];
}

echo '<table>';
	echo '<thead>';
		echo '<tr>';
			echo '<th>'.__d('gallery', 'Id').'</th>';
			echo '<th>'.__d('gallery', 'Preview').'</th>';
			echo '<th>'.__d('gallery', 'Title').'</th>';
			echo '<th>'.__d('gallery', 'Assigned').'</th>';
		echo '</tr>';
	echo '</thead>';
	echo '<tbody>';

foreach ($data['AllPictures'] as $picture){
	echo '<tr class="Gallery_row">';
		echo "<td>".$picture['id']."</td>";
		
		
		echo '<td>'.'<img src="'.$this->webroot.$picture['thumb'].'" width="35px" /></td>';
		
		echo '<td>'.$picture['title']."</td>";
		echo "<td>";
		if ($picture['id'] == $curr_picid){
									$class = "";
									$style = "display:inline";
			} else {
									$class = "set_gallery_link";
									$style = "display:none";
		}
		
	echo $this->Html->link(
	$this->Html->image("check.png", array('width' => '16px')),
	array('action' => 'setImage', $ContentId, $picture['id'],$mContext),
	array('escape' => False, 'class' => $class, "style" => $style));
	echo "</td>";
	echo "</tr>";
}
echo "</table>";

?>