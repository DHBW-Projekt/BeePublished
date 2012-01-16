<div>
<p>Hi Admin,</p>
<p>Someone likes to become a member of your association.</p>

<p><strong>Please decide whether you like to accept following person as a member:</strong></p>

<table>
	<tr>
		<th>Feld</th>
		<th>Eingabe</th>
	</tr>
	<tr>
		<td>Active:</td>
		<td><?php echo $data['ApplicationMembership']['formOfMembership']; ?></td>
		<td><?php echo $data['ApplicationMembership']['title']; ?></td>
		<td><?php echo $data['ApplicationMembership']['name']; ?></td>
		<td><?php echo $data['ApplicationMembership']['firstname']; ?></td>
		<td><?php echo $data['ApplicationMembership']['dateOfBirth']; ?></td>
		<td><?php echo $data['ApplicationMembership']['email']; ?></td>
		<td><?php echo $data['ApplicationMembership']['telephone']; ?></td>
		<td><?php echo $data['ApplicationMembership']['street']; ?></td>
		<td><?php echo $data['ApplicationMembership']['zip']; ?></td>
		<td><?php echo $data['ApplicationMembership']['city']; ?></td>
		<td><?php echo $data['ApplicationMembership']['comment']; ?></td>
	</tr>
</table>

<p>Yours sincerely,<br>
<?php echo $url?></p>
</div>