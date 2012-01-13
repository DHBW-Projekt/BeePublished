<?php $this->Html->script('jquery.quicksearch', false); ?>
<?php $this->Html->script('admin/users', false); ?>
<?php echo $this->element('config-menu'); ?>
<div id="users_overview">
    <div id="users_search_bar">
    <form>Search Users: <input type="text" id="search-users"/></form>
    </div>
    <?php foreach ($roles as $role): ?>
    <div class="role">
        <div class="users_role"><?php echo $role['Role']['name'];?></div>
        <div rel="<?php echo $role['Role']['id'];?>" class="users">
            <?php foreach ($role['User'] as $user): ?>
            <div class="user_detail" rel="<?php echo $user['id']; ?>">
                <div class="user_pic"><?php echo $this->Html->image('group.png', array('width' => '55', 'height' => '55')); ?></div>
                <div class="user_name"><?php echo $user['username']; ?></div>
                <div>
                    <?php echo $this->Html->link($this->Html->image('edit.png', array('width' => '20', 'height' => '20')),array('controller' => 'users', 'action' => 'edit', $user['id']),array('escape' => false, 'class' => 'user_edit')); ?>
                    <?php echo $this->Html->link($this->Html->image('delete.png', array('width' => '20', 'height' => '20')),array('controller' => 'users', 'action' => 'delete', $user['id']),array('escape' => false)); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div style="clear:both"></div>
    </div>
    <?php endforeach; ?>
</div>