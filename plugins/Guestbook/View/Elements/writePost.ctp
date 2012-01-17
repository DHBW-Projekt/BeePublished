<div class='guestbook_write'>

<?php
// begin of form
echo $this->Form->create('GuestbookPost', array('url' => array('plugin' => 'Guestbook',
															   'controller' => 'GuestbookPost',
															   'action' => 'save',
																$contentId)));
// label + input area
// for each input field check whether a value is already present or an error had occured
// author
if (($input != NULL) && array_key_exists('author', $input['GuestbookPost'])){
	echo $this->Form->input('GuestbookPost.author', array('label' => __('Name:'), 'value' => $input['GuestbookPost']['author']));
} else {
	echo $this->Form->input('GuestbookPost.author', array('label' => __('Name:')));
}
if (($errors != NULL) && array_key_exists('author', $errors) && array_key_exists('0', $errors['author'])){
	echo $this->Html->div('validation_error',$errors['author']['0']);
}

// title
if (($input != NULL) && array_key_exists('title', $input['GuestbookPost'])){
	echo $this->Form->input('GuestbookPost.title', array('label' => __('Title:'), 'value' => $input['GuestbookPost']['title']));
} else{
	echo $this->Form->input('GuestbookPost.title', array('label' => __('Title:')));
}
if (($errors != NULL) && array_key_exists('title', $errors) && array_key_exists('0', $errors['title'])){
	echo $this->Html->div('validation_error',$errors['title']['0']);
}

// text
if (($input != NULL) && array_key_exists('text', $input['GuestbookPost'])){
	echo $this->Form->input('GuestbookPost.text', array('label' => __('Text:'), 'value' => $input['GuestbookPost']['text']));
} else{
	echo $this->Form->input('GuestbookPost.text', array('label' => __('Text:')));
}
if (($errors != NULL) && array_key_exists('text', $errors) && array_key_exists('0', $errors['text'])){
	echo $this->Html->div('validation_error',$errors['text']['0']);
}

//CAPTCHA
App::import('Vendor','recaptcha/recaptchalib');
$publickey = "6LfzYcwSAAAAAN3vRDzZKXkC0rYkwaKQTi8hMkj6"; 
echo recaptcha_get_html($publickey);

// end of form
echo $this->Form->end('Save Post');
?>

</div>