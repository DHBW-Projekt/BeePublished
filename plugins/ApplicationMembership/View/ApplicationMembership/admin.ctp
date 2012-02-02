<!--  Application Adminstration View -->
<?php 
	//LOAD css-file
	echo $this->Html->css('/ApplicationMembership/css/applicationmembership');
	
	//LOAD menue
	echo $this->element('admin_menu', array('contentID' => $contentID));
?>

<div id="applicationmembership_admin">
	<h2><?php echo __d('application_membership','Open Applications'); ?></h2>
		<?php 
		if(count($applications) == 0){
			echo "<p>".__d('application_membership','There are no applications.')."</p>";
		}
		else{
			echo $this->Form->create('SelectApplications', array('url' => array('controller' => 'ApplicationMembership', 'action' => 'doneSelection', $contentID)));
		?>
		<table>
			<thead>
				<tr>
					<th></th>
					<th colspan="2"><?php echo __d('application_membership','Application'); ?></th>
					<th><?php echo __d('application_membership','Action'); ?></th>
				</tr>
			</thead>
			<tbody>
			<?php 
			foreach ((!isset($applications)) ? array() : $applications as $application) { 
				
				if($application['ApplicationMembership']['type'])
					$type = 'active';
				else
					$type = 'passive';
			?>
			<tr>
				<td name="applicationDoneField" rowspan="11"><?php echo $this->Form->checkbox($application['ApplicationMembership']['id']); ?></td>
				<td><?php echo __d('application_membership','Type:'); ?></td>
				<td><?php echo $type;?></td>
				<td rowspan="11">
				<?php echo $this->Html->link($this->Html->image("test-pass-icon.png"),
						array('action' => 'done', $contentID, $application['ApplicationMembership']['id']),
						array('escape' => False)
						);
				?>
				</td>
			</tr>
			<tr class="applicationmembership_space">
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
			<tr class="applicationmembership_space">
				<td><?php echo __d('application_membership','Comment:'); ?></td>
				<td><?php echo $application['ApplicationMembership']['comment']; ?></td>
			</tr>			
		<?php
		}
		?>
		</tbody>
		<tfoot>
				<tr>
					<td><?php echo $this->Html->image('arrow.png', array('height' => 20, 'width' => 20)); ?></td>
					<td><?php echo $this->Form->end(__d('application_membership', 'Done')); ?></td>
				</tr>
		</tfoot>
	</table>
	<?php
	}
	?>
</div>