<div>
	<p>Hi Admin,</p>
	<p>Someone wrote a new post for your guestbook.</p>

	<table>
		<tr>
			<td><strong>Author: </strong></td>
			<td><?php echo $author?></td>
		</tr>
		<tr>
			<td><strong>Title: </strong></td>
			<td><?php echo $title?></td>
		</tr>
		<tr>
			<td><strong>Text: </strong></td>
			<td><?php echo $text?></td>
		</tr>
		<tr>
			<td><strong>Submit time: </strong></td>
			<td><?php echo $submitDate?></td>
		</tr>
	</table>

	<p>If you like to release this post immediately please click <?php echo $url_release?></p>
	<p>If you like to delete this post immediately please click <?php echo $url_delete?></p>
	<p>You can always check new posts and release or delete them in your administration area of the guestbook plugin.</p>
	
	<p>Yours sincerly,<br>
	<?php echo $page_name?></p>	
</div>
