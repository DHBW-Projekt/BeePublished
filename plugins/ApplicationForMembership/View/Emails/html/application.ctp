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
		<td><?php echo $data['ApplicationForMembership']['formOfMembership']; ?></td>
		<td><?php echo $data['ApplicationForMembership']['title']; ?></td>
		<td><?php echo $data['ApplicationForMembership']['name']; ?></td>
		<td><?php echo $data['ApplicationForMembership']['firstname']; ?></td>
		<td><?php echo $data['ApplicationForMembership']['dateOfBirth']; ?></td>
		<td><?php echo $data['ApplicationForMembership']['email']; ?></td>
		<td><?php echo $data['ApplicationForMembership']['telephone']; ?></td>
		<td><?php echo $data['ApplicationForMembership']['street']; ?></td>
		<td><?php echo $data['ApplicationForMembership']['zip']; ?></td>
		<td><?php echo $data['ApplicationForMembership']['city']; ?></td>
		<td><?php echo $data['ApplicationForMembership']['comment']; ?></td>
	</tr>
</table>

<p>Yours sincerely,<br>
<?php echo $url?></p>
</div>