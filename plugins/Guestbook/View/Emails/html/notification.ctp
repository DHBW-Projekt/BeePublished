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
 * @description E-Mail template for notificaton mails based on HTML
 */?>
<div>
	<p><?php echo __d('Guestbook', 'Hi Admin,');?></p>
	<p><?php echo __d('Guestbook', 'Someone wrote a new post for your guestbook.');?></p>

	<table>
		<tr>
			<td><strong><?php echo __d('Guestbook', 'Author: ');?></strong></td>
			<td><?php echo $author?></td>
		</tr>
		<tr>
			<td><strong><?php echo __d('Guestbook', 'Title: ');?></strong></td>
			<td><?php echo $title?></td>
		</tr>
		<tr>
			<td><strong><?php echo __d('Guestbook', 'Text: ');?></strong></td>
			<td><?php echo $text?></td>
		</tr>
		<tr>
			<td><strong><?php echo __d('Guestbook', 'Submit time: ');?></strong></td>
			<td><?php echo $submitDate?></td>
		</tr>
	</table>

	<p><?php echo __d('Guestbook', 'If you like to release this post immediately please click ');?> <?php echo $url_release?></p>
	<p><?php echo __d('Guestbook', 'If you like to delete this post immediately please click ');?> <?php echo $url_delete?></p>
	<p><?php echo __d('Guestbook', 'You can always check new posts and release or delete them in your administration area of the guestbook plugin.');?> </p>
	
	<p><?php echo __d('Guestbook', 'Yours sincerly,');?> <br>
	<?php echo $page_name?></p>	
</div>

