<!--  Application Adminstration View -->
<?php 
	//LOAD css-file
	$this->Html->css('/ApplicationMembership/css/application_membership');
	
	//LOAD menue
	echo $this->element('admin_menu', array('contentID' => $contentID));
?>

<div id="application_membership_admin">
	<h2>Offene Mitgliedsanträge</h2>
		<?php 
		if(count($applications) == 0){
			echo "<h2>There are no applications.</h2>";
		}
		else{
		?>
		<table >
		<?php echo $this->Form->create('SelectApplications', array('url' => array('controller' => 'ApplicationMembership', 'action' => 'doneSelection', $contentID))); ?>
			<tr>
				<th>Done</th>
				<th>Application</th>
				<th>Action</th>
			</tr>
		<?php 
			foreach ((!isset($applications)) ? array() : $applications as $application) { 
				
				if($application['ApplicationMembership']['type'])
					$type = 'active';
				else
					$type = 'passive';
			?>
			<tr >
				<td name="applicationDoneField"><?php echo $this->Form->checkbox($application['ApplicationMembership']['id']); ?></td>
				<td>
					<p>Anschrift:</p>
					<table>
						<tr>
							<td>Title:</td>
							<td><?php echo $application['ApplicationMembership']['title']; ?></td>
						</tr>
						<tr>
							<td>Last Name:</td>
							<td><?php echo $application['ApplicationMembership']['last_name']; ?></td>
						</tr>
						<tr>
							<td>First Name:</td>
							<td><?php echo $application['ApplicationMembership']['first_name']; ?></td>
						</tr>
						<tr>
							<td>Date of birth:</td>
							<td><?php echo $application['ApplicationMembership']['date_of_birth']; ?></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><?php echo $application['ApplicationMembership']['email']; ?></td>
						</tr>
						<tr>
							<td>Telephone:</td>
							<td<?php echo $application['ApplicationMembership']['telephone']; ?></td>
						</tr>
							<tr>
							<td>Street:</td>
							<td><?php echo $application['ApplicationMembership']['street']; ?></td>
						</tr>
							<tr>
							<td>ZIP:</td>
							<td><?php echo $application['ApplicationMembership']['zip']; ?></td>
						</tr>
							<tr>
							<td>City:</td>
							<td><?php echo $application['ApplicationMembership']['city']; ?></td>
						</tr>
						</tr>
							<tr>
							<td>Comment:</td>
							<td><?php echo $application['ApplicationMembership']['comment']; ?></td>
						</tr>
						</tr>
							<tr>
							<td>Typ:</td>
							<td><?php echo $type; ?></td>
						</tr>						
						
					</table>				
					
					<?php /*echo $application['ApplicationMembership']['first_name']; ?>
					<?php echo $application['ApplicationMembership']['date_of_birth']; ?>
					<?php echo $application['ApplicationMembership']['email']; ?>
					<?php echo $application['ApplicationMembership']['telephone']; ?>
					<?php echo $application['ApplicationMembership']['street']; ?>
					<?php echo $application['ApplicationMembership']['zip']; ?>
					<?php echo $application['ApplicationMembership']['city']; ?>
					</p>
					<p><?php echo $application['ApplicationMembership']['comment']; */?>
				</td>
				<td>
				<?php echo $this->Html->link($this->Html->image("test-pass-icon.png"),
						array('action' => 'done', $contentID, $application['ApplicationMembership']['id']),
						array('escape' => False)
						);?>
				</td>
			</tr>
			<tr>
			<td colspan="3">
			<hr/>
			</td>
			</tr>
			<?php
		}
		?>
		</table>
		
		<?php
		echo $this->Form->submit("Done");
		echo $this->Form->end();
		
	}
	?>
</div>