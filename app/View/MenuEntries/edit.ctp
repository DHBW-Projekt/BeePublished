<h2>Edit menu entry</h2>
<?php
echo $this->Form->create('MenuEntry');
echo $this->Form->input('MenuEntry.role_id');
echo $this->Form->input('MenuEntry.name');
echo $this->Form->end(__('edit'));
?>