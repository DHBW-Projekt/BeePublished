<div class="users view">
<h2><?php  echo __('User');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Role']['name'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Login'); ?></dt>
		<dd>
			<?php echo h($user['User']['last_login']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Registered'); ?></dt>
		<dd>
			<?php echo h($user['User']['registered']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Confirmation Token'); ?></dt>
		<dd>
			<?php echo h($user['User']['confirmation_token']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($user['User']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Log Entries'), array('controller' => 'log_entries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Log Entry'), array('controller' => 'log_entries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pages'), array('controller' => 'pages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Page'), array('controller' => 'pages', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Log Entries');?></h3>
	<?php if (!empty($user['LogEntry'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Ipaddress'); ?></th>
		<th><?php echo __('Action'); ?></th>
		<th><?php echo __('ActionDate'); ?></th>
		<th><?php echo __('Object Class'); ?></th>
		<th><?php echo __('Object Id'); ?></th>
		<th><?php echo __('Data'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['LogEntry'] as $logEntry): ?>
		<tr>
			<td><?php echo $logEntry['id'];?></td>
			<td><?php echo $logEntry['user_id'];?></td>
			<td><?php echo $logEntry['ipaddress'];?></td>
			<td><?php echo $logEntry['action'];?></td>
			<td><?php echo $logEntry['actionDate'];?></td>
			<td><?php echo $logEntry['object_class'];?></td>
			<td><?php echo $logEntry['object_id'];?></td>
			<td><?php echo $logEntry['data'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'log_entries', 'action' => 'view', $logEntry['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'log_entries', 'action' => 'edit', $logEntry['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'log_entries', 'action' => 'delete', $logEntry['id']), null, __('Are you sure you want to delete # %s?', $logEntry['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Log Entry'), array('controller' => 'log_entries', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Pages');?></h3>
	<?php if (!empty($user['Page'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Container Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('ValidFrom'); ?></th>
		<th><?php echo __('ValidTo'); ?></th>
		<th><?php echo __('Published'); ?></th>
		<th><?php echo __('MetaTags'); ?></th>
		<th><?php echo __('DateCreated'); ?></th>
		<th><?php echo __('DateLastChange'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Page'] as $page): ?>
		<tr>
			<td><?php echo $page['id'];?></td>
			<td><?php echo $page['container_id'];?></td>
			<td><?php echo $page['user_id'];?></td>
			<td><?php echo $page['title'];?></td>
			<td><?php echo $page['name'];?></td>
			<td><?php echo $page['validFrom'];?></td>
			<td><?php echo $page['validTo'];?></td>
			<td><?php echo $page['published'];?></td>
			<td><?php echo $page['metaTags'];?></td>
			<td><?php echo $page['dateCreated'];?></td>
			<td><?php echo $page['dateLastChange'];?></td>
			<td><?php echo $page['description'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'pages', 'action' => 'view', $page['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'pages', 'action' => 'edit', $page['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'pages', 'action' => 'delete', $page['id']), null, __('Are you sure you want to delete # %s?', $page['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Page'), array('controller' => 'pages', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
