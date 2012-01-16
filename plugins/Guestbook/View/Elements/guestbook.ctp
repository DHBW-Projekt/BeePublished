<?php 
$this->Helpers->load('Time');
$this->Helpers->load('Paginator');

$this->Html->css('/Guestbook/css/template',null,array('inline' => false));
$this->Html->css('/Guestbook/css/design',null,array('inline' => false));
?>

<?php
// data url contentId pluginId
// $adminMode = $this->viewVars['adminMode'];
// 'adminMode' => $adminMode,
// && (adminMode == 1)

echo $this->Session->flash('Guestbook.Main');

if (array_key_exists('writePost', $data)){
	echo '<div id="guestbook_link">' . $this->Html->link(__('Display posts'), $url . '/') . '</div>';
	echo $this->element('writePost',
	array('input' => $this->Session->read('Validation.GuestbookPost.data'),
		  'errors' => $this->Session->read('Validation.GuestbookPost.validationErrors')),
	array('plugin' => 'Guestbook'));
} else{
	echo '<div id="guestbook_link">' . $this->Html->link(__('Write a post'), $url . '/guestbook/writePost') . '</div>';
	echo $this->element('displayPosts',
	array('data' => $data,
		  'url' => $url,
		  'pluginId' => $pluginId),
	array('plugin' => 'Guestbook'));
}
?>

