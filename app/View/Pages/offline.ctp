<?php
App::uses('Sanitize', 'Utility');
$this->Helpers->load('BBCode');
echo '<h1>'.__('The page is currently offline').'</h1><br/>';
echo $this->BBCode->transformBBCode(Sanitize::html($offlineText));
?>