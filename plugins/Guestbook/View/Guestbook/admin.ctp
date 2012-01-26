<?php 
App::uses('Sanitize', 'Utility');
$this->Helpers->load('Time');
$this->Helpers->load('BBCode');

$this->Html->css('/Guestbook/css/template',null,array('inline' => false));
$this->Html->css('/Guestbook/css/design',null,array('inline' => false));
?>

<?php echo $this->element('adminMenu', array('contentId' => $contentId), array('plugin' => 'Guestbook'));?>

<?php echo $this->Session->flash('Guestbook.Admin');?>

<div id='guestbook_maintenance'>

<?php echo $this->Form->create('maintenance', array('url' => array('plugin' => 'Guestbook', 'controller' => 'Guestbook','action' => 'admin', $contentId)));?>
<table>
	<thead>
		<tr>
		<th></th>
		<th><?php echo __d('Guestbook', 'Author')?></th>
		<th><?php echo __d('Guestbook', 'Title')?></th>
		<th><?php echo __d('Guestbook', 'Text')?></th>
		<th><?php echo __d('Guestbook', 'Date')?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($unreleasedPosts as $GuestbookPost):?>
		<tr>
		<td class='check'><?php echo $this->Form->checkbox('GuestbookPost.' . $GuestbookPost['GuestbookPost']['id'] . '.ckecked');?></td>
		<td class='author'><?php echo $GuestbookPost['GuestbookPost']['author'];?></td>
		<td class='title'><?php echo $GuestbookPost['GuestbookPost']['title'];?></td>
		<td class='text'><?php echo $this->BBCode->transformBBCode(Sanitize::html($GuestbookPost['GuestbookPost']['text']));?></td>
		<td class='date'><?php echo $this->Time->format('d.m.Y', $GuestbookPost['GuestbookPost']['created']) . ' ' . $this->Time->format('H:i:s',$GuestbookPost['GuestbookPost']['created'])?></td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>	
<?php
echo $this->Form->button(__d('Guestbook', 'Clear selection'), array('type' => 'reset', 'div' => false));
echo $this->Form->submit(__d('Guestbook', 'Release posts'), array('name' => 'release', 'div' => false));
echo $this->Form->submit(__d('Guestbook', 'Delete posts'), array('name' => 'delete', 'div' => false));
echo $this->Form->end();
?>
</div>