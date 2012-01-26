<!--  Application Adminstration View -->
<?php 
	//LOAD css-file
	$this->Html->css('/ApplicationMembership/css/applicationmembership');
	
	//LOAD menue
	echo $this->element('admin_menu', array('contentID' => $contentID));
?>

<div id="applicationmembership_admin">
	<h2><?php echo __d('application_membership','Open Applications'); ?></h2>
		<?php 
		if(count($applications) == 0){
			echo "<h2><?php echo echo __d('application_membership','There are no applications.');</h2>";
		}
		else{
			echo $this->Form->create('SelectApplications', array('url' => array('controller' => 'ApplicationMembership', 'action' => 'doneSelection', $contentID)));
		?>
		<table>
			<tr>
				<th><?php echo __d('application_membership','Done'); ?></th>
				<th><?php echo __d('application_membership','Application'); ?></th>
				<th><?php echo __d('application_membership','Action'); ?></th>
			</tr>
		<?php 
			foreach ((!isset($applications)) ? array() : $applications as $application) { 
				
				if($application['ApplicationMembership']['type'])
					$type = 'active';
				else
					$type = 'passive';
			?>
			<tr>
				<td name="applicationDoneField"><?php echo $this->Form->checkbox($application['ApplicationMembership']['id']); ?></td>
				<td>
					<p><?php echo __d('application_membership','Address:'); ?></p>
					<table>
						<tr>
							<td><?php echo __d('application_membership','Title:'); ?></td>
							<td><?php echo $application['ApplicationMembership']['title']; ?></td>
						</tr>
						<tr>
							<td><?php echo __d('application_membership','Last Name:'); ?></td>
							<td><?php echo $application['ApplicationMembership']['last_name']; ?></td>
						</tr>
						<tr>
							<td><?php echo __d('application_membership','First Name:'); ?></td>
							<td><?php echo $application['ApplicationMembership']['first_name']; ?></td>
						</tr>
						<tr>
							<td><?php echo __d('application_membership','Date of birth:'); ?></td>
							<td><?php echo $application['ApplicationMembership']['date_of_birth']; ?></td>
						</tr>
						<tr>
							<td><?php echo __d('application_membership','Email:'); ?></td>
							<td><?php echo $application['ApplicationMembership']['email']; ?></td>
						</tr>
						<tr>
							<td><?php echo __d('application_membership','Telephone:'); ?></td>
							<td><?php echo $application['ApplicationMembership']['telephone']; ?></td>
						</tr>
							<tr>
							<td><?php echo __d('application_membership','Street:'); ?></td>
							<td><?php echo $application['ApplicationMembership']['street']; ?></td>
						</tr>
							<tr>
							<td><?php echo __d('application_membership','ZIP:'); ?></td>
							<td><?php echo $application['ApplicationMembership']['zip']; ?></td>
						</tr>
							<tr>
							<td><?php echo __d('application_membership','City:'); ?></td>
							<td><?php echo $application['ApplicationMembership']['city']; ?></td>
						</tr>
						</tr>
							<tr>
							<td><?php echo __d('application_membership','Comment:'); ?></td>
							<td><?php echo $application['ApplicationMembership']['comment']; ?></td>
						</tr>
						</tr>
							<tr>
							<td><?php echo __d('application_membership','Type:'); ?></td>
							<td><?php echo $type; ?></td>
						</tr>						
						
					</table>				
				</td>
				<td>
				<?php echo $this->Html->link($this->Html->image("test-pass-icon.png"),
						array('action' => 'done', $contentID, $application['ApplicationMembership']['id']),
						array('escape' => False)
						);
				?>
				</td>
			</tr>
		<?php
		}
		?>
		</table>
		
		<?php
		echo $this->Form->submit( __d('application_membership','Done'));
		echo $this->Form->end();
	}
	?>
</div>