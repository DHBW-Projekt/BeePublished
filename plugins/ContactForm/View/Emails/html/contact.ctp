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
* @description email content and formatting
*/
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<body style = "background-color: #ffffff; font-size: 14px; font-family: Arial; color: #000000">
	<div style = "margin-bottom: 10px">
		<?php echo __d('contact_form', 'Hello Admin.'); ?>
		<br>
		<?php echo __d('contact_form', 'A user sent you the following contact request:'); ?>
	</div>
	
	<!-- Box with the user input -->
	<div style = "border-style: solid; border-width: 1px; padding: 10px 20px">
		<table style = "font-size: 14px">
			<tr>
				<td><b><?php echo __d('contact_form','Name: ') ?></b></td><td><?php echo $name; ?></td>
			</tr>
			<tr>
				<td><b><?php echo __d('contact_form','E-Mail: ') ?></b></td><td><?php echo $email; ?></td>
			</tr>
			<tr>
				<td><b><?php echo __d('contact_form','Subject: ') ?></b></td><td><?php echo $subject; ?></td>
			</tr>
			<tr>
				<td style = "vertical-align: top"><b><?php echo __d('contact_form','Message: ') ?></b></td><td><?php echo $body; ?></td>
			</tr>
		</table>
	</div><br>
	<div style = "margin-bottom: 10px">
		<?php echo __d('contact_form', 'Yours sincerely,'); ?><br>
		<?php echo $url; ?><br>
	</div>
	
	<!-- Additional information -->
	<hr style = "color: grey">
	<i style = "margin-bottom: 10px; color: grey; font-size: 12px"><?php echo __d('contact_form', 'Information: Contact requests are automatically sent to the e-mail address in your general configurations. To change the recipient of contact requests, please set a new e-mail address in your general configurations in BeePublished.') ?></i>
	<hr style = "color: grey">
</body>
</html>