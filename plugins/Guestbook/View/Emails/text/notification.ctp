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
* @description E-Mail template for notificaton mails based on plain text
*/
?>
<?php echo __d('Guestbook', 'Hi Admin,');?>
<?php echo __d('Guestbook', 'Someone wrote a new post for your guestbook.');?>

<?php echo __d('Guestbook', 'Author: ');?>
<?php echo $author?>

<?php echo __d('Guestbook', 'Title: ');?>
<?php echo $title?>

<?php echo __d('Guestbook', 'Text: ');?>
<?php echo $text?>

<?php echo __d('Guestbook', 'Submit time: ');?>
<?php echo $submitDate?>


<?php echo __d('Guestbook', 'If you like to release this post immediately please click ');?>
<?php echo $url_release?>

<?php echo __d('Guestbook', 'If you like to delete this post immediately please click ');?>
<?php echo $url_delete?>

<?php echo __d('Guestbook', 'You can always check new posts and release or delete them in your administration area of the guestbook plugin.');?>

<?php echo __d('Guestbook', 'Yours sincerly,');?>
<?php echo $page_name?>

