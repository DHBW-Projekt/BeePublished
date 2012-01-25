<?php 
$this->Html->css('/Guestbook/css/template',null,array('inline' => false));
$this->Html->css('/Guestbook/css/design',null,array('inline' => false));
?>

<?php echo $this->element('adminMenu', array() , array('plugin' => 'Guestbook'));?>

<?php echo $this->Session->flash('Guestbook.Admin');?>

<?php 
// start of settings form
echo $this->Form->create('settings', array('url' => array('plugin' => 'Guestbook', 'controller' => 'Guestbook','action' => 'settings', $contentId)));
echo '<p>' . __d('Guestbook', 'You can change the number of posts which are displayed on a single pgae here.') . '</p>';
echo $this->Form->label('posts_per_page', __d('Guestbook', 'Posts per page:'));
echo $this->Form->select('posts_per_page',array('5' => '5', '10' => '10', '25' => '25', '50' => '50', '100' => '100'), array('value' => $posts_per_page, 'empty' => false));
?>
<!-- needed breaks as there is no css styling for selects -->
<br><br>
<?php 
// part two
echo '<p>' . __d('Guestbook', 'The following option determins whether an e-mail is send to you everytime a new post is submitted.') . '</p>';
echo $this->Form->label('send_emails', __d('Guestbook', 'Send e-mails:'));
echo $this->Form->select('send_emails', array('yes' =>__d('Yes'), 'no' => __d('No')), array('value' => $send_emails, 'empty' => false));
?>
<!-- needed breaks as there is no css styling for selects -->
<br><br>
<?php 
// part three and end of settings form
echo '<p>' . __d('Guestbook', 'If set to "No", released and then deleted posts will only be hidden and not deleted from database.') . '</p>';
echo $this->Form->label('delete_immediately', __d('Guestbook', 'Delete immediately:'));
echo $this->Form->select('delete_immediately', array('yes' => __d('Yes'), 'no' => __d('No')), array('value' => $delete_immediately, 'empty' => false));
echo $this->Form->end(array('value' => 'Save settings', 'label' => __d('Guestbook', 'Save settings')));
?>

<?php if($delete_immediately == 'no'){
// start clean from database form
echo '<p>' . __d('Guestbook', 'If "Delete immediately" is set to "No", deleted posts can be removed from database here.') . '</p>';
echo $this->Form->create('clean_db', array('url' => array('plugin' => 'Guestbook', 'controller' => 'Guestbook','action' => 'clean_db', $contentId)));
echo $this->Form->end(array('value' => 'Clean database', 'label' => __d('Guestbook', 'Clean database')));
}?>