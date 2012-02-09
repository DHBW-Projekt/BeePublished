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
* @author Sebastian Haase
*
* @description element displayed when page with plugin is called
* 			   deciding whether text or video is displayed
* 			   ?wmode=opaque is necessary to keep overlay working
*/
?>
<?php $this->Html->css('/Youtube/css/template',null,array('inline' => false));?>

<?php
if ($data == NULL || empty($data['YoutubeLink']['url'])){
	echo __d('youtube', 'Please enter a video URL in the plugin configuration.');
} else { 
?>
<div class="youtube_video">
<iframe width="640" height="360" src="<?php echo $data['YoutubeLink']['url'] . '?wmode=opaque'?>" frameborder="0" allowfullscreen></iframe>
</div>
<?php }?>