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
* @author Maximilian Stüber, Corinna Knick
*
* @description content and formatting of admin overlay
*/
?>

<?php
	//LOAD css-file
	echo $this->Html->css('/ContactForm/css/contact_form');
?>

<!-- SET content of admin overlay -->
<div id="contact_form_admin">
	<h2><?php echo __d('contact_form','Configuration') ?></h2><br />
	<div id="contact_form_admin_content"><?php echo __d('contact_form','There are no configuration options available. Contact requests are automatically sent to the e-mail address in your general configurations. To change the recipient of contact requests, please set a new e-mail address in your general configurations.')?></p>
	<div style="clear:both;"></div>
</div>