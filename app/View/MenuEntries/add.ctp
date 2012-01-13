<h2>Create menu entry</h2>
<?php
echo $this->Form->create('MenuEntry');
echo $this->Form->input('MenuEntry.page_id',array('empty' => __('no link')));
?>
oder neue Seite erstellen
<?php
echo $this->Form->checkbox('new_page');
echo $this->Form->input('url');
echo $this->Form->input('MenuEntry.role_id');
echo $this->Form->input('MenuEntry.name');
echo $this->Form->end(__('create'));
?>