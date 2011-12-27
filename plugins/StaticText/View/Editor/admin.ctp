<h1>Set Text</h1>
<?php
    echo $this->Form->create('ContentValues');  
    echo $this->Form->input('value');
    echo $this->Form->end('Set Text');
?>