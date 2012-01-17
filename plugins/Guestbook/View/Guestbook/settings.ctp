<?php 
$this->Html->css('/Guestbook/css/template',null,array('inline' => false));
$this->Html->css('/Guestbook/css/design',null,array('inline' => false));
?>

<?php echo $this->element('adminMenu', array() , array('plugin' => 'Guestbook'));?>
<?php echo $this->Session->flash('Guestbook.Admin');?>

<?php 
echo $this->Form->create('settings', array('url' => array('plugin' => 'Guestbook', 'controller' => 'Guestbook','action' => 'settings', $contentId)));

echo $this->Form->label('posts_per_page', __('Posts per page'));
echo $this->Form->select('posts_per_page',array('5' => '5', '10' => '10', '25' => '25', '50' => '50', '100' => '100'), array('value' => $posts_per_page, 'empty' => false));
?></br></br><?php 
echo $this->Form->label('send_emails', __('Send e-mails'));
echo $this->Form->select('send_emails', array('1' =>'Yes', '0' => 'No'), array('value' => $send_emails, 'empty' => false));

echo $this->Form->end(array('value' => 'Save settings', 'label' => __('Save settings')));
?>