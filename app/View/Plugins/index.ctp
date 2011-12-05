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
    <?php foreach ($plugins as $plugin): ?>
    <tr>
        <td><?php echo $plugin['name']; ?></td>
        <td><?php echo $plugin['version']; ?></td>
        <td><?php echo $plugin['author']; ?></td>
        <td>
            <?php if ($plugin['status'] == 0): ?>
            <?php echo __('No Database tables'); ?>
            <?php elseif ($plugin['status'] == 1): ?>
            <?php echo $this->Html->link(__('Install plugin'),array('action' => 'install', $plugin['name'])); ?>
            <?php elseif ($plugin['status'] == 2): ?>
            <?php echo $this->Html->link(__('Update plugin'),array('action' => 'install', $plugin['name'])); ?>
            <?php elseif ($plugin['status'] == 3): ?>
            <?php echo __('Up to date'); ?>
            <?php endif; ?>
        </td>
        <td>
            <?php if ($plugin['status'] == 2 || $plugin['status'] == 3): ?>
            <?php echo $this->Html->link(__('Uninstall plugin'),array('action' => 'uninstall', $plugin['name'])); ?>
            <?php endif; ?>
        </td>
    </tr>
        <?php endforeach; ?>
    </tbody>
</table>