<?php echo $this->element('config-menu'); ?>
<div id="plugin_config">
<h2><?php echo __('Installed');?></h2>
<table>
    <thead>
    <tr>
        <th><?php echo __('Name'); ?></th>
        <th><?php echo __('Version'); ?></th>
        <th><?php echo __('Author'); ?></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($installed as $plugin): ?>
    <tr>
        <td class="name"><?php echo $plugin['Plugin']['name']; ?></td>
        <td class="version"><?php echo $plugin['Plugin']['version']; ?></td>
        <td class="author"><?php echo $plugin['Plugin']['author']; ?></td>
        <td class="status">
            <?php if ($plugin['status'] == 0): ?>
            <?php echo __('No Database tables'); ?>
            <?php elseif ($plugin['status'] == 2): ?>
            <?php echo $this->Html->link(__('Update plugin'), array('action' => 'install', $plugin['Plugin']['name'])); ?>
            <?php elseif ($plugin['status'] == 3): ?>
            <?php echo __('Up to date'); ?>
            <?php elseif ($plugin['status'] == 99): ?>
            <?php echo __('Unknown Plugin'); ?>
            <?php endif; ?>
        </td>
        <td class="action"><?php echo $this->Html->link(__('Uninstall plugin'), array('action' => 'uninstall', $plugin['Plugin']['name'])); ?></td>
    </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<h2><?php echo __('Available');?></h2>
<table>
    <thead>
    <tr>
        <th><?php echo __('Name'); ?></th>
        <th><?php echo __('Version'); ?></th>
        <th><?php echo __('Author'); ?></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($available as $plugin): ?>
    <tr>
        <td class="name"><?php echo $plugin['name']; ?></td>
        <td class="version"><?php echo $plugin['version']; ?></td>
        <td class="author"><?php echo $plugin['author']; ?></td>
        <td class="action"><?php echo $this->Html->link(__('Install plugin'), array('action' => 'install', $plugin['name'])); ?></td>
    </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>