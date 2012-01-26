<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<div><?php echo __d('contact_form', 'A user sent you the following contact request:'); ?></div>
	<br />
	<div style = "border-style: solid; border-width: 1px">
		<table>
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
				<td><b><?php echo __d('contact_form','Message: ') ?></b></td><td><?php echo $body; ?></td>
			</tr>
		</table>
	</div>
	<br />
	<i><?php echo __d('contact_form', 'Contact requests are automatically sent to the e-mail address in your general configurations in BeePublished. To change the recipient of contact requests, please set a new e-mail address in your general configurations.') ?></i>
	<br />
	<div>Powered by BeePublished - All rights reserved - &copy; Copyright 2011-2012</div>
</html>