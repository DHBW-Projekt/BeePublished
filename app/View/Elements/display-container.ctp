<?php foreach ($data as $child): ?>
<?php if (array_key_exists('columns', $child)): ?>
    <div class="subcolumns">
        <?php foreach ($child['columns'] as $column): ?>
        <div class="<?php echo $column['class']; ?>">
            <div class="<?php echo $column['contentClass']; ?>">
                <?php echo $this->element('display-container', array('data' => $column['children'])); ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php elseif (array_key_exists('content', $child)): ?>
    <?php if (!array_key_exists('plugin', $child['content'])): ?>
        <?php echo __('Unknown module'); ?>
        <?php else: ?>
        <div class="plugin_content">
            <?php echo $this->element($child['content']['view'], array('data' => $child['content']['viewData']), array('plugin' => $child['content']['plugin'])); ?>
        </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>
