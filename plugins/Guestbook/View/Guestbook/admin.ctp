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
* @description first page for admin overlay, displaying all pending posts
*/
App::uses('Sanitize', 'Utility');
$this->Helpers->load('Time');
$this->Helpers->load('BBCode');

$this->Html->css('/Guestbook/css/template',null,array('inline' => false));
$this->Html->css('/Guestbook/css/design',null,array('inline' => false));
?>

<?php echo $this->element('adminMenu', array('contentId' => $contentId), array('plugin' => 'Guestbook'));?>

<?php echo $this->Session->flash('Guestbook.Admin');?>

<div id='guestbook_maintenance'>

<?php 
if (!array_key_exists(0, $unreleasedPosts)) {
	echo '<p>' . __d('guestbook', 'There are no new posts to be released.') . '</p>';
} else {
?>

<?php echo $this->Form->create('maintenance', array('url' => array('plugin' => 'Guestbook', 'controller' => 'Guestbook','action' => 'admin', $contentId)));?>
<table>
	<thead>
		<tr>
			<th></th>
			<th><?php echo __d('guestbook', 'Author');?></th>
			<th><?php echo __d('guestbook', 'Title');?></th>
			<th><?php echo __d('guestbook', 'Text');?></th>
			<th><?php echo __d('guestbook', 'Date');?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="3">
				<?php echo $this->Html->image('/img/arrow.png', array('height' => 20,'width' => 20));?>
				<?php echo $this->Form->submit(__d('guestbook', 'Release'), array('name' => 'release', 'div' => false));?>
				<?php echo $this->Form->submit(__d('guestbook', 'Delete'), array('name' => 'delete', 'div' => false));?>
			</td>
		</tr>
	</tfoot>
	<tbody>
		<?php foreach($unreleasedPosts as $GuestbookPost):?>
		<tr>
			<td class='check'><?php echo $this->Form->checkbox('GuestbookPost.' . $GuestbookPost['GuestbookPost']['id'] . '.ckecked');?></td>
			<td class='author'><?php echo Sanitize::html($GuestbookPost['GuestbookPost']['author']);?></td>
			<td class='title'><?php echo Sanitize::html($GuestbookPost['GuestbookPost']['title']);?></td>
			<td class='text'><?php echo $this->BBCode->transformBBCode(Sanitize::html($GuestbookPost['GuestbookPost']['text']));?></td>
			<td class='date'><?php echo $this->Time->format('d.m.Y', $GuestbookPost['GuestbookPost']['created']) . ' ' . $this->Time->format('H:i:s',$GuestbookPost['GuestbookPost']['created'])?></td>
		</tr>
		<?php endforeach;?>
	</tbody>
	
</table>	
<?php echo $this->Form->end();?>
<?php } ?>
</div>
