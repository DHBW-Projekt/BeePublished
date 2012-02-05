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
 * @description View to display a single image in a context free environment
 */


$this->Helpers->load('SocialNetwork');
$this->Html->css('/gallery/css/galleries', NULL, array('inline' => false));
echo '<div style="clear:both;"></div>';

$this->set('title_for_layout', $data['image']['title']);


echo '<h1>'.$data['image']['title'].'</h1>';

echo '<div style ="margin-top:20px; margin-bottom:10px; text-algin:center">';
echo '<img src="'.$this->webroot.$data['image']['path_to_pic'].'" width="700" alt="imagePreview"/>'
?>
</div>
<div class='showFullNewsSocial' >
		<?php
			//Facebook
			echo $this->SocialNetwork->insertFacebookShare();
		?>
</div>
<div style="clear:both;"></div>