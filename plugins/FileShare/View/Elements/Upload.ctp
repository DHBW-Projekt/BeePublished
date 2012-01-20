<?php
echo $this->Form->create('file_share/my_files', array('action' => 'upload', 'type' => 'file'));
echo $this->Form->file('File');
echo $this->Form->submit('Upload');
echo $this->Form->end();
?>