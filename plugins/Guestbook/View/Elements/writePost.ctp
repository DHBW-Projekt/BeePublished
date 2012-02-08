<?php 
/*
* This file is part of BeePublished which is based on CakePHP.
* BeePublished is free software: you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation, either version 3
* of the License, or any later version.
* BeePublished is distributed in the hope that it will be useful, but
* WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* You should have received a copy of the GNU General Public
* License along with BeePublished. If not, see
* http://www.gnu.org/licenses/.
*
* @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
* @author Sebastian Haase
*
* @description Element to display form to write posts
*/
$this->Html->script('ckeditor/ckeditor', array('inline' => false));
$this->Html->script('ckeditor/adapters/jquery', array('inline' => false));
$this->Html->script('/guestbook/js/write',false);
?>

<div id='guestbook_write'>

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
	echo $this->Form->input('GuestbookPost.author', array('label' => __d('Guestbook', 'Name:'), 'value' => $input['GuestbookPost']['author']));
} else {
	echo $this->Form->input('GuestbookPost.author', array('label' => __d('Guestbook', 'Name:')));
}
if (($errors != NULL) && array_key_exists('author', $errors) && array_key_exists('0', $errors['author'])){
	echo $this->Html->div('validation_error',$errors['author']['0']);
}

// title
if (($input != NULL) && array_key_exists('title', $input['GuestbookPost'])){
	echo $this->Form->input('GuestbookPost.title', array('label' => __d('Guestbook', 'Title:'), 'value' => $input['GuestbookPost']['title']));
} else{
	echo $this->Form->input('GuestbookPost.title', array('label' => __d('Guestbook', 'Title:')));
}
if (($errors != NULL) && array_key_exists('title', $errors) && array_key_exists('0', $errors['title'])){
	echo $this->Html->div('validation_error',$errors['title']['0']);
}

// text
if (($input != NULL) && array_key_exists('text', $input['GuestbookPost'])){
	echo $this->Form->textarea('GuestbookPost.text', array('label' => false, 'value' => $input['GuestbookPost']['text']));
} else{
	echo $this->Form->textarea('GuestbookPost.text', array('label' => false));
}
if (($errors != NULL) && array_key_exists('text', $errors) && array_key_exists('0', $errors['text'])){
	echo $this->Html->div('validation_error',$errors['text']['0']);
}

echo '<br /><p>' . __d('Guestbook', 'Please enter the two words in the Captcha. This is needed to prevent spmamming.') . '</p>';

//CAPTCHA
App::import('Vendor','recaptcha/recaptchalib');
$publickey = "6LfzYcwSAAAAAN3vRDzZKXkC0rYkwaKQTi8hMkj6"; 
echo recaptcha_get_html($publickey);

// end of form
echo $this->Form->end(__d('Guestbook', 'Save Post'));
?>

</div>