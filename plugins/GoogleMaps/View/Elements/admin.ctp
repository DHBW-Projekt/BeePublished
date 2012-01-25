<!-- GoogleMaps Administrations View -->
	<?php	
	
	//LOAD js
	$this->Html->script('jquery/jquery.quicksearch', false);
	$this->Html->script('/google_maps/js/googlemaps', false);
	
	//LOAD style-sheet
	echo $this->Html->css('/GoogleMaps/css/googlemaps');
	
	//LOAD menu
	echo $this->element('admin_menu', array('contentID' => $contentID));
	?>
	
	<div id="googlemaps_administration">		
		<h2><?php echo __d("google_maps", "Create new location").":"; ?></h2>

		<?php 
			echo $this->Form->create('createLocation', array('url' => array('controller' => 'Location', 'action' => 'create', $contentID)));
			echo $this->Form->end(__d("google_maps", 'Create location'));
		?>
		
		<br><hr><br>
		<h2><?php echo __d("google_maps", "Locations").":"; ?></h2>
		<br>
		
		<?php 
			echo $this->Session->flash('GoogleMapsLocation');
			
			echo $this->Form->create('search');
			echo $this->Form->input('GoogleMapsLocation.street', array('label' => (__d('google_maps', 'Search Locations').":"), 'id' => 'search_locations'));
			echo $this->Form->end();
		?>
		
		<table id="locations">
			<thead>
				<tr>
					<th></th>
					<th><?php echo __d("google_maps", "Location"); ?></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
					echo $this->Form->create('selectedLocations', array(
						'url' => array('controller' => 'Location', 'action' => 'removeSelected', $contentID),
						'onsubmit'=>'return confirm(\''.__d('google_maps', 'Do you really want to delete the selected locations?').'\');'));
				?>
				<?php foreach ($locations as $location): ?>
				    <tr class="Location_row">
				    	<td><?php echo $this->Form->checkbox($location['GoogleMapsLocation']['id']); ?></td>
					    <td>
					    	<?php 
					    		echo $location['GoogleMapsLocation']['city'].", ". 
					    			 $location['GoogleMapsLocation']['street']." ".
					    			 $location['GoogleMapsLocation']['street_number'];
					    	?>
					    </td>
					    <td class="googlemaps_orientation_right">
					    	<?php echo $this->Html->link(
					    			 		$this->Html->image("edit.png"), 
					    					array('action' => 'edit', $contentID, $location['GoogleMapsLocation']['id']),
					    					array('escape' => False)
					    				);?>
					    </td>
					    <td class="googlemaps_orientation_right">
					    	<?php echo $this->Html->link(
					    					$this->Html->image("delete.png"), 
					    					array('action' => 'remove', $contentID, $location['GoogleMapsLocation']['id']),
					    					array(
					    						'escape' => False,
					    						'onclick'=>'return confirm(\''.__d('google_maps', 'Do you really want to delete the selected locations?').'\');'
					    					)
					    				);?>
					    </td>
					    <td style="width:20px">
					    	<?php
								if ($location['GoogleMapsLocation']['id'] == $currentLocation['GoogleMapsLocation']['id']){
									$class = "";
									$style = "display:inline";
								} else {
									$class = "set_location_link";
									$style = "display:none";
								}
								
								
								echo $this->Html->link(
									$this->Html->image("check.png"),
									array('action' => 'setLocation', $contentID, $location['GoogleMapsLocation']['id']),
									array('escape' => False, 'class' => $class, "style" => $style)
								);
							?>
						</td>
				    </tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td><?php echo $this->Html->image('arrow.png', array('height' => 20, 'width' => 20)); ?></td>
					<td><?php echo $this->Form->end(__d('google_maps', 'Delete'), array('height' => 20, 'width' => 20, 'alt' => __d('google_maps', 'Delete'))); ?></td>
				</tr>
			</tfoot>
		</table>
	</div>