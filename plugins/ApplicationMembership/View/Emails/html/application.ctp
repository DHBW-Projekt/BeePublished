<div>
<p><?php echo __d('application_membership','Hi Admin'); ?>,</p>
<p><?php echo __d('application_membership','Someone likes to become a member of your association.'); ?></p>

<p><strong><?php echo __d('application_membership','Please decide whether you like to accept following person as a member:'); ?></strong></p>

<table>
	<tr>
		<th><?php echo __d('application_membership','Feld'); ?></th>
		<th><?php echo __d('application_membership','Eingabe'); ?></th>
	</tr>
	<tr>
		<td><?php __d('application_membership','Active:'); ?></td>
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

<p><?php echo __d('application_membership','Yours sincerely,'); ?><br>
<?php echo $url?></p>
</div>