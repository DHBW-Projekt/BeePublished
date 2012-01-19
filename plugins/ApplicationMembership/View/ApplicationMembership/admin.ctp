<!--  Application Adminstration View -->

<?php 
	//LOAD css-file
	$this->Html->css('/ApplicationMembership/applcation_membership');
	
	//LOAD menue
	//echo $this->element('admin_menu', array('contentID' => $contentID));
	
	
	echo $this->Form->create('ApplicationMembershipEdit', array('url' => $url.'/applicationmembership/save'));
?>

<div id="application_membership_admin">
	<h2>Offene Mitgliedsanträge</h2>
	<br/>
				<table id="applicationTable">
				<tr>
					<th>Done</th>
					<th>Form of Membership</th>
					<th>Title</th>
					<th>Last name</th>
					<th>First name</th>
					<th>Date of birth</th>
					<th>Email</th>
					<th>Telephone</th>
					<th>Street</th>
					<th>Zip</th>
					<th>City</th>
					<th>Comment</th>
				</tr>
	<?php 
	//pr($applications);
	
	if(count($applications) == 0){
		echo "<h2>There are no applications.</h2>";
	}
	else{
	
		for($i=0; $i < count($applications); $i++)
		//foreach($applications as $app)
		{ 
			$application = $applications[$i]["ApplicationMembership"];
			
			//pr($application);
			//data in attribute 'applications'
			//pr($application);
			?>

				<tr >
					<td><?php echo $this->Form->checkbox('type'); ?></td>
					<td><?php echo $application['type']; ?></td>
					<td><?php echo $application['title']; ?></td>
					<td><?php echo $application['last_name']; ?></td>
					<td><?php echo $application['first_name']; ?></td>
					<td><?php echo $application['date_of_birth']; ?></td>
					<td><?php echo $application['email']; ?></td>
					<td><?php echo $application['telephone']; ?></td>
					<td><?php echo $application['street']; ?></td>
					<td><?php echo $application['zip']; ?></td>
					<td><?php echo $application['city']; ?></td>
					<td><?php echo $application['comment']; ?></td>
				</tr>
			<?php
		}
		}
	?>
	</table>
	<br/>
</div>

<?php echo $this->Form->end('Save'); ?>