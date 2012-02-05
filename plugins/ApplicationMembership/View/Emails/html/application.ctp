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
 * @author Yvonne Laier and Maximilian Stueber
 *
 * @description E-Mail-Template for application.
 */
?>

<div>
<p><?php echo __d('application_membership','Hi Admin'); ?>,</p>
<p><?php echo  $data['first_name'].' '.$data['last_name'].' '.__d('application_membership', 'likes to become a member of your association.'); ?></p>

<p><strong><?php echo __d('application_membership','Please decide whether you like to accept following person as a member:'); ?></strong></p>

<table>
	<tr>
		<th><strong><?php echo __d('application_membership','Feld'); ?></strong></th>
		<th><strong><?php echo __d('application_membership','Eingabe'); ?></strong></th>
	</tr>
	<tr>
		<td><?php echo __d('application_membership','Active:'); ?></td>
		<td><?php echo $data['type']; ?></td>
	</tr>
	<tr>
		<td><?php echo __d('application_membership','Title:'); ?></td>
		<td><?php echo $data['title']; ?></td>
	</tr>
	<tr>
		<td><?php echo __d('application_membership','Name:'); ?></td>
		<td><?php echo $data['last_name']; ?></td>
	</tr>
	<tr>
		<td><?php echo __d('application_membership','First name:'); ?></td>
		<td><?php echo $data['first_name']; ?></td>
	</tr>
	<tr>
		<td><?php echo __d('application_membership','Date of birth:'); ?></td>
		<td><?php echo $data['date_of_birth']['day'].'.'.$data['date_of_birth']['month'].'.'.$data['date_of_birth']['year']; ?></td>
	</tr>
	<tr>
		<td><?php echo __d('application_membership','E-mail:'); ?></td>
		<td><?php echo $data['email']; ?></td>
	</tr>
	<tr>
		<td><?php echo __d('application_membership','Telephone:'); ?></td>
		<td><?php echo $data['telephone']; ?></td>
	</tr>
	<tr>
		<td><?php echo __d('application_membership','Street:'); ?></td>
		<td><?php echo $data['street']; ?></td>
	</tr>
	<tr>
		<td><?php echo __d('application_membership','Zip:'); ?></td>
		<td><?php echo $data['zip']; ?></td>
	</tr>
	<tr>
		<td><?php echo __d('application_membership','City:'); ?></td>
		<td><?php echo $data['city']; ?></td>
	</tr>
	<tr>
		<td><?php echo __d('application_membership','Comment:'); ?></td>
		<td><?php echo $data['comment']; ?></td>
	</tr>
</table>

<p><?php echo __d('application_membership','Yours sincerely,'); ?><br>
<?php echo $url?></p>
</div>