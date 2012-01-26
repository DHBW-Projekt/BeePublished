<?php 
$this->Helpers->load('Time');
$this->Helpers->load('Paginator');

$this->Html->css('/Guestbook/css/template',null,array('inline' => false));
$this->Html->css('/Guestbook/css/design',null,array('inline' => false));
?>

<?php
echo $this->Session->flash('Guestbook.Main');

if (array_key_exists('writePost', $data)){
	echo '<div id="guestbook_link">' . $this->Html->link(__d('Guestbook','Display posts'), $url . '/', array('title' => __d('Guestbook', 'Display posts'))) . '</div>';
	echo $this->element('writePost',
	array('input' => $this->Session->read('Validation.GuestbookPost.data'),
		  'errors' => $this->Session->read('Validation.GuestbookPost.validationErrors'),
		  'contentId' => $contentId),
	array('plugin' => 'Guestbook'));
} else{
	echo '<div id="guestbook_link">' . $this->Html->link(__d('Guestbook','Write a post'), $url . '/guestbook/writePost', array('title' => __d('Guestbook', 'Write a post'))) . '</div>';
	echo $this->element('displayPosts',
	array('data' => $data,
		  'url' => $url,
		  'pluginId' => $pluginId),
	array('plugin' => 'Guestbook'));
}
?>

