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
* @description Element first called when openeing page with Guestbook Plugin
* 			   Deciding wheter write or display element should be displayed
*/
$this->Helpers->load('Time');
$this->Helpers->load('Paginator');

$this->Html->css('/Guestbook/css/template',null,array('inline' => false));
$this->Html->css('/Guestbook/css/design',null,array('inline' => false));
?>

<?php
echo $this->Session->flash('Guestbook.Main');

if (array_key_exists('writePost', $data)){
	echo '<div id="guestbook_link">' . $this->Html->link(__d('guestbook','Display posts'), $url . '/', array('title' => __d('guestbook', 'Display posts'))) . '</div>';
	echo $this->element('writePost',
	array('input' => $this->Session->read('Validation.GuestbookPost.data'),
		  'errors' => $this->Session->read('Validation.GuestbookPost.validationErrors'),
		  'contentId' => $contentId),
	array('plugin' => 'Guestbook'));
} else{
	echo '<div id="guestbook_link">' . $this->Html->link(__d('guestbook','Write a post'), $url . '/guestbook/writePost', array('title' => __d('guestbook', 'Write a post'))) . '</div>';
	echo $this->element('displayPosts',
	array('data' => $data,
		  'url' => $url,
		  'pluginId' => $pluginId,
		  'contentId' => $contentId),
	array('plugin' => 'Guestbook'));
}
?>

