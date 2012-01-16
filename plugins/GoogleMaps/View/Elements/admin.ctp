<!-- GoogleMaps Administrations View -->
<?php
	//LOAD style-sheet
	echo $this->Html->css('/GoogleMaps/css/googlemaps');
	$this->Html->script('/google_maps/js/googlemaps', false);
	
	//LOAD menu
	echo $this->element('admin_menu', array('contentID' => $contentID));
?>
	<div id="googlemaps_administration">
		<h1>Address Book Administration</h1>
		<table>
			<thead>
				<tr>
					<th colspan="5"><p>Products</p><?php echo $this->Form->postLink("Add", array('controller' => 'Location', 'action' => 'create', $contentID), array('style' => 'float: right', 'class' => 'googlemaps_button')); ?></th>
				</tr>
			</thead>
			<?php foreach ($locations as $location): ?>
			<tr class="Location_row">
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
				
				<td><?php echo $location['GoogleMapsLocation']['city']; ?></td>
				<td><?php echo $location['GoogleMapsLocation']['street']; ?></td>
				<td><?php echo $location['GoogleMapsLocation']['street_number']; ?></td>
				<td class="googlemaps_orientation_right">
					<?php 
						echo $this->Html->link(
							$this->Html->image("edit.png"),
							array('action' => 'edit', $contentID, $location['GoogleMapsLocation']['id']),
							array('escape' => False)
						);
						echo $this->Html->link(
							$this->Html->image("delete.png"),
							array('action' => 'remove', $contentID, $location['GoogleMapsLocation']['id']),
							array('escape' => False)
						);
					?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>