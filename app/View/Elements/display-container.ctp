<?php foreach($data as $child): ?>
    <?php if(array_key_exists('columns',$child)): ?>
        <div class="subcolumns">
            <?php foreach($child['columns'] as $column): ?>
                <div class="<?php echo $column['class']; ?>">
                    <div class="<?php echo $column['contentClass']; ?>">
                        <?php echo $this->element('display-container', array( 'data' => $column['children'] )); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php elseif(array_key_exists('content',$child)): ?>
        <?php echo pr($child);?>
        <?php echo $child['content'];?>
                                <?php echo $this->element($child['content'], array( 'data' => $column['children'] )); ?>
    <?php endif; ?>
<?php endforeach; ?>
