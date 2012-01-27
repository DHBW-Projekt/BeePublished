<?php
$this->Html->css('/Youtube/css/template',null,array('inline' => false));

$input = $this->Session->read('Validation.YoutubeLink.data');
$errors = $this->Session->read('Validation.YoutubeLink.validationErrors')
?>

<?php echo $this->element('adminMenu', array('contentId' => $contentId), array('plugin' => 'Youtube'));?>

<?php echo $this->Session->flash('Youtube.Admin');?>

<div id="youtube_settings">
<?php
echo __d('Youtube', 'In order for this plugin to work correctly, go to youtube, select the video and copy the link provided in the top of your browser.');
// begin of form
echo $this->Form->create('YoutubeLink', array('url' => array('plugin' => 'Youtube',
															   'controller' => 'Youtube',
															   'action' => 'admin',
																$contentId)));
// check whether a value is already present or an error had occured
if (($input != NULL) && array_key_exists('url', $input['YoutubeLink'])){
	echo $this->Form->input('YoutubeLink.url', array('type' => 'text', 'label' => 'URL:', 'value' => $input['YoutubeLink']['url']));
} else {
	echo $this->Form->input('YoutubeLink.url', array('type' => 'text', 'label' => 'URL:'));
}
if (($errors != NULL) && array_key_exists('url', $errors) && array_key_exists('0', $errors['url'])){
	echo $this->Html->div('validation_error',$errors['url']['0']);
}
// end of form
echo $this->Form->end(__d('Youtube', 'Save'));
?>
</div>