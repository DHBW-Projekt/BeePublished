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
* @copyright 2012 Duale Hochschule Baden-W¸rttemberg Mannheim
* @author Marcus Lieberenz
*
* @description Basic Settings for all controllers
*/

// get validation errors
$validationErrors = $this->Session->read('Validation.NewsletterRecipient.validationErrors');

echo __d('newsletter', 'Here you can subscribe to our newsletter.');
	echo $this->Session->flash('subscribePerMail');
	// form for unsubscription
	echo $this->Form->create('Subscription',array(
			'url' => array(
				'plugin' => 'Newsletter',
				'controller' => 'Subscription',
				'action' => 'subscribe')));
		echo $this->Form->input('NewsletterRecipient.email', array(
			'label' => __d('newsletter','E-Mail:'),
			'value' => $email ));
		echo $this->Html->div('validation_error',$validationErrors['email'][0]);
   		echo $this->Form->end(__d('newsletter','Subscribe'));
   		echo "</div>";

?>