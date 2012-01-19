<!--  Application Adminstration View -->
<?php 
	//LOAD css-file
	$this->Html->css('/ApplicationMembership/applcation_membership');
	
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
		<table>
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
				<td><?php echo $this->Form->checkbox($application['ApplicationMembership']['id']); ?></td>
				<td>
					<p>Anschrift:</p>
					<table>
						<tr>
							<td>Title:</td>
							<td><?php echo $application['ApplicationMembership']['title']; ?></td>
						</tr>
						<tr>
							<td>Last Name</td>
							<td><?php echo $application['ApplicationMembership']['last_name']; ?></td>
						</tr>
					</table>
						
					Typ: <?php echo $type; ?>
				
					
					<?php /*echo $application['ApplicationMembership']['first_name']; ?>
					<?php echo $application['ApplicationMembership']['date_of_birth']; ?>
					<?php echo $application['ApplicationMembership']['email']; ?>
					<?php echo $application['ApplicationMembership']['telephone']; ?>
					<?php echo $application['ApplicationMembership']['street']; ?>
					<?php echo $application['ApplicationMembership']['zip']; ?>
					<?php echo $application['ApplicationMembership']['city'];*/ ?>
					</p>
					<p><?php echo $application['ApplicationMembership']['comment']; ?></p>
				</td>
				<td>
				<?php echo $this->Html->link($this->Html->image("test-pass-icon.png"),
						array('action' => 'done', $contentID, $application['ApplicationMembership']['id']),
						array('escape' => False)
						);?>
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